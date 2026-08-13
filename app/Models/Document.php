<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\DocumentType;

class Document extends Model
{
    protected $fillable = ['key', 'file_path'];

    protected $casts = [
        'key' => DocumentType::class,
    ];
}
