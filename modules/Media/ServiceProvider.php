<?php

namespace Modules\Media;

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
            $configPath => config_path('media.php'),
            $publicPath => base_path('public/engine/media'),
        ]);
        
        $viewPath = __DIR__ . '/views';
        $this->loadViewsFrom($viewPath, 'media');
    }
    
    public function register() {
        
        $configPath = __DIR__ . '/config.php';
        $this->mergeConfigFrom($configPath, 'media');
        $routePath = __DIR__ . '/routes.php';
        require $routePath;
        
    }

}
