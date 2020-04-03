<?php


namespace OneThirtyOne\Mime;

use Illuminate\Support\ServiceProvider;

class MimeServiceProvider extends ServiceProvider
{
    /**
     * Register the Service Provider
     */
    public function register()
    {
        $this->app->bind('Mime', function(){
            return new MimeParser();
        });
    }

    /**
     * Boot The Service Provider
     */
    public function boot()
    {
        //
    }
}
