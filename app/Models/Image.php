<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ImageType;

class Image extends Model
{
    protected $fillable = ['key', 'file_path'];

    protected $casts = [
        'key' => ImageType::class,
    ];
}
