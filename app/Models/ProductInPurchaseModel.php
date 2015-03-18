<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInPurchaseModel extends Model {

    public $table = 'products_in_purchase';

    public $grid_columns = [
        [
            'text' => 'ID',
            'dataIndex' => 'id',
            'width' => 50
        ],
        [
            'text' => 'Наименование',
            'dataIndex' => 'name',
            'flex' => 1
        ],
        [
            'text' => 'Цена',
            'dataIndex' => 'price',
            'width' => 100
        ],
    ];

    public function __set($name, $value)
    {
        //
    }

    public function getPrice()
    {
        return 6789;
    }
}