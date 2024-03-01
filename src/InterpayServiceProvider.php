<?php
namespace IVal\Interpay;
use Illuminate\Support\ServiceProvider;

class InterpayServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->publishes([
            __DIR__.'/Paystack/config/config.php' => config_path('interpay.php'),
        ], 'config');
    }

    public function register() {
        //merging config file
        $this->mergeConfigFrom(__DIR__.'/Paystack/config/config.php', 'config');
    }
}