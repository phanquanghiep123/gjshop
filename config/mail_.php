<?php

return [

	'driver' => 'smtp',

    'host' =>'smtp.gmail.com',

    'port' => '587',

    'encryption' => 'tls',

    'username' => 'famelevel@gmail.com',

    'password' => 'trang721',

    'sendmail' => '/usr/sbin/sendmail -bs',

    'pretend' => false,
    
    'from' => ['address' => 'famelevel@gmail.com', 'name' => 'Nurtured Forliving'],

];
