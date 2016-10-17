<?php
namespace App\Http\Repositories;


use Illuminate\Support\ServiceProvider;


class VoteRepoServiceProvide extends ServiceProvider

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

        $this->app->bind('App\Http\Interfaces\VoteInterface', 'App\Http\Repositories\VoteRepository');

    }

}