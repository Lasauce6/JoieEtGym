<?php

namespace App\Filament\Admin\Resources\AnimatorResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Admin\Resources\AnimatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnimators extends ListRecords
{
    protected static string $resource = AnimatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
