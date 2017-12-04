<?php

namespace App;


use App\Engine\Entity\ParentChildSelfTrait;

/**
 * Description of Category
 *
 * @author dinhtrong
 */
class Category extends Entity {
    
    use ParentChildSelfTrait;
    
    const DEFAULT_QUOTE_NUMBER = 5;
       
    protected $fillable = [
        'name',
        'position',
        'status',
        'description',
        'parent_id',
        'slug',
        'meta_keywords',
        'meta_description'
    ];
    
    public function quotes(){
        return $this->hasMany('App\Quote');
    }
    
    
    public function articles() {
        return $this->belongsToMany('App\Article');
    }
    
    
    
    public function getRamdomQuotes($number = NULL){
        if($number === NULL) {
            $number = self::DEFAULT_QUOTE_NUMBER;
        }
        
        $query = $this->quotes();
        $total = $this->quotes()->count();
        
        if($number < $total ){
            $offset = $this->getOffsetForRamdomQuotes($number,$total);
            $query->skip($offset)->take($number);
        }
        
        return $query->get();
    }
    
    protected function getOffsetForRamdomQuotes($number,$total){
        $mixed = $total - $number;
        if($mixed <= 0) {
            throw new \Exception("Wrong number parameter, $number must less than $total");
        }
        if($mixed == 1){
            $offset = 1;
        }else{
            $offset = rand(1, $mixed);
        }
        return $offset;
    }


    public function scopeActive($query){
        return $query->where('status', 1)->orderBy('position','ASC');
    }
    
    
    public function getAllCategoriesWithChildsByArray(){
        $categoriesWithChilds = Category::root()->active()->with('childs')->get();
        $categories = [];
        foreach ($categoriesWithChilds as $cat) {
            $sCats = [];
            foreach ($cat->childs as $sCat) {
               $sCats[$sCat->id] = $sCat->name;
            }
            $categories[$cat->name] = $sCats;
        }
        return $categories;
    }
    
    
    public static function getNotInMenu(Menu $menu){
        $existPage = [];
        foreach ($menu->items as $item){
            if($item['type'] == Menu::CATEGORY_ITEM_TYPE){
                $existPage[] = $item['id'];
            }
        }
         $query = Category::root()->active();
        if(!empty($existPage)){
            $query->whereNotIn('id',$existPage);
        }
        return $query->get();
    }
    
    public  function isParentMenu(){
        if($this->childs()->count() > 0){
            return true;
        }
        return false;
    }
    
    
}
