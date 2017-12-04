<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Page extends Model
{
    const ACTIVE_STATUS = 1;
    const DEACTIVE_STATUS = 0;

    protected $fillable = [
        'title',
        'content',
        'extra_info',
        'slug',
        'meta_keywords',
        'meta_description',
        'show_top_share_icons', 
        'show_bottom_share_icons',
        'allow_comments','updated_at'
    ];
    
    protected $casts = [
        'setting' => 'array',
    ];
    
    public function scopeActive($query){
        return $query->where('status', self::ACTIVE_STATUS);
    }
    
    public static function getNotInMenu(Menu $menu){
        $existPage = [];
        foreach ($menu->items as $item){
            if($item['type'] == Menu::PAGE_ITEM_TYPE){
                $existPage[] = $item['id'];
            }
        }
         $query = Page::active();
        if(!empty($existPage)){
            $query->whereNotIn('id',$existPage);
        }
        return $query->get();
    }
} 