<?php

function size_of_var($var) {
    $start_memory = memory_get_usage();
    $var = unserialize(serialize($var));
    $size = memory_get_usage() - $start_memory - PHP_INT_SIZE * 8;
    if ($size < 1024) {
        return $size . ' Bytes';
    } else {
        return round($size / 1024, 2) . ' KB';
    }
}

function can($permission) {
    $user = Auth::user();
    if ($user) {
        return $user->canDo($permission);
    } else {
        return false;
    }
}

function truncateText($string, $limit, $break = ".", $pad = "...") {
    // return with no change if string is shorter than $limit
    if (strlen($string) <= $limit)
        return $string;

    // is $break present between $limit and the end of the string?
    if (false !== ($breakpoint = strpos($string, $break, $limit))) {
        if ($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }
    return $string;
}

/** @return \Modules\Shop\Cart */
function cart() {
    return \Modules\Shop\Cart::getCurrent();
}

function weightInKg($gram) {
    $weight = $gram / 1000;
    return $weight . ' kg';
}


function minsToHoursOLD($time) {
    if($time <= 60 ){
        return $time;
    } else {
         $hours = $time / 60;
        return $hours;
    }
}

function minsToHours($time, $format = '%2d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}


function discountPercent($originalPrice,$salePrice) {
    return round(( 1 - ( $salePrice / $originalPrice ) ) * 100 ,0, PHP_ROUND_HALF_DOWN) .'%' ;
}

function neat_trim($str, $n, $delim = '...') {
    $str = str_replace("\n", "", $str);
    $str = str_replace("\r", "", $str);
    $str = strip_tags($str);
    $len = strlen($str);
    if ($len > $n) {
        preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
        return rtrim($matches[1]) . $delim;
    } else {
        return $str;
    }
}

function lastLogin() {
    $user = Auth::user();
    $last_access = '';
    if( $user->last_login && $user->last_login2 ){
        $last_access = ( $user->last_login > $user->last_login2  ?  $user->last_login2 : $user->last_login );
    } elseif ( $user->last_login && $user->last_login2 == '') {
        $last_access = $user->last_login;
    }
    return $last_access;
}

function starRating($rating) {
    switch ($rating) {

        case $rating == 'na':
                $stars = '<i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i>';
            break;

        case $rating == '1':
                $stars = '<i class="fa fa-star"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i>';
            break;

        case $rating == '2':
                $stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i>';
            break;

        case $rating == '3':
                $stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i>';
            break;

        case $rating == '4':
                $stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star text-default"></i>';
            break;

        case $rating == '5':
                $stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
            break;
        
        default:
                $stars = '<i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i><i class="fa fa-star text-default"></i>';
            break;
    }
    return $stars;
}

function meetingClass($object) {
    $dateNow = date('Y-m-d - H:i:s');
    switch ($object) {
        case $object->meeting_date < $dateNow;
                $class = 'pastDate';
            break;

        case $object->meeting_date >= $dateNow && $object->status == '1';
                $class = 'currentDate';
            break;

        case $object->meeting_date > $dateNow;
                $class = 'futureDate';
            break;
        
        default:
                $class = 'futureDate';
            break;
    }
    return $class;
}


function checkCourseStatus($course){
    
    /*
        Here we nee to do the following

        1. check the limit against the number of enrolled students.
        2. check the current date agaianst the enrolment close data
         
        if space and time course is open.
    */

    $courseStatus = 'closed';

    $date = date('Y-m-d - h:i:s');
    $futureEnrolment = $course->future_enrollment_open;

    if($course->enrolment_end >= $date ){
        $courseStatus = 'open';
    }
    return $courseStatus;
}


function styles(array $styles){
    foreach ($styles as $styles){
        $rel = preg_match("/.less$/",$styles) ? "stylesheet/less" : 'stylesheet';
        if(preg_match("/(^http\:\/\/)|(^https\:\/\/)/", $styles)){
            echo "<link href='$styles' rel='$rel' type='text/css'>\n";
        }else{
            echo "<link href='".url($styles)."' rel='$rel' type='text/css'>\n";
        }
    }
}

function scripts(array $scripts){
    foreach ($scripts as $script){
        if(preg_match("/(^http\:\/\/)|(^https\:\/\/)/", $script)){
            echo '<script type="text/javascript" src="'.$script.'"></script>'."\n";
        }else{
            echo '<script type="text/javascript" src="'.url($script).'"></script>'."\n";
        }
    }
}

function clean_string($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

function share($link,$description=''){
    return view('_partials.frontend.share',['link'=>$link,'description'=> $description ? : $link]);
}

// Generates a strong password of N length containing at least one lower case letter,
// one uppercase letter, one digit, and one special character. The remaining characters
// in the password are chosen at random from those four sets.
//
// The available characters in each set are user friendly - there are no ambiguous
// characters such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option,
// makes it much easier for users to manually type or speak their passwords.
//
// Note: the $add_dashes option will increase the length of the password by
// floor(sqrt(N)) characters.

function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
{
    $sets = array();
    if(strpos($available_sets, 'l') !== false)
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    if(strpos($available_sets, 'u') !== false)
        $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    if(strpos($available_sets, 'd') !== false)
        $sets[] = '23456789';
    if(strpos($available_sets, 's') !== false)
        $sets[] = '!@#$%&*?';

    $all = '';
    $password = '';
    foreach($sets as $set)
    {
        $password .= $set[array_rand(str_split($set))];
        $all .= $set;
    }

    $all = str_split($all);
    for($i = 0; $i < $length - count($sets); $i++)
        $password .= $all[array_rand($all)];

    $password = str_shuffle($password);

    if(!$add_dashes)
        return $password;

    $dash_len = floor(sqrt($length));
    $dash_str = '';
    while(strlen($password) > $dash_len)
    {
        $dash_str .= substr($password, 0, $dash_len) . '-';
        $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
}


function pointsValueFormatted($user,$currency = 'GBP'){

    $ratio = Modules\Shop\Models\Setting::where('key','loyalty_points_ratio')->first();
    $value = $user->points / $ratio->value;

    $symbol = '';
    switch ($currency) {
        case 'USB':
            $symbol = '$';
            break;
         case 'GBP':
            $symbol = '£';
            break;
        default:
            $symbol = $currency;
            break;
    }
    return $symbol.number_format($value,2);
}

function pointsValue($user,$currency = 'GBP'){

    $ratio = Modules\Shop\Models\Setting::where('key','loyalty_points_ratio')->first();
    $value = $user->points / $ratio->value;
    return number_format($value,2);
}

function priceValueByPoint($points){
    $ratio = Modules\Shop\Models\Setting::where('key','loyalty_points_ratio')->first();
    $value = $points / $ratio->value;
    return number_format($value,2);
}
function pointValueByprice($price){
    $ratio = Modules\Shop\Models\Setting::where('key','loyalty_points_ratio')->first();
    $value = $price * $ratio->value;
    return  round ($value);
    
}
