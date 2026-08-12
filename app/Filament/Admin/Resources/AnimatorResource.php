<?php

namespace App\Filament\Admin\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Admin\Resources\AnimatorResource\Pages\ListAnimators;
use App\Filament\Admin\Resources\AnimatorResource\Pages\CreateAnimator;
use App\Filament\Admin\Resources\AnimatorResource\Pages\EditAnimator;
use App\Models\Animator;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnimatorResource extends Resource
{
    protected static ?string $model = Animator::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-plus';
    protected static string | \UnitEnum | null $navigationGroup = 'Planning';
    protected static ?string $modelLabel = 'Animateur';
    protected static ?string $pluralModelLabel = 'Animateurs';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('photo')
                    ->label('Photo')
                    ->image()
                    ->visibility('public')
                    ->directory('animators'),

                TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->maxLength(255),

                Textarea::make('bio')
                    ->label('Biographie / Description')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_url')->circular()->label('Photo'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('courses_count')->counts('courses')->label('Nb Cours'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'index' => ListAnimators::route('/'),
            'create' => CreateAnimator::route('/create'),
            'edit' => EditAnimator::route('/{record}/edit'),
        ];
    }
}
