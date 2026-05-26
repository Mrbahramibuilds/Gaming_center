<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{

    protected $policies=[
            \app\Models\User::class=>\app\Policies\UserPolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    // Gate::define('admin-read-only', function ($user) {
    //     return $user->roles()
    //         ->where('name','admin-readonly')
    //         ->whereHas('permissions', function ($query) {
    //             $query->where('name', 'read-only');
    //         })->exists();
    // });

    // Gate::define('admin-full', function ($user) {
    //     return $user->roles()
    //         ->where('name','admin')
    //         ->whereHas('permissions', function ($query) {
    //             $query->where('name', 'update');
    //         })->exists();
    // });
    
}
}