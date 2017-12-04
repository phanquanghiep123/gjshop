<?php

namespace Modules\Shop\NonProductItem;

/**
 * Description of Course
 *
 * @author dinhtrong
 */
class Course {
    
    protected $name;
    protected $price;
    protected $tax = 0;
    protected $ship = 0;
    protected $weight = 0;
    protected $quantily = 0;
    protected $image;
    protected $slug;
    protected $description;
    
    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
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

    public function getImage() {
        return $this->image;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
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

    public function setQuantily($quantily) {
        $this->quantily = $quantily;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function setDescription($description) {
        $this->description = $description;
    }


    
    
}
