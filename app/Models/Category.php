<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use TCG\Voyager\Traits\Translatable;

class Category extends Model implements Sitemapable
{
    use Translatable;

    protected array $translatable = ['slug', 'name'];

    protected $table = 'categories';

    protected $fillable = ['slug', 'name'];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id', 'id')
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function parentId(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('news.category', $this->slug))
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);

    }
}
