<?php
namespace App\Http\Repositories;


use Illuminate\Support\ServiceProvider;


class CommentRepoServiceProvide extends ServiceProvider

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

        $this->app->bind('App\Http\Interfaces\CommentInterface', 'App\Http\Repositories\CommentRepository');

    }

}