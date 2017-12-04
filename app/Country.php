<?php 

namespace App;
  

class Country extends Entity
{

    protected $table = 'countries';
    protected $fillable = [
		'name',
        'nationality',
        'flag',
	];

}
