<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        Paginator::useBootstrapFive();

        Gate::define('use-order', function (User $user, Order $order) {
            return
                $user->id == $order->user_id &&
                $order->is_paid == 1;
        });

        Gate::define('see-order', function (User $user, Order $order) {
            return $user->id === $order->user_id;
        });
    }
}
