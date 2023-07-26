<?php

use Phalcon\Mvc\Model;

class Settings extends Model
{
    public $titleoptimization;
    public $defaultprice;
    public $defaultzipcode;
    public $defaultstock;

    public function initialize()
    {
        $this->setSource('settings'); // Set the table name explicitly (optional if table name matches the model class name)
    }
}