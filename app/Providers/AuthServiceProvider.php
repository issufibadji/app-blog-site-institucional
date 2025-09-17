<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\User;
use App\Policies\GalleryPolicy;
use App\Policies\ServicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Service::class => ServicePolicy::class,
        Gallery::class => GalleryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ($user->role->name == 'Admin') {
                return true;
            }
        });

        Gate::define('admin-login', function (User $user) {
            if ($user->role->name == 'Writer') {
                return true;
            }
        });

        Gate::define('admin-only', function (User $user) {
            if ($user->role->name == 'Admin') {
                return true;
            }
        });
    }
}
