<?php

namespace App\Filament\Resources\Contact;

use App\Filament\Resources\Contact\InquiryResource\Pages;
use App\Filament\Resources\Contact\InquiryResource\RelationManagers;
use App\Mail\InquiryReply;
use App\Models\Contact\Inquiry;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Mail;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Inquiry Details')
                ->schema([
                    TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                    TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                    TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->telRegex('((^(\+)(\d){12}$)|(^\d{11}$))'),

                    TextInput::make('subject')
                    ->required()
                    ->maxLength(255),

                    Textarea::make('message')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpan('full')
                    ->rows(7),
                ])
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                TextColumn::make('email')
                ->searchable()
                ->sortable()
                ->description(fn (Inquiry $record): string => $record->phone),

                TextColumn::make('subject')
                ->searchable()
                ->sortable()
                ->formatStateUsing(fn (string $state): string => strtoupper($state))
                ->badge()
                ->color('primary'),

                TextColumn::make('message')
                ->limit(70)
                ->wrap()
                ->html()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Action::make('reply')
                    ->label('Reply')
                    ->icon('heroicon-m-paper-airplane')
                    ->color('primary')
                    ->button()
                    ->form([
                        TextInput::make('subject')
                            ->label('Reply Subject')
                            ->required()
                            ->disabled()
                            ->default(fn (Inquiry $record) => 'Re: ' . ucwords($record->subject)),

                        RichEditor::make('reply_message')
                            ->label('Reply Message')
                            ->required(),
                    ])
                    ->action(function (Inquiry $record, array $data): void {
                        try {
                            // Send Markdown email
                            Mail::to($record->email)
                                ->send(new InquiryReply(
                                    $record->email,
                                    $record->message,
                                    $data['reply_message']
                                ));
                            // Update inquiry status
                            $record->update([
                                'user_id' => auth()->user()->id,
                                'is_replied' => 1,
                                'replied_at' => now(),
                            ]);

                            // Show success notification
                            Notification::make()
                            ->success()
                            ->title('Reply Sent')
                            ->body('Your reply has been sent successfully.')
                            ->send();

                        } catch (\Exception $e) {
                            // Handle email sending error
                            Notification::make()
                                ->error()
                                ->title('Reply Failed')
                                ->body('Could not send reply: ' . $e->getMessage())
                                ->send();
                        }
                    })
                    ->modalWidth('xl'),


                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('Create Inquiry')),
            ])
            ->emptyStateIcon('heroicon-o-envelope-open')
            ->emptyStateHeading('No inquiries are created')
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInquiries::route('/'),
            'create' => Pages\CreateInquiry::route('/create'),
            'edit' => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')
                ->label('Name')
                ->badge()
                ->color('primary'),

                TextEntry::make('email')
                ->label('Email'),

                TextEntry::make('phone')
                ->label('Phone Number')
                ->formatStateUsing(fn (string $state): string => $state ? $state : 'N/A'),

                TextEntry::make('subject')
                ->label('Subject'),

                TextEntry::make('message')
                ->label('Message')
                ->html()
                ->columnspanfull(),

            ])
            ->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
            ]);

    }
}
