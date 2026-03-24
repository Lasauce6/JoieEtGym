<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function isAdmin(): bool
    {
        return $this->type == 'admin';
    }

    public function avatar(): string
    {
        return Storage::url($this->avatar);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        $avatar = $this->getAttribute('avatar');

        if ($avatar) {
            return Storage::url($avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->getAttribute('name')) . '&color=3D3D3D&background=F0EFEB';
    }

    public function avatarUrl(): Attribute
    {
        return Attribute::get(function () {
            $avatar = $this->getAttribute('avatar');
            return $avatar
                ? Storage::url($avatar)
                : 'https://ui-avatars.com/api/?name=' . urlencode($this->getAttribute('name')) . '&color=3D3D3D&background=F0EFEB';
        });
    }
}
