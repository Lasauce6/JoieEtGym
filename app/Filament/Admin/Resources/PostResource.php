<?php

namespace App\Filament\Admin\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Admin\Resources\PostResource\Pages\ListPosts;
use App\Filament\Admin\Resources\PostResource\Pages\CreatePost;
use App\Filament\Admin\Resources\PostResource\Pages\EditPost;
use Exception;
use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-newspaper';
    protected static string | \UnitEnum | null $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 4;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Paramètres de publication')
                    ->schema([
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'DRAFT' => 'Brouillon',
                                'PUBLISHED' => 'Publié',
                                'ARCHIVED' => 'Archivé',
                            ])
                            ->required()
                            ->default('PUBLISHED')
                            ->live(),
                        DateTimePicker::make('published_date')
                            ->label('Date de publication')
                            ->default(now())
                            ->required(),
                    ])->columns(2),
                Section::make('Contenu de l\'article')
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('category_id')
                            ->label('Catégorie')
                            ->relationship('category', 'name') // Se lie automatiquement au modèle Category
                            ->searchable()
                            ->required(),

                        RichEditor::make('body')
                            ->label('Corps de l\'article')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Médias & SEO')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image à la une')
                            ->image()
                            ->directory('posts')
                            ->visibility('public'),

                        Textarea::make('meta_description')
                            ->label('Meta Description (SEO)')
                            ->rows(3)
                            ->maxLength(255),

                        Select::make('user_id')
                            ->label('Auteur')
                            ->relationship('user', 'name')
                            ->default(auth()->id())
                            ->required(),
                    ])->columns(2),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Image')->circular(),
                TextColumn::make('title')->label('Titre')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Catégorie')->badge()->sortable(),
                TextColumn::make('published_date')
                    ->label('Publié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('user.name')->label('Auteur'),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'PUBLISHED' => 'success',
                        'DRAFT' => 'warning',
                        'ARCHIVED' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filtrer par catégorie'),
                SelectFilter::make('status')
                ->options([
                    'DRAFT' => 'Brouillon',
                    'PUBLISHED' => 'Publié',
                    'ARCHIVED' => 'Archivé',
                ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
