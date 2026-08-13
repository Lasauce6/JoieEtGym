<?php

namespace App\Filament\Admin\Resources\Images\Schemas;

use App\Enums\ImageType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class ImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('key')
                    ->label('Type d\'image')
                    ->options(collect(ImageType::cases())->mapWithKeys(fn ($case) => [$case->value => $case->getLabel()]))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->searchable(),
                FileUpload::make('file_path')
                    ->label('Image')
                    ->disk('public')
                    ->directory('images')
                    ->acceptedFileTypes(['image/*'])
                    ->preserveFilenames(false)
                    ->deleteUploadedFileUsing(function ($file) {
                        Storage::disk('public')->delete($file);
                    }),
            ]);
    }
}
