<?php

namespace App\Filament\Admin\Resources\RouteToggles\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;

class RouteTogglesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('route_name')
                    ->label('Section')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->searchable(),
                ToggleColumn::make('is_enabled')
                    ->label('Statut')
                    ->afterStateUpdated(function ($record, $state) {
                        Cache::forever("route_toggle_{$record->route_name}", $state);
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
            ])
            ->toolbarActions([
            ]);
    }
}
