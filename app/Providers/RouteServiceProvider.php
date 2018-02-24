<?php

namespace App\Providers;

use App\Models\Auth\User;
use App\Models\Supplier\Supplier;
use App\Models\Item\Item;
use App\Models\Customer\Customer;
use App\Models\Transaction\Transaction;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        /*
        * Register route model bindings
        */

        /*
         * This allows us to use the Route Model Binding with SoftDeletes on
         * On a model by model basis
         */

        # User
        $this->bind('deletedUser', function ($value) {
            $user = new User;

            return User::withTrashed()->where($user->getRouteKeyName(), $value)->first();
        });

        # Supplier
        $this->bind('deletedSupplier', function ($value) {
            $supplier = new Supplier;

            return Supplier::withTrashed()->where($supplier->getRouteKeyName(), $value)->first();
        });

        # Item
        $this->bind('deletedItem', function ($value) {
            $item = new Item;

            return Item::withTrashed()->where($item->getRouteKeyName(), $value)->first();
        });

        # Customer
        $this->bind('deletedCustomer', function ($value) {
            $customer = new Customer;

            return Customer::withTrashed()->where($customer->getRouteKeyName(), $value)->first();
        });

        # Transaction
        $this->bind('deletedTransaction', function ($value) {
            $transaction = new Transaction;

            return Transaction::withTrashed()->where($transaction->getRouteKeyName(), $value)->first();
        });

        parent::boot();
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

        //
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
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
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
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
