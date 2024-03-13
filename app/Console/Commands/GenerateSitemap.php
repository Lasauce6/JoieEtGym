<?php

namespace App\Console\Commands;

use App\Actions\BuildSitemap;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap';

    public function handle(): void
    {
        (new BuildSitemap())->build();
    }
}
