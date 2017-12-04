<?php

namespace App\Engine\Schema\Algorithm\Mysql;

use DB;
use App\Engine\Schema\Algorithm\IEnableFKContraintAlgorithm;

/**
 * Description of EnableFKContraintAlgorithm
 *
 * @author dinhtrong
 */
class EnableFKContraintAlgorithm implements IEnableFKContraintAlgorithm{
    
    public function enable() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
