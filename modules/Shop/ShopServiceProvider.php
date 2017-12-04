<?php
namespace Modules\Shop;

use Illuminate\Support\ServiceProvider;
use Validator;

/**
 * Description of ShopServiceProvider
 *
 * @author dinhtrong
 */
class ShopServiceProvider extends ServiceProvider
{

    public function boot()
    {


        $configPath = __DIR__ . '/config.php';
        $publicPath = __DIR__ . '/public';

        // Publish config.
        $this->publishes([
            $configPath => config_path('shop.php'),
            $publicPath => base_path('public/engine/shop'),
        ]);

        $viewPath = __DIR__ . '/views'; //dd($viewPath);
        $this->loadViewsFrom($viewPath, 'shop');

        \View::share('loggedUser', \Auth::user()); // share logged user
        view()->composer(
                'shop::order.create', 'Modules\Shop\ViewComposers\ShippingComposer'
        );

        $this->app['router']->middleware('cart-cookie', Middwares\GetCartCookieMiddware::class);

        $this->createCustomValidateRules();
        
        $this->handleEvents();
    }

    public function register()
    {
        $configPath = __DIR__ . '/config.php';
        $this->mergeConfigFrom($configPath, 'shop');
        $routePath  = __DIR__ . '/routes.php';
        require $routePath;
    }

    protected function handleEvents()
    {
        Models\Order::created(function($order) {
            if (strlen($order->id) > 6) {
                $number = $order->id;
            } else {
                $number = sprintf("%06d", intval($order->id));
            }
            $orderNumber         = "NFL-" . date("y") . $number;
            $order->order_number = $orderNumber;
            $order->save();
        });
    }

    protected function createCustomValidateRules()
    {
        Validator::extend('rightShippingMethod', function($attribute, $value, $parameters, $validator) {
            if ($value == Models\ShippingMethod::FREE_METHOD_ID) {
                $freeShipSetting = Models\Setting::where('key', 'uk_free_shipping')->first();
                if ($freeShipSetting &&
                        cart()->getShipToCountry() == 'UK' &&
                        cart()->total() >= $freeShipSetting->value) {
                    return true;
                }
            }
            if (cart()->isHaveCoursesOnly()) {
                return intval($value) === 0;
            } else {
                $allowedShippings = cart()->getAllowedShippingMethods();
                foreach ($allowedShippings as $method) {
                    if ($value == $method->id) {
                        return true;
                    }
                }
                return false;
            }
        });
    }
}
