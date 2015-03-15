<?php namespace App\Models;

class ProductInPurchaseModel extends ProductModel {

    public $table = 'products_in_purchase';

    public function __set($name, $value)
    {
        //
    }

    public function getPrice()
    {
        return 6789;
    }
}