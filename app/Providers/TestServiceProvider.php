<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Lib\Fz\src\Test;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @param Request $request
     */
    public function register()
    {
        $this->app->singleton(Test::class, function($app){
            $t = new Test();
            $request = $app->make('Illuminate\Http\Request');
            $server = $request->route();
            $t->server = $server;
            $t->str = $request->input('str', 'is run by default');

            return $t;
        });
    }
}
