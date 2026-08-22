<?php

namespace App\Filament\Admin\Resources\RouteToggles;

use App\Filament\Admin\Resources\RouteToggles\Pages\ListRouteToggles;
use App\Filament\Admin\Resources\RouteToggles\Schemas\RouteToggleForm;
use App\Filament\Admin\Resources\RouteToggles\Tables\RouteTogglesTable;
use App\Models\RouteToggle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RouteToggleResource extends Resource
{
    protected static ?string $model = RouteToggle::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Eye;
    protected static ?string $recordTitleAttribute = 'route_name';
    protected static string|UnitEnum|null $navigationGroup = 'Configuration';
    protected static ?string $navigationLabel = 'Sections du site';
    protected static ?string $modelLabel = 'Section';
    protected static ?string $pluralModelLabel = 'Sections du site';

    public static function form(Schema $schema): Schema
    {
        return RouteToggleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RouteTogglesTable::configure($table);
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
            'index' => ListRouteToggles::route('/'),
        ];
    }
}
