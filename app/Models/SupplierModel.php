<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель "Поставщик товаров"
 * @package App\Models
 */
class SupplierModel extends Model {

    protected $table = 'suppliers';

    protected $fillable = ['user_id', 'name', 'description'];

    /**
     * Товары поставщика
     * @return \App\Models\ProductModel
     */
    public function products()
    {
        return $this->hasMany('\App\Models\ProductModel', 'supplier_id');
    }

}