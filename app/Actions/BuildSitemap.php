<?php

namespace App\Actions;

use App\Models\BlogPost;
use App\Models\Category;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class BuildSitemap
{
    public function build(): void
    {
        Sitemap::create()
            ->add($this->build_index(BlogPost::all()->where('status', 'PUBLISHED'), 'sitemap_blogposts.xml'))
            ->add($this->build_index(Category::all(), 'sitemap_categories.xml'))
            ->add(Url::create('/')->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create('/news')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create('/planning')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/inscription')->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/register')->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/login')->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/legals')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/404')->setPriority(0.1)->setChangeFrequency(Url::CHANGE_FREQUENCY_NEVER))
            ->writeToFile(public_path('sitemap.xml'));
    }

    protected function build_index($model, $path): string
    {
        Sitemap::create()
            ->add($model)
            ->writeToFile(public_path($path));
        return $path;
    }

}
