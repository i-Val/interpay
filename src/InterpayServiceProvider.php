<?php
namespace IVal\Interpay;
use Illuminate\Support\ServiceProvider;

class InterpayServiceProvider extends ServiceProvider {

    public function boot() {
        
        $this->publishes([
            __DIR__.'/../config/interpay.php' => config_path('interpay.php'),
        ], 'config');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

    }

    public function register() {
        //merging config file
        $this->mergeConfigFrom(__DIR__.'/../config/interpay.php', 'interpay');

    }
}