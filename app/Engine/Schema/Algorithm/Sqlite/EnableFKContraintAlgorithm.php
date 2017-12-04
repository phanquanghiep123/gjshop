<?php

namespace App\Engine\Schema\Algorithm\Sqlite;

use DB;
use App\Engine\Schema\Algorithm\IEnableFKContraintAlgorithm;

/**
 * Description of EnableFKContraintAlgorithm
 *
 * @author dinhtrong
 */
class EnableFKContraintAlgorithm implements IEnableFKContraintAlgorithm{
    
    
    public function enable() {
        DB::statement('PRAGMA foreign_keys = ON');
    }

}
