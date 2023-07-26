<?php

use Phalcon\Mvc\Model;

class Orders extends Model
{
    public $customername;
    public $description;
    public $zipcode;
    public $product;
    public $stock;
    
    
    public function initialize()
    {
        $this->setSource('orders'); // Set the table name explicitly (optional if table name matches the model class name)
    }

    public function getId()
    {
        return $this->id; 
    }

    public function getProduct()
    {
        return $this->product; 
    }

    public function getCustomername()
    {
        return $this->customername; 
    }

    public function getZipcode()
    {
        return $this->zipcode; 
    }

    public function getStock()
    {
        return $this->stock; 
    }

    public function getStock()
    {
        return $this->stock; 
    }
}