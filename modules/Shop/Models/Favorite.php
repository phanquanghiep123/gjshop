<?php

namespace Modules\Shop\Models;

/**
 * Description of ShippingMethods
 *
 * @author dinhtrong
 */
class Favorite extends Model {
    
    protected $table = 'user_favorites';
    
    protected $fillable = [
        'user_id','product_id','id'
    ];

    
}
