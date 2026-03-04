<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event;
use Spatie\Activitylog\Models\Activity;
use App\Policies\ActivityLogPolicy;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use Illuminate\Support\Facades\View;
use App\Models\DefinisiWbs;

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
        View::composer('partials.modal_persetujuan', function ($view) {
        $view->with(
            'ketentuan',
            DefinisiWbs::where('i_wbls_about', 4)->first()
        );
    });

        // Register ActivityLog Policy
        Gate::policy(Activity::class, ActivityLogPolicy::class);

        // Register event listeners
        Event::listen(Login::class, LogSuccessfulLogin::class);
        Event::listen(Logout::class, LogSuccessfulLogout::class);
    }
}
