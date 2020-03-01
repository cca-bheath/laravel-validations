<?php

namespace CCA\LaravelValidations;

use Illuminate\Support\ServiceProvider;

class LaravelValidationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/LaravelValidations'),
        ]);

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', 'LaravelValidations');
    }
}
