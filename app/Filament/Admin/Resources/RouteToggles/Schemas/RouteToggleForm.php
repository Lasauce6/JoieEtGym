<?php

namespace App\Filament\Admin\Resources\RouteToggles\Schemas;

use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class RouteToggleForm {
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('route_name')
                    ->label('Nom de la route')
                    ->required()
                    ->disabledOn('edit'),
                Toggle::make('is_enabled')
                    ->label('Activé / Désactivé')
                    ->default(true),
        ]);
    }
}
