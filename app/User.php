<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Services\Authorization\AuthorizationUserManyRoleTrait;

class User extends Authenticatable implements \Illuminate\Contracts\Auth\CanResetPassword
{

    use AuthorizationUserManyRoleTrait;
    use \Illuminate\Auth\Passwords\CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'username',
        'country',
        'city',
        'town',
        'zip_code',
        'address',
        'gender',
        'email',
        'coach_contact_email',
        'author_contact_email',
        'mobile',
        'avatar',
        'mini_bio_approved',
        'mini_bio_pending',
        'author_bio_review',
        'author_bio_review',
        'coach_bio_approved',
        'coach_bio_pending',
        'coach_bio_review',
        'coaches',
        'coach_id',
        'bio_approved',
        'bio_pending',
        'bio_review',
        'password',
        'status',
        'ip',
        'last_login',
        'last_login2',
        'remember_me',
        'remember_token',
        'facebook',
        'twitter',
        'youtube',
        'pintrest',
        'instagram',
        'linkedin',
        'google',
        'coach_website',
        'coach_linkedin',
        'coach_youtube',
        'coach_instagram',
        'coach_google',
        'coach_pinterest',
        'coach_twitter',
        'coach_facebook',
        'website',
        'chef_bio_pending',
        'chef_bio_approved',
        'chef_bio_review',
        'chef_avatar'
    ];

    const ACTIVE = 1;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }

    public function fullname()
    {
        return $this->f_name . ' ' . $this->l_name;
    }

    public function getFullnameAttribute()
    {
        return $this->f_name . ' ' . $this->l_name;
    }

    public function articles()
    {
        return $this->hasMany('\\App\\Article', 'user_id', 'id');
    }

    public function vouchers()
    {
        return $this->hasMany('\App\Voucher', 'assigned_to_user', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany("App\Tag", 'content_tag', 'resource_id')->withPivot('resource_type')->where('resource_type', 'coach');
    }

    public function productNotifications()
    {
        return $this->hasMany('\Modules\Shop\Models\StockNotificationEmail', 'user_id', 'id');
    }

    public function referrals()
    {
        return $this->belongsToMany('App\User', 'referrers', 'referrer_id', 'referral_id');
    }

    public function referrer()
    {
        return $this->belongsToMany('App\User', 'referrers', 'referral_id', 'referrer_id');
    }

    public function addresses()
    {
        return $this->hasMany('\App\CustomerAddress', 'user_id', 'id');
    }
    
    public function defaultAddress()
    {
        return $this->hasOne('\App\CustomerAddress', 'user_id', 'id')->where('default', 1);
    }

    public function getOrders()
    {
        return \Modules\Shop\Models\Order::where('user_id', $this->id)->orderBy('created_at', 'DESC')->get();
    }

    public function getPendingShippingOrders()
    {
        return \Modules\Shop\Models\Order::where('user_id', $this->id)->where('status',1)->orderBy('created_at', 'DESC')->get();
    }

    public function getOrdersQuery()
    {
        return \Modules\Shop\Models\Order::where('user_id', $this->id)->orderBy('created_at', 'DESC');
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany("\Modules\Shop\Models\Product", 'shop_favorites_products', 'user_id', 'shop_product_id')
                ->withPivot('created_at')->orderBy('pivot_created_at', 'desc');
    }

    public function favoriteArticles()
    {
        return $this->belongsToMany("\App\Article", 'favorite_articles', 'user_id', 'article_id')
                ->withPivot('created_at')->orderBy('pivot_created_at', 'desc');
    }

    public function favorites()
    {
        return \Modules\Shop\Models\Favorite::where('user_id', $this->id)
                ->leftjoin('shop_products', 'user_favorites.product_id', '=', 'shop_products.id')
                ->select('shop_products.name', 'shop_products.slug', 'user_favorites.id as favorite_id')
                ->get();
    }

    public function is($role)
    {
        return $this->roles()->where('slug', $role)->take(1)->count();
        $data = [
            'name' => 'trong',
            'email' => 'email@email.com',
            'department' => 'department',
            'message' => 'message'
        ];
        \Mail::queue('emails.c', ['data' => $data], function($message) {
            $message->to('trandinhtrongit@gmail.com');
            $message->subject('Notificacion');
        });
    }
}
