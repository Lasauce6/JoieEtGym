<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AnimatorResource\Pages;
use App\Models\Animator;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnimatorResource extends Resource
{
    protected static ?string $model = Animator::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationGroup = 'Planning';
    protected static ?string $modelLabel = 'Animateur';
    protected static ?string $pluralModelLabel = 'Animateurs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAnimators::route('/'),
            'create' => Pages\CreateAnimator::route('/create'),
            'edit' => Pages\EditAnimator::route('/{record}/edit'),
        ];
    }
}
