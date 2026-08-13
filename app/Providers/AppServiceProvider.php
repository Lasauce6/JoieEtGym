<?php

namespace App\Providers;

use App\Models\Document;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        view()->composer('partials.footer', function ($view) {
            $documents = Document::pluck('file_path', 'key');

            $view->with('documents', $documents);
        });

        Event::listen(
            Registered::class,
            SendEmailVerificationNotification::class,
        );
    }
}
