<?php

namespace Modules\ManageUser\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\ManageUser\Entities\User;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\ManageUser\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('customer', function ($value) {
            return User::isCustomer()->where('slug', $value)->firstOrFail();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapMobileRoutes();
        
        $this->mapFrontendRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('ManageUser', '/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api'])
            ->as('api.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('ManageUser', '/Routes/api.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapMobileRoutes()
    {
        Route::prefix('api/v1/mobile/sales')
            ->middleware(['api', 'expects-json'])
            ->as('api.mobile.')
            ->namespace($this->moduleNamespace . '\Api\Mobile')
            ->group(module_path('ManageUser', '/Routes/mobile.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapFrontendRoutes()
    {
        Route::prefix('api/v1/web/customer')
            ->middleware(['api', 'expects-json'])
            ->as('api.frontend.')
            ->namespace($this->moduleNamespace . '\Api\Frontend')
            ->group(module_path('ManageUser', '/Routes/frontend.php'));
    }
}
