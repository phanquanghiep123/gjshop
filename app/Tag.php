<?php

namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Tag extends Entity{
    
    const ACTIVE_STATUS = 1;
    const DEACTIVE_STATUS = 0;
    
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function scopeActive($query){
        return $query->where('status', self::ACTIVE_STATUS)->orderBy('name','ASC');
    }

    public function articles(){
        return $this->belongsToMany("App\Article",'content_tag','tag_id','resource_id')->withPivot('resource_type')->where('resource_type','article');
    }

    public function recipes(){
        return $this->belongsToMany("App\Recipe",'content_tag','tag_id','resource_id')->withPivot('resource_type')->where('resource_type','recipe');
    }

    public function courses(){
        return $this->belongsToMany("App\Course",'content_tag','tag_id','resource_id')->withPivot('resource_type')->where('resource_type','course');
    }

    public function coaches(){
        return $this->belongsToMany("App\User",'content_tag','tag_id','resource_id')->withPivot('resource_type')->where('resource_type','coach');
    }

    public function foodGuides(){
        return $this->belongsToMany("App\FoodGuide",'content_tag','tag_id','resource_id')->withPivot('resource_type')->where('resource_type','foodguide');
    }

    public function products() {
        return $this->belongsToMany("\Modules\Shop\Models\Product", 'content_tag','tag_id','resource_id')->withPivot('resource_type')->where('resource_type','product');
    }

}
