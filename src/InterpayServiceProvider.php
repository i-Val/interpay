<?php
namespace IVal\Interpay;
use Illuminate\Support\ServiceProvider;

class InterpayServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register() {
        $this->mergeConfigFrom(__DIR__.'../src/InterpayServiceProvider.php', 'config');
    }
}