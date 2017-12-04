<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Faq extends Entity{
    
    protected $guarded = ['id'];
    protected $table = 'faqs';

    const ACTIVE = 1;
    const INACTIVE = 2;


    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }

    public function faqcategory() {
        return $this->belongsTo('\App\FaqCategory', 'faq_category_id');
    }
}

