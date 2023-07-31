<?php

use Phalcon\Mvc\Model;

class Acls extends Model
{       
    public function initialize()
    {
        $this->setSource('acls'); // Set the table name explicitly (optional if table name matches the model class name)
    }

}