<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Test\Repositories\AfterSaleNoticesRepository;
use Modules\Test\Repositories\AfterSaleNoticesRepositoryEloquent;
use Modules\Test\Repositories\UsersRepository;
use Modules\Test\Repositories\UsersRepositoryEloquent;
//:end-use:

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AfterSaleNoticesRepository::class, AfterSaleNoticesRepositoryEloquent::class);
        $this->app->singleton(UsersRepository::class, UsersRepositoryEloquent::class);
        //:end-bindings:
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
