<?php

namespace App\Filament\Widgets;

use App\Models\Donation\Donation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Database\Eloquent\Builder;

use function Laravel\Prompts\search;

class LatestDonations extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Donation::query()
                    ->latest('created_at')
            )
            ->columns([
                TextColumn::make('donation_number')
                    ->label('Reference #')
                    ->searchable()
                    ->copyable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('donor_name')
                    ->label('Donor')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Donation $record): string => $record->donor_email),

                TextColumn::make('donor_amount')
                    ->label('Amount')
                    ->money('PHP')
                    ->prefix('₱')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('donor_status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => str_replace('_', ' ', ucwords($state))),

                TextColumn::make('donor_payment_method')
                    ->label('Payment Method')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => str_replace('_', ' ', strtoupper($state)))
                    ->colors([
                        'primary' => fn ($state): bool => true,
                    ]),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('M d, Y g:i A')
                    ->sortable(),
                TextColumn::make('donor_amount')
                    ->summarize(
                        Sum::make()
                        ->label('Total Amount')
                        ->money('PHP')
                    )

            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // Tables\Actions\Action::make('view_details')
                //     ->label('View')
                //     ->icon('heroicon-m-eye')
                //     ->url(fn (Donation $record): string => route('filament.admin.resources.donations.view', $record))
                //     ->openUrlInNewTab(),
            ])
            ->striped()
            ->paginated([5, 10, 25, 50])
            // ->searchable(['donation_number', 'donor_name', 'donor_email'])
            ->filters([
                Tables\Filters\SelectFilter::make('donor_status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ]),

                Tables\Filters\Filter::make('amount_min')
                    ->form([
                        TextInput::make('min_amount')
                            ->label('Minimum Amount')
                            ->numeric()
                            ->prefix('₱'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['min_amount'],
                            fn (Builder $query, $amount): Builder => $query->where('donor_amount', '>=', $amount),
                        );
                    }),

                Tables\Filters\Filter::make('amount_max')
                    ->form([
                        TextInput::make('max_amount')
                            ->label('Maximum Amount')
                            ->numeric()
                            ->prefix('₱'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['max_amount'],
                            fn (Builder $query, $amount): Builder => $query->where('donor_amount', '<=', $amount),
                        );
                    }),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('From'),
                        DatePicker::make('created_until')
                            ->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->bulkActions([])  // Disable bulk actions for this widget
            ->emptyStateHeading('No recent donations')
            ->emptyStateDescription('When you receive donations, they will appear here.')
            ->emptyStateIcon('heroicon-o-currency-dollar');
    }
}
