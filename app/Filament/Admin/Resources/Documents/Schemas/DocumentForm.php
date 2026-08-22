<?php

namespace App\Filament\Admin\Resources\Documents\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use App\Enums\DocumentType;
use Illuminate\Support\Facades\Storage;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('key')
                ->label('Type de document')
                ->options(collect(DocumentType::cases())->mapWithKeys(fn ($case) => [$case->value => $case->getLabel()]))
                ->required()
                ->unique(ignoreRecord: true),
            FileUpload::make('file_path')
                ->label('Document PDF')
                ->disk('public')
                ->directory('documents')
                ->acceptedFileTypes(['application/pdf'])
                ->preserveFilenames(false)
                ->deleteUploadedFileUsing(function ($file) {
                    Storage::disk('public')->delete($file);
                }),
        ]);
    }
}
