<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use App\Policies\AcademicSettingPolicy;
use App\Models\User;
use App\Models\AcademicSetting;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        AcademicSetting::class => AcademicSettingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define the "view users" gate
        Gate::define('view users', function ($user) {
            // Allow admins and teachers to view users
            return $user->role === 'admin' || $user->role === 'teacher';
        });

        Gate::define('view academic settings', function ($user) {
            // Allow only admins to view academic settings
            return $user->role === 'admin';
        });
    }
}
