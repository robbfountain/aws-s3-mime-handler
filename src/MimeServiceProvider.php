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
        $this->app->bind('message-collector', function(){
            return new MessageCollector();
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
