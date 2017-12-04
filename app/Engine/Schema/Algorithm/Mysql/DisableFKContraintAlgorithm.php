<?php

namespace App\Engine\Schema\Algorithm\Mysql;

use DB;
use App\Engine\Schema\Algorithm\IDisableFKContraintAlgorithm;

/**
 * Description of DisableFKContraintAlgorithm
 *
 * @author dinhtrong
 */
class DisableFKContraintAlgorithm implements IDisableFKContraintAlgorithm {
    
    public function disable() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }

}
