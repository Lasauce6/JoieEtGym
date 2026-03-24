<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Post extends Model
{
    const STATUS_DRAFT = 'DRAFT';
    const STATUS_PUBLISHED = 'PUBLISHED';
    const STATUS_ARCHIVED = 'ARCHIVED';

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'meta_description',
        'published_date',
        'category_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'published_date' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
            ->where('published_date', '<=', now());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function link(): string
    {
        return route('news.post', [
            'category' => $this->category->slug,
            'slug' => $this->slug
        ]);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? Storage::url($this->image)
            : 'https://via.placeholder.com/800x400';
    }

    public function image(): string
    {
        return $this->image_url;
    }
}
