<?php

namespace App\Filament\Resources\Blog\BlogPostResource\Pages;

use App\Filament\Resources\Blog\BlogPostResource;
use App\Models\Blog\Comment;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageBlogPostComments extends ManageRelatedRecords
{
    protected static string $resource = BlogPostResource::class;

    protected static string $relationship = 'comments';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    protected static string $badgeColor = 'success';

    public function getTitle(): string | Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return "Manage {$recordTitle} Comments";
    }

    public function getBreadcrumb(): string
    {
        return 'Comments';
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Comments';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->relationship('user', 'name')
                ->required()
                ->native(false)
                ->preload()
                ->optionsLimit(6)->columnSpanFull(),

                RichEditor::make('content')
                ->required()
                ->columnSpanFull()
                ->label('Comment'),

                ToggleButtons::make('is_approved')
                ->label('Is Approved?')
                ->options([
                    '1' => 'Approved',
                    '0' => 'Deny',
                ])
                ->colors([
                    '1' => 'success',
                    '0' => 'danger',
                ])
                ->icons([
                    '1' => 'heroicon-o-check-circle',
                    '0' => 'heroicon-o-x-circle',
                ])
                ->inline()
                ->default(0)
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('post_id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('blogPost.post_title')->label('Title')->searchable()->sortable()
                ->limit(50),
                Tables\Columns\TextColumn::make('content')
                ->label('Comment')
                ->html()
                ->wrap()
                ->words(20),
                Tables\Columns\IconColumn::make('is_approved')->label('Is Approved?')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->icon('heroicon-o-plus'),
                // Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalHeading('View Comment')->modalIcon('heroicon-o-chat-bubble-oval-left-ellipsis'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions')

                // Tables\Actions\DissociateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New comment')),
            ])
            ->emptyStateIcon('heroicon-o-chat-bubble-oval-left-ellipsis')
            ->emptyStateHeading('No comments are posted');;
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(2)
            ->schema([
                TextEntry::make('blogPost.post_title')->columnSpanFull()->size(TextEntrySize::Large)->color('primary')
                ->label('Title'),
                TextEntry::make('user.name')
                ->badge()->color('success')
                ->label('Commented user'),
                IconEntry::make('is_approved')
                    ->label('Is approved?')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextEntry::make('content')
                    ->label('Comment :')
                    ->markdown()->columnSpanFull(),
            ]);
    }
}
