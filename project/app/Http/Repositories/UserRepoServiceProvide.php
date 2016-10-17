<?php
namespace App\Http\Repositories;


use Illuminate\Support\ServiceProvider;


class UserRepoServiceProvide extends ServiceProvider

{

    /**

     * Bootstrap the application services.

     *

     * @return void

     */

    public function boot()

    {



    }


    /**

     * Register the application services.

     *

     * @return void

     */

    public function register()
    {

        $this->app->bind('App\Http\Interfaces\UserInterface', 'App\Http\Repositories\UserRepository');

    }

}