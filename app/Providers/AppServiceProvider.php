<?php

namespace App\Providers;

use Artisan;
use App\Category;
use App\Page;
use App\Menu;
use App\Engine\Menu as MenuEngine;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        
        Category::saved(function ($category) {
            //Artisan::call("route:cache");
        });
        
              
        Category::saved(function($cat){
            foreach(Menu::all() as $menu){
                $items = $menu->items;
                //dd($items);
                foreach ($items as $key => $item){
                    if($item['type'] == Menu::CATEGORY_ITEM_TYPE
                        && $item['id'] == $cat->id){
                        unset($items[$key]);
                    }
                }
                $menu->items = $items;
                $menu->save();
            }
        });
        
        Category::deleting(function($cat){
            foreach(Menu::all() as $menu){
                $items = $menu->items;
                foreach ($items as $key => $item){
                    if($item['type'] == Menu::CATEGORY_ITEM_TYPE
                            && $item['id'] == $cat->id){
                        unset($items[$key]);
                    }
                }
                $menu->items = $items;
                $menu->save();
            }
        });
        
        Page::deleting(function($page){
            foreach(Menu::all() as $menu){
                $items = $menu->items;
                foreach ($items as $key => $item){
                    if($item['type'] == Menu::PAGE_ITEM_TYPE
                            && $item['id'] == $page->id){
                        unset($items[$key]);
                    }
                }
                $menu->items = $items;
                $menu->save();
            }
        });
        
        Menu::saved(function ($menu) {
            MenuEngine::cacheMenu($menu->name);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
