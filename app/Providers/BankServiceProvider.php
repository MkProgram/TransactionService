<?php

namespace App\Providers;

use App\Repository\BankServiceMockRepository;
use App\Repository\BankServiceRepository;
use App\Repository\BankServiceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment('production') === false) {
            $this->app->bind(
                BankServiceRepositoryInterface::class,
                env('BankServiceRepository', BankServiceMockRepository::class)
            );
        } else {
            $this->app->bind(
                BankServiceRepositoryInterface::class,
                BankServiceRepository::class
            );
        }
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
