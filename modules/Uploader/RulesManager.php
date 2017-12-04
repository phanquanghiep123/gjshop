<?php

namespace Modules\Uploader;

/**
 * Description of RulesManager
 *
 * @author dinhtrong
 */
class RulesManager {
    
    private $rules;
    
    public function __construct($rules = NULL) {
        if(!$rules){
            $this->rules = $rules; 
        }
    }
    
    public function encrypt($rules=NULL){
        if(!$rules){
            $this->rules = $rules;
        }
        return encrypt($this->rules);
    }
    
    public function decrypt($rulesCode){
        try {
            return decrypt($rulesCode);
        } catch (Exception $ex) {
            throw  new Exceptions\WrongRulesFormatException;
        }
    }
}
