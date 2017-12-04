<?php

namespace Modules\Minifier;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Description of ServiceProvider
 *
 * @author dinhtrong
 */
class ServiceProvider extends BaseServiceProvider {
    
    public function boot(){
        $configPath = __DIR__ . '/config.php';
        $this->publishes([
            $configPath => config_path('minifier.php')
        ]);
    }


    public function register() {
        $this->app['command.minifier.generate'] = $this->app->share(
            function ($app) {
                return new Minifier($app['files'],$app['config']);
            }
        );
    }

}
