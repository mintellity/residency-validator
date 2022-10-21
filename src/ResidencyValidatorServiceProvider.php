<?php

namespace Mintellity\ResidencyValidator;

use Illuminate\Support\ServiceProvider;


class ResidencyValidatorServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/residency-validator.php' => config_path('residency-validator.php')
        ]);
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ResidencyValidator::class, function (){
            return new ResidencyValidator();
        });
    }
}

