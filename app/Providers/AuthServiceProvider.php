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

        // Admin capabilities
        Gate::define('manage-system', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('view-users', function ($user) {
            return in_array($user->role, ['admin', 'teacher']);
        });

        // Academic settings
        Gate::define('view-academic-settings', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-academic-settings', function ($user) {
            return $user->role === 'admin';
        });

        // Teacher capabilities
        Gate::define('manage-courses', function ($user) {
            return in_array($user->role, ['admin', 'teacher']);
        });

        Gate::define('manage-grades', function ($user) {
            return in_array($user->role, ['admin', 'teacher']);
        });

        Gate::define('manage-attendance', function ($user) {
            return in_array($user->role, ['admin', 'teacher']);
        });

        // Student capabilities
        Gate::define('view-grades', function ($user) {
            return $user->role === 'student';
        });

        Gate::define('view-attendance', function ($user) {
            return $user->role === 'student';
        });

        // Shared capabilities
        Gate::define('view-announcements', function ($user) {
            return in_array($user->role, ['admin', 'teacher', 'student']);
        });

        Gate::define('view-schedule', function ($user) {
            return in_array($user->role, ['admin', 'teacher', 'student']);
        });
    }
}
