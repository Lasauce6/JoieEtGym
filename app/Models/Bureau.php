<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Bureau extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'description',
    ];

    public function getPhotoUrlAttribute(): string
    {
        $photo = $this->getAttribute('photo');

        if ($photo)
            return Storage::url($photo);
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->getAttribute('name')) . '&color=3D3D3D&background=F0EFEB';
    }
}
