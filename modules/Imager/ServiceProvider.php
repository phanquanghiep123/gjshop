<?php

namespace Modules\Imager;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Description of MediaServiceProvider
 *
 * @author dinhtrong
 */
class ServiceProvider extends BaseServiceProvider {
    
    public function boot()
    {
        $configPath = __DIR__ . '/config.php';
        $publicPath = __DIR__.'/public';
        
        // Publish config.
        $this->publishes([
            $configPath => config_path('uploader.php'),
            $publicPath => base_path('public/modules/imager'),
        ]);
        
        $viewPath = __DIR__ . '/views';
        $this->loadViewsFrom($viewPath, 'imager');
    }
    
    public function register() {
        
        $configPath = __DIR__ . '/config.php';
        $this->mergeConfigFrom($configPath, 'imager');
        $routePath = __DIR__ . '/routes.php';
        require $routePath;
        
        
    }

}
