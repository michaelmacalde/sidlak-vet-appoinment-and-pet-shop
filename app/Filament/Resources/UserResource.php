<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\Volunteer\Volunteer;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'User Mgmt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make('User Details')
                    ->description('The user\'s name and email address.')
                    ->schema([
                        TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                        TextInput::make('email')
                        ->required()
                        ->email()
                        ->unique(ignoreRecord: true),

                        TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                        ->required(fn (Page $livewire): bool => $livewire instanceof Pages\EditUser)
                        ->visible(fn (Page $livewire): bool => $livewire instanceof Pages\CreateUser),

                        TextInput::make('password_confirmation')
                        ->label('Confirm Password')
                        ->password()
                        ->revealable()
                        ->required(fn (Page $livewire): bool => $livewire instanceof Pages\EditUser)
                        ->visible(fn (Page $livewire): bool => $livewire instanceof Pages\CreateUser),
                    ])
                    ->columns(1),

                ])
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                ])
                ->columnSpanFull(),

                Section::make('Roles')
                ->description('Select roles for this user')
                ->schema([
                    CheckboxList::make('roles')
                    ->label('Select Roles')
                    ->relationship(name: 'roles', titleAttribute: 'name')
                    ->searchable()
                    ->columns(2)
                    ->options(function () {
                        return Role::all()->mapWithKeys(function ($role) {
                            return [$role->id => Str::replace('_', ' ', Str::ucwords($role->name))];
                        });
                    })
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')
            ->searchable()
            ->sortable(),
            TextColumn::make('email')
            ->searchable()
            ->sortable(),

            TextColumn::make('roles.name')
            ->formatStateUsing(fn ($state): string => ucwords(str_replace('_', ' ', $state)))
            ->searchable()
            ->sortable()
            ->badge()
            ->color('warning'),

            TextColumn::make('created_at')
            ->dateTime('Y-m-d')
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->tooltip('Actions')
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),


                BulkAction::make('assign_role')
                ->icon('heroicon-o-shield-check')
                ->color('primary')
                ->label('Assign Role')
                ->form([
                    Forms\Components\Select::make('role')
                        ->label('Role')
                        ->options(
                            Role::all()->mapWithKeys(function ($role) {
                                $formattedName = str_replace('_', ' ', $role->name);
                                $formattedName = ucwords($formattedName);
                                return [$role->id => $formattedName];
                            })
                        )
                        ->native(false)
                        ->required()
                        ->searchable()
                        ->preload()
                        ->optionsLimit(6),


                    Forms\Components\Select::make('volunteer_role')
                    ->label('Volunteer Role')
                    ->required()
                    ->options([
                        'dog_walking' => 'Dog Walking',
                        'event_assistance' => 'Event Assistance',
                        'admin_support' => 'Admin Support',
                        'community_outreach' => 'Community Outreach',
                    ])->native(false),




                ])
                ->action(function (array $data, $records) {
                    // Find the selected role
                    $role = Role::findById($data['role']);

                    // Assign role to selected users
                    foreach ($records as $record) {
                        // Remove existing roles and assign new role
                        $record->syncRoles([$role]);


                        Volunteer::updateOrCreate(
                            ['user_id' => $record->id], // Unique identifier for lookup
                            [
                                'volunteer_role' => $data['volunteer_role'],
                                'volunteer_reason' => 'I love dogs',
                                'volunteer_status_type' => 'approved',
                                'volunteer_status' => 'active',
                                'volunteer_joined_date' => now(),
                            ]);
                    }

                    Notification::make()
                        ->success()
                        ->title('Roles Assigned')
                        ->body("Role '{$role->name}' assigned to selected users.")
                        ->send();
                })
                ->deselectRecordsAfterCompletion()
            ]),
        ])
        ->deferLoading()
        ->emptyStateActions([
            Tables\Actions\CreateAction::make()
            ->icon('heroicon-m-plus')
            ->label(__('Create User')),
        ])
        ->emptyStateIcon('heroicon-o-users')
        ->emptyStateHeading('No users are created');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
