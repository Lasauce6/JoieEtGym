<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class BlogPost extends Model implements Sitemapable
{
    use Translatable,
        Resizable;

    public function link(): string
    {
        if (!$this->category)
        {
            return url('/news/');
        }
        return url('/news/' . $this->category->slug . '/' . $this->slug);
    }

    public function image(){
        return Voyager::image($this->image);
    }

    protected $translatable = ['title', 'seo_title', 'excerpt', 'body', 'slug', 'meta_description', 'meta_keywords'];

    const PUBLISHED = 'PUBLISHED';

    protected $guarded = [];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->id;
        }

        parent::save();
    }

    public function authorId()
    {
        return $this->belongsTo(Voyager::modelClass('User'), 'author_id', 'id');
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', '=', static::PUBLISHED);
    }

    public function category()
    {
        return $this->belongsTo(Voyager::modelClass('Category'));
    }

    public function categoryId()
    {
        return $this->belongsTo(Voyager::modelClass('Category'));
    }


    public function toSitemapTag(): Url|string|array
    {
        if (!$this->category) {
            // Vous pouvez retourner une URL par défaut ou lever une exception
            return Url::create('/news/' . $this->slug)
                ->setLastModificationDate($this->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8);
        }

        return Url::create('/news/' . $this->category->slug . '/' . $this->slug)
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }
}
