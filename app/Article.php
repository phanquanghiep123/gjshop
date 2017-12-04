<?php

namespace App;

/**
 * Description of Article
 *
 * @author dinhtrong
 */
class Article extends Entity {

    protected $fillable = [
        'title',
        'revised_title',
        'list_image',
        'slug',
        'user_id',
        'author',
        'description',
        'content',
        'revised_content',
        'meta_keywords',
        'meta_description',
        'video_link',
        'video_placeholder',
        'status',
        'post_date',
        'approved',
        'approved_date',
        'approved_by',
    ];
    
    protected $dates = ['created_at','updated_at','post_date','approved_date'];

    /*
     * Constant value for roles
     */

    const APPROVED = 1;
    const PENDING  = 2;
    const REJECTED  = 3;
    const PUBLISHED = 1;
    const UNPUBLISHED  = 2;

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function tags(){
        return $this->belongsToMany("App\Tag",'content_tag','resource_id')->withPivot('resource_type')->where('resource_type','article');
    }

    public function scopeApproved($query){
        return $query->where('approved', self::APPROVED);
    }

    public function scopePublished($query){
        return $query->where('status', self::PUBLISHED)->where('approved', self::APPROVED);
    }

    public function scopePosted($query){
        return $query->where('post_date','<=',date('Y-m-d'));
    }

    public static function scopeLatestPostedArticle(){
        return Article::orderBy('post_date','DESC')->take(8);
    }

    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function latestArticles($user_id,$article_id){
        return Article::where('user_id',$user_id)->where('id','!=',$article_id)->orderBy('post_date','DESC')->take(8)->get();
    }

    public function products()
    {
        return $this->belongsToMany('\Modules\Shop\Models\Product','article_product' ,'article_id','product_id');
    }

    public function getPostDateAttribute($value) {
        try {
            return \Carbon\Carbon::createFromFormat('Y-m-d', $value)->format("D, d M Y");
        } catch (\Exception $exc) {
            return NULL;
        }
    }

    public function getAllCategoriesID(){
        $result = [];
        foreach ($this->categories as $cat){
            $result[] = $cat->id;
        }
        return $result;
    }
}