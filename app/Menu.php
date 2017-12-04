<?php namespace App;
   
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const PAGE_ITEM_TYPE = 1;
    const CATEGORY_ITEM_TYPE = 2;
    const LINK_ITEM_TYPE = 3;

    protected $fillable = ['name','items'];
    
    protected $casts = [
        'items' => 'array',
    ];
}