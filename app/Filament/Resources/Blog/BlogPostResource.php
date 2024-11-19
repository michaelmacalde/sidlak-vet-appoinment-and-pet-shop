<?php

namespace App\Filament\Resources\Blog;

use App\Filament\Resources\Blog\BlogPostResource\Pages;
use App\Filament\Resources\Blog\BlogPostResource\Pages\ManageBlogPostComments;
use App\Filament\Resources\Blog\BlogPostResource\RelationManagers;
use App\Models\Blog\BlogPost;
use App\Models\Blog\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'News & Events';

    protected static ?string $label = 'Post';

    protected static ?int $navigationSort = 1;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Hidden::make('author_id')->default(auth()->user()->id),
                        TextInput::make('post_title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('post_slug', Str::slug($state))),
                            // ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('post_slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->maxLength(255)
                            ->unique(BlogPost::class, 'post_slug', ignoreRecord: true),

                        RichEditor::make('post_content')
                            ->required()
                            ->columnSpan('full'),

                        Select::make('categories')
                        ->multiple()->native(false)->searchable()->searchDebounce(1200)->preload()->optionsLimit(6)
                        ->required()->relationship(name:'categories', titleAttribute: 'category_name')
                        ->createOptionForm([
                            Section::make('Category Details')
                            ->description('All fields are required')
                            ->schema([
                                TextInput::make('category_name')
                                ->required()->maxLength(255)
                                ->unique(Category::class, 'category_name', ignoreRecord: true)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('category_slug', Str::slug($state)))
                                ->columnSpan(1),

                                TextInput::make('category_slug')
                                ->disabled()
                                ->dehydrated()
                                ->required()
                                ->maxLength(255)
                                ->unique(Category::class, 'category_slug', ignoreRecord: true)
                                ->columnSpan(1),

                                Textarea::make('category_description')->maxLength(1024)->columnSpanFull()->rows(7)

                            ])
                            ->columns([
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 2,
                                'xl' => 2,
                                'default' => 2
                                ])

                        ])->columns(2),

                        Toggle::make('is_published')
                            ->label('Is published.')
                            ->inline(false)
                            ->default(true)
                            ->required()
                    ])
                    ->columns(2),

                Section::make('Featured Image')
                    ->schema([
                        FileUpload::make('post_image')
                            ->label('Featured Image')
                            ->image()
                            ->hiddenLabel()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                            ])->maxSize(2048),
                ])
                ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('post_image')->label('Featured Image'),
                TextColumn::make('post_title')->sortable()->searchable()->label('Title')->wrap()->limit(70),
                TextColumn::make('post_slug')->sortable()->label('Slug')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('post_content')->wrap()->limit(50)->label('Content')->html()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('categories.category_name')->label('Category')->wrap()->badge(),
                IconColumn::make('is_published')->boolean(),
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
                ->label(__('Create Post')),
            ])
            ->emptyStateIcon('heroicon-o-document-text')
            ->emptyStateHeading('No posts are created')
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewBlogPost::class,
            Pages\EditBlogPost::class,
            ManageBlogPostComments::class
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'comments' => ManageBlogPostComments::route('/{record}/comments'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
            'view' => Pages\ViewBlogPost::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
               ComponentsSection::make('Post Details')
               ->description('The following information is used to display the post on the website.')
               ->schema([
                    ImageEntry::make('post_image')->width('100%')->height(300)->label(''),
                    Group::make([
                        TextEntry::make('post_title')->label('Title')->size(TextEntrySize::Large)->weight('bold'),
                        TextEntry::make('post_slug')->label('Slug'),
                        TextEntry::make('categories.category_name')->badge(),
                    ])

               ])->compact()->collapsible()
               ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    'default' => 2
               ]),
               ComponentsSection::make('Content')
               ->schema([
                    TextEntry::make('post_content')->markdown()->label(''),
               ])->collapsible()
            ]);
    }


    /** @return Builder<BlogPost> */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['author', 'categories']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['post_title', 'post_slug', 'author.name', 'categories.category_name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var BlogPost $record */
        $details = [];

        if ($record->post_title) {
            $details['Title'] = $record->post_title;
        }

        if ($record->author) {
            $details['Author'] = $record->author->name;
        }

        return $details;
    }
}
