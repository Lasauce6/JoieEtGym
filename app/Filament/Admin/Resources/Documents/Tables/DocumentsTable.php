<?php

namespace App\Filament\Admin\Resources\Documents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->formatStateUsing(fn ($state) => $state->getLabel())
                    ->sortable()
                    ->label('Type'),
                TextColumn::make('file_path')->label('Fichier'),
                TextColumn::make('updated_at')
                    ->dateTime('j/m/Y H:i')
                    ->sortable()
                    ->label('Date de modification'),
            ])
            ->filters([
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
}
