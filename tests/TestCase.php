<?php

namespace CCA\LaravelValidations\Tests;

use CCA\LaravelValidations\LaravelValidationsServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();

        $this->app->make(EloquentFactory::class)->load(__DIR__.'/Factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelValidationsServiceProvider::class,
        ];
    }

    protected function setUpDatabase()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('remember_token');
            $table->timestamps();
        });
    }
}
