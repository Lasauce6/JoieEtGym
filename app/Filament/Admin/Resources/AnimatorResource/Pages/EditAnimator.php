<?php

namespace App\Filament\Admin\Resources\AnimatorResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Admin\Resources\AnimatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimator extends EditRecord
{
    protected static string $resource = AnimatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
