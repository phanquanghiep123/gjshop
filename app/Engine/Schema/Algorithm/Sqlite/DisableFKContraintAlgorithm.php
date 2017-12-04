<?php

namespace App\Engine\Schema\Algorithm\Sqlite;

use DB;
use App\Engine\Schema\Algorithm\IDisableFKContraintAlgorithm;

/**
 * Description of DisableFKContraintAlgorithm
 *
 * @author dinhtrong
 */
class DisableFKContraintAlgorithm implements IDisableFKContraintAlgorithm {
    
    public function disable() {
        DB::statement('PRAGMA foreign_keys = OFF');
    }

}
