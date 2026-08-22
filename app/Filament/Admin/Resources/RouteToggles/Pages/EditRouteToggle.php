<?php

namespace App\Filament\Admin\Resources\RouteToggles\Pages;

use App\Filament\Admin\Resources\RouteToggles\RouteToggleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRouteToggle extends EditRecord
{
    protected static string $resource = RouteToggleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
