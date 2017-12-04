<?php

namespace Modules\Shop;

/**
 * Description of Item
 *
 * @author dinhtrong
 */
class Item {
    
    protected $name;
    protected $price;
    protected $oldPrice;
    protected $options = [];
    protected $tax = 0;
    protected $ship = 0;
    protected $weight = 0;
    protected $quantily = 0;
    protected $image;
    protected $slug;
    protected $description;
    protected $UKSize;
    protected $USSize;
    protected $points;

    public function getName() {
        return $this->name;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getTax() {
        return $this->tax;
    }

    public function getShip() {
        return $this->ship;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getQuantily() {
        return $this->quantily;
    }

    
    public function setName($name) {
        $this->name = $name;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    public function setTax($tax) {
        $this->tax = $tax;
    }

    public function setShip($ship) {
        $this->ship = $ship;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setQuantity($quantily) {
        $this->quantily = $quantily;
    }
    
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function getOldPrice() {
        return $this->oldPrice;
    }

    public function setOldPrice($salePrice) {
        $this->oldPrice = $salePrice;
    }

    
    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
    
    public function getQuantity(){
        return $this->quantily;
    }
    
    public function addQuantity($quantity){
        $this->quantily += $quantity;
    }
    
    public function getSubtotal(){
        return ($this->quantily > 0) ? $this->price * $this->quantily : $this->price;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
    
    public function getUKSize() {
        return $this->UKSize;
    }

    public function getUSSize() {
        return $this->USSize;
    }

    public function setUKSize($UKSize) {
        $this->UKSize = $UKSize;
    }

    public function setUSSize($USSize) {
        $this->USSize = $USSize;
    }
    public function getPoints() {
        return $this->points;
    }

    public function setPoints($points) {
        $this->points = $points;
    }

}
