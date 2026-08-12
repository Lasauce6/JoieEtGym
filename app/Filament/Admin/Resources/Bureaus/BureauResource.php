<?php

namespace App\Filament\Admin\Resources\Bureaus;

use App\Filament\Admin\Resources\Bureaus\Pages\CreateBureau;
use App\Filament\Admin\Resources\Bureaus\Pages\EditBureau;
use App\Filament\Admin\Resources\Bureaus\Pages\ListBureaus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\Bureau;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BureauResource extends Resource
{
    protected static ?string $model = Bureau::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserPlus;

    protected static string|UnitEnum|null $navigationGroup = 'Bureau';

    protected static ?string $modelLabel = 'Membre du bureau';

    protected static ?string $pluralModelLabel = 'Membres du bureau';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
                    ->components([
                        FileUpload::make('photo')
                            ->label('Photo')
                            ->image()
                            ->visibility('public')
                            ->directory('bureaus'),

                        TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_url')->circular()->label('Photo'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('description')->searchable(),
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
            'index' => ListBureaus::route('/'),
            'create' => CreateBureau::route('/create'),
            'edit' => EditBureau::route('/{record}/edit'),
        ];
    }
}
