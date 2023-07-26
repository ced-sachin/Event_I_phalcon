<?php

use Phalcon\Mvc\Controller;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Orders;


class OrdersController extends Controller
{
    public function indexAction()
    {  // die('index action not implemented');
       $form = new Form();
       $products = Products::find();
    }
    public function addAction()
    {  // die('add action not implemented');
        $form = new Form();
            
    }
}