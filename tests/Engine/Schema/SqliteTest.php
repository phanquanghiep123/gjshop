<?php

use \Schema as LaravelSchema;
use \DB as LaravelDB;
use App\Engine\Schema\Sqlite;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Description of MysqlTest
 *
 * @author dinhtrong
 */
class SqliteTest extends TestCase {
    
    use DatabaseTransactions;
    
    private $tableName;
    private $relatedTableName;
    private $pk;
    private $fk;
    private $sqliteSchema;
    
    private function initSchema(){
        
        $this->tableName = 'table'.uniqid();
        $this->relatedTableName = 'relate'.uniqid();
        $this->fk = $this->tableName.'_id';
        $this->pk = 'id';
        
        LaravelSchema::create($this->tableName,function(Blueprint $table){
            $table->increments('id');
        });
        LaravelSchema::create($this->relatedTableName,function(Blueprint $table){
            $table->increments('id');
            $table->integer($this->fk)->unsigned();
            $table->foreign($this->fk)
                  ->references('id')->on($this->tableName);
        });
        
        $this->sqliteSchema = new Sqlite();
    }
    
    public function testDisableFKContraint(){
        $this->initSchema();
        $this->sqliteSchema->disableFKContraint();
        
        $sql = "INSERT INTO `{$this->tableName}` VALUES(1)";
        $sql2 = "INSERT INTO `{$this->relatedTableName}` VALUES(1,2)";
        
        
        LaravelDB::statement($sql);
        try {
            LaravelDB::statement($sql2);
        } catch (\Exception $ex) {
            
        }
        
        $this->sqliteSchema->enableFKContraint();
        
        $this->seeInDatabase($this->relatedTableName,['id'=>1,$this->fk=>2]);
        LaravelSchema::dropIfExists($this->relatedTableName);
        LaravelSchema::dropIfExists($this->tableName);
    }
    
    
   
}
