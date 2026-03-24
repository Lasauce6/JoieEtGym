<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Animator extends Model
{
    protected $fillable = ['name', 'photo', 'bio'];

    public function courses(): BelongsToMany
    {
        return $this->BelongsToMany(Course::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        $photo = $this->getAttribute('photo');

        if ($photo)
            return Storage::disk('public')->url($photo);
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->getAttribute('name')) . '&color=3D3D3D&background=F0EFEB';
    }
}
