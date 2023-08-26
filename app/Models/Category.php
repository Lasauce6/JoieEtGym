<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TCG\Voyager\Traits\Translatable;

class Category extends Model
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

}
