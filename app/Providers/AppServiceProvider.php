<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */


    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();
        Carbon::setLocale(config('app.locale'));
    }
}
