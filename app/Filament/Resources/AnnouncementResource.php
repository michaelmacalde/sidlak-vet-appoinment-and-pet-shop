<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\RelationManagers;
use App\Models\Announcement;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'The number of announcements';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Announcement Details')
                ->icon('heroicon-o-megaphone')
                ->collapsible()
                ->schema([
                    TextInput::make('announcement_title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                    Select::make('blog_post_id')
                    ->label('Attach Blog Post')
                    ->relationship(
                        name: 'blogPost',
                        titleAttribute: 'post_title',
                        modifyQueryUsing: fn (Builder $query) => $query->where('is_published', true)
                    )
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->optionsLimit(6),

                    Select::make('category_id')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'category_name',
                    )
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->optionsLimit(6),

                    RichEditor::make('announcement_content')
                    ->label('Content')
                    ->maxLength(65535)
                    ->required()
                    ->columnSpanFull(),

                    Toggle::make('is_announced')
                        ->label('Would you like to announce this?')
                        ->required()
                        ->onIcon('heroicon-m-check-circle')
                        ->offIcon('heroicon-m-x-circle')
                        ->default(false)
                        ->inline(false),

                    DateTimePicker::make('announcement_date')
                    ->label('Date')
                    ->native(false),
                ])
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2
                ]),

                Section::make('Attachment')
                ->schema([

                    FileUpload::make('announcement_img')
                    ->label('')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->maxSize(5120)

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Posted by')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('announcement_title')
                    ->label('Title')
                    ->searchable()
                    ->badge()
                    ->color('primary')
                    ->weight(FontWeight::Bold)
                    ->wrap()
                    ->limit(30),

                Tables\Columns\ImageColumn::make('announcement_img')
                    ->label('Attachment')
                    ->square(),
                Tables\Columns\IconColumn::make('is_announced')
                    ->label('Is Announced?')
                    ->boolean(),
                Tables\Columns\TextColumn::make('announcement_content')
                    ->label('Content')
                    ->html()
                    ->wrap()
                    ->limit(100),

                Tables\Columns\TextColumn::make('announcement_date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('blogPost.post_title')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('category.category_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('Create Announcement')),
            ])
            ->emptyStateIcon('heroicon-o-megaphone')
            ->emptyStateHeading('No Announcements are created')
            ->defaultSort('created_at', 'desc');;
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewAnnouncement::class,
            Pages\EditAnnouncement::class,
        ]);
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
            'view' => Pages\ViewAnnouncement::route('/{record}'),
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
               InfoSection::make('Announcement Details')
               ->description('Details of the announcement')
               ->schema([
                    ImageEntry::make('announcement_img')->width('100%')->height(300)->label(''),
                    Group::make([
                        TextEntry::make('announcement_title')->label('Title')->size(TextEntrySize::Large)->weight('bold'),
                        TextEntry::make('category.category_name')->badge(),
                    ])

               ])->compact()->collapsible()
               ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    'default' => 2
               ]),
               InfoSection::make('Content')
               ->schema([
                    TextEntry::make('announcement_content')->markdown()->label(''),
               ])->collapsible()
            ]);
    }


}
