<?php

namespace App\Engine;

use Illuminate\Support\Str;
use App\Menu as MenuModel;
use App\Page;
use Cache;

class Menu
{

    public static function getCurrentPageClassForActiveMenu()
    {
        $url = request()->segment(1);
        return $url;
    }

    public static function get($name)
    {
        $cacheName = self::getMenuCachingName($name);
        if (Cache::has($cacheName)) {
            return Cache::get($cacheName);
        } else {
            return self::cacheMenu($name);
        }
    }

    public static function cacheMenu($name)
    {
        $menu = MenuModel::where('name', $name)->first();
        if ($menu) {
            $slug = Str::slug($name);
            $view = 'menus.menu';
            if (view()->exists("menus.$slug")) {
                $view = "menus.$slug";
            }

            $html = view($view, compact('menu', 'attriblutes'))->render();

            $cachingName = self::getMenuCachingName($name);
            Cache::forget($cachingName);
            Cache::forever($cachingName, $html);
            return $html;
        }
        return FALSE;
    }

    protected static function getMenuCachingName($name)
    {
        return 'menus.' . $name;
    }

    public static function generateLinkFromItem($item)
    {
        $type = intval($item['type']);
        $link = '';
        switch ($type) {
            case MenuModel::PAGE_ITEM_TYPE:
                $page = Page::select('id', 'title', 'slug')->where('id', $item['id'])->first();
                $link = "<a class='{$page->slug}'  href='" . url($page->slug) . "'>{$page->title}</a>";
                break;
            case MenuModel::LINK_ITEM_TYPE:
                $class = \Str::slug($item['title']);
                if (preg_match("/^(http:\/\/)|(https:\/\/)/", $item['link'])) {
                    $href = $item['link'];
                    $link = "<a  class='$class'  href='$href' target='_blank'>{$item['title']}</a>";
                } else {
                    $href = url($item['link']);
                    $link = "<a class='$class'  href='$href'>{$item['title']}</a>";
                }

                break;
        }
        return $link;
    }
}
