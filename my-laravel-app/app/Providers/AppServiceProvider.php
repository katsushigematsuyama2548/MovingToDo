<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegistered;
use App\Listeners\CopyPublicFoldersAndTasks;

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
        View::composer('*', function ($view) {
            $user = Auth::user();
            $folder = $user ? $user->folders()->first() : null;
            $view->with('folder', $folder);
        });

        // イベントとリスナーの登録
        Event::listen(
            UserRegistered::class,
            [CopyPublicFoldersAndTasks::class, 'handle']
        );
    }
}
