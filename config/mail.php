<?php

return [

	'driver' => 'smtp',

    'host' =>'gator4119.hostgator.com',

    'port' => '465',

    'encryption' => 'ssl',

    'username' => 'no-reply@nurturedforliving.com',

    'password' => 'nurtur3d4l1v1ng',

    'sendmail' => '/usr/sbin/sendmail -bs',

    'pretend' => false,
    
    'from' => ['address' => 'no-reply@nurturedforliving.com', 'name' => 'Nurtured For Living'],

];
