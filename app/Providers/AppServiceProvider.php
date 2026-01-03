<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use App\Listeners\LoginFailed;
use App\Listeners\LoginSuccessful;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Event::listen(
            LoginSuccessful::class,
            LoginFailed::class
        );

        // if (App::environment('production')) {
        //     Artisan::command('migrate:fresh', function () {
        //         $this->error('-');
        //     });

        //     Artisan::command('db:wipe', function () {
        //         $this->error('-');
        //     });

        //     Artisan::command('migrate:fresh --seed', function () {
        //         $this->error('-');
        //     });
        // }
    }
}
