<?php

namespace Modules\Thumbnailer;

/**
 * Description of ServiceProvider
 *
 * @author dinhtrong
 */
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Description of MediaServiceProvider
 *
 * @author dinhtrong
 */
class ServiceProvider extends BaseServiceProvider {

    public function boot() {
        $configPath = __DIR__ . '/config.php';

        // Publish config.
        $this->publishes([
            $configPath => config_path('thumbnailer.php')
        ]);
    }

    public function provides() {
        return ['thumbnailer'];
    }

    public function register() {

//        $this->app->singleton('Thumbnailer', function ($app) {
//            return new Thumbnailer();
//        });
        
        $configPath = __DIR__ . '/config.php';
        $this->mergeConfigFrom($configPath, 'thumbnailer');

        
    }

}
