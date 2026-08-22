<?php

namespace App\Filament\Admin\Resources\RouteToggles\Pages;

use App\Filament\Admin\Resources\RouteToggles\RouteToggleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRouteToggles extends ListRecords
{
    protected static string $resource = RouteToggleResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
