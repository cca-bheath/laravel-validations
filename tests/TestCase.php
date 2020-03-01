<?php

namespace CCA\LaravelValidations\Tests;

use CCA\LaravelValidations\LaravelValidationsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelValidationsServiceProvider::class,
        ];
    }
}
