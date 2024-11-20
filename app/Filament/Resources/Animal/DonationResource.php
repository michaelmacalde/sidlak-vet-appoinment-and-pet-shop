<?php

namespace App\Filament\Resources\Animal;

use App\Filament\Resources\Animal\DonationResource\Pages;
use App\Filament\Resources\Animal\DonationResource\RelationManagers;
use App\Models\Animal\Donation;
use App\Models\Donation\Donation as DonationDonation;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
class DonationResource extends Resource
{
    protected static ?string $model = DonationDonation::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Donation Details')
                ->description('All fields are required')
                ->schema([
                    TextInput::make('donation_number')
                    ->default('DON-'. date('Ymd-His-') . random_int(100000, 999999))
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(32)
                    ->unique(DonationDonation::class, 'donation_number', ignoreRecord: true)
                    ->columnSpanFull(),

                    TextInput::make('donor_amount')
                    ->label('Amount')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal'),

                    TextInput::make('donor_email')
                    ->required()
                    ->email()
                    ->maxLength(255),

                    TextInput::make('donor_phone_number')
                    ->required()
                    ->maxLength(255),

                    TextInput::make('donor_address')
                    ->required()
                    ->maxLength(255),

                    Toggle::make('donor_status')
                    ->required()
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false),

                    RichEditor::make('donor_message')
                    ->required()
                    ->label('Message')->columnSpanFull(),

                ])
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'default' => 2
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donation_number')
                ->sortable()
                ->searchable()
                ->label('Donation Number')
                ->badge()->color('primary'),

                TextColumn::make('donor_payment_intent_id')
                ->sortable()
                ->searchable()
                ->label('Payment ID')
                ->badge()->color('success'),

                TextColumn::make('donor_name')
                ->sortable()
                ->searchable()
                ->label('Name')
                ->description(
                    fn (DonationDonation $record): string => $record->donor_email
                ),

                TextColumn::make('donor_phone_number')
                ->sortable()
                ->searchable()
                ->label('Phone Number')
                ->description(
                    fn (DonationDonation $record): string => $record->donor_address
                ),

                TextColumn::make('donor_amount')
                ->sortable()
                ->searchable()
                ->label('Amount')
                ->prefix('₱')
                ->description(
                    fn (DonationDonation $record): string => str_replace('_', '', strtoupper($record->donor_payment_method))
                ),

                TextColumn::make('donor_status')
                ->sortable()
                ->searchable()
                ->label('Donor Status')
                ->badge()
                ->colors([
                    'success' => 'Paid',
                    'danger' => 'Unpaid',
                ])
                ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('donor_message')
                ->sortable()
                ->searchable()
                ->label('Donor Message')
                ->wrap()
                ->limit(50)
                ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                ->sortable()
                ->searchable()
                ->label('Created At')
                ->dateTime('d-M-Y')
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalHeading('Donation Details')->modalIcon('heroicon-o-gift'),
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
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New Donation')),
            ])
            ->emptyStateIcon('heroicon-o-gift')
            ->emptyStateHeading('No Donations are registered');
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('donation_number')->label('Donation Number')->badge()->color('primary'),
                TextEntry::make('donor_payment_intent_id')->label('Payment ID')->badge()->color('success'),
                TextEntry::make('donor_name')->label('Name')->size(TextEntrySize::Large),
                TextEntry::make('donor_phone_number')->label('Phone Number'),
                TextEntry::make('donor_email')->label('Email'),
                TextEntry::make('donor_amount')->label('Amount')->prefix('₱'),
                TextEntry::make('donor_address')->label('Address')
                ->formatStateUsing(fn (string $state): string => Str::ucwords($state)),
                TextEntry::make('donor_payment_method')
                ->label('Payment Method')
                ->badge()
                ->colors([
                    'gcash' => 'success',
                    'paymaya' => 'danger',
                    'card' => 'warning',
                    'grab_pay' => 'info',
                ])
                ->formatStateUsing(fn (string $state): string => str_replace('_', ' ', strtoupper($state))),
            ])
            ->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
            ]);

    }
}
