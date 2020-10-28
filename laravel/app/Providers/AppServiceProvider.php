<?php

namespace App\Providers;

use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider;
use Kit\Application\Repository\StarterKitRepository;
use Kit\Application\Repository\VarietyRepository;
use Kit\Infrastructure\Dummy\Kit\StarterKitDummy;
use Kit\Infrastructure\Dummy\Kit\VarietyDummy;
use Kit\Infrastructure\Validation\DataValidatorFactory;
use Validation\ValidatorFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ValidatorFactory::class,
            static function ($app) {
                return new DataValidatorFactory(app(Factory::class));
            }
        );

        $this->app->singleton(
            StarterKitRepository::class,
            static function ($app) {
                return new StarterKitDummy();
            }
        );

        $this->app->singleton(
            VarietyRepository::class,
            static function ($app) {
                return new VarietyDummy();
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
