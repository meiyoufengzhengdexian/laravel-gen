<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lib\Fz\cate\src\CateRepostiory;

class CateRepostioryServiceProvider extends ServiceProvider
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
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CateRepostiory::class, function($app){
            $request = $app->make('Illuminate\Http\Request');
            $cate = $app->make('App\Model\Cate');
            $query =  $cate->newQuery();
            $cateRepostiory = new CateRepostiory($request, $query);
            return $cateRepostiory;
        });
    }
}
