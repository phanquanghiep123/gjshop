<?php


namespace App\Services\VideoShower;

/**
 * Description of Helper
 *
 * @author dinhtrong
 */
class Helper {
    public static function view($path,array $data = []){
        extract($data);
        ob_start();
        require $path;
        $output = ob_get_clean();
        return $output;
    }
}
