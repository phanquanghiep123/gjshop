<?php

namespace App\Services;

/**
 * Description of ArrayRamdom
 *
 * @author dinhtrong
 */
class ArrayRamdomService {

    protected $array;

    public function __construct($array) {
        $this->array = $array;
    }

    public function ramdomElement($except = NULL) {
        if (empty($this->array)) {
            return NULL;
        }
        $rand_keys = array_rand($this->array, 1);
        $value     = $this->array[$rand_keys];
        if ($except == $value) {
            if (isset($this->array[$rand_keys - 1])) {
                return $this->array[$rand_keys - 1];
            } elseif (isset($this->array[$rand_keys + 1])) {
                return $this->array[$rand_keys + 1];
            }
        }
        return $value;
    }

    public function ramdomSubArray($number) {
        if (empty($this->array) && !$number) {
            return NULL;
        }
        $total = count($this->array);
        if ($number == 1) {
            return [$this->ramdomElement()];
        } elseif ($number > $total) {
            return $this->array;
        }
        $rand_keys = array_rand($this->array, $number);
        $return    = [];
        foreach ($rand_keys as $key) {
            $return[] = $this->array[$key];
        }
        return $return;
    }

}
