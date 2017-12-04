<?php
namespace App;

use DB;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class FaqCategory extends Entity{
    
    protected $guarded = array('id');
    protected $table = 'faqs_categories';

    const ACTIVE = 1;
    const INACTIVE = 2;


    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }

    public function questions()
    {
        return $this->hasMany('App\Faq','faq_category_id','id');
    }

    public static function faqs()
    {
       $data = DB::table('faqs')
                ->leftjoin('faqs_categories','faqs_categories.id','=','faqs.faq_category_id')
                ->select(DB::raw('faqs.id as faq_id,faqs.question,faqs.answer,faqs_categories.name,faqs_categories.id as category_id'))->get();
       return $data;
    }
}
