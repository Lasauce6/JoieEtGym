<?php

namespace App\Filament\Admin\Resources\Images;

use App\Filament\Admin\Resources\Images\Pages\CreateImage;
use App\Filament\Admin\Resources\Images\Pages\EditImage;
use App\Filament\Admin\Resources\Images\Pages\ListImages;
use App\Filament\Admin\Resources\Images\Schemas\ImageForm;
use App\Filament\Admin\Resources\Images\Tables\ImagesTable;
use App\Models\Image;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Photo;
    protected static string | \UnitEnum | null $navigationGroup = 'Documents et liens';
    protected static ?string $modelLabel = 'Image';
    protected static ?string $pluralModelLabel = 'Images';
    protected static ?string $recordTitleAttribute = 'key';
    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return ImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ImagesTable::configure($table);
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
            'index' => ListImages::route('/'),
            'create' => CreateImage::route('/create'),
            'edit' => EditImage::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
        {
            return $record->key->getLabel();
        }
}
