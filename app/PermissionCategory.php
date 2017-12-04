<?php 

namespace App;
  

class PermissionCategory extends Entity
{

	const ACTIVE = 1;
    const INACTIVE = 0;

    protected $table = 'permission_categories';
    protected $fillable = [
		'name',
        'status',
        'position',
	];


	public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }


    public function comments()
    {
        return $this->hasMany('App\Permission', 'category_id', 'id');
    }

}
