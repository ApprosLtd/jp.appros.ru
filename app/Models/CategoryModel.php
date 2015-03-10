<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogModel extends Model {

    public $table = 'categories';

    protected $fillable = ['name', 'parent_id', 'project_id'];

    public function products()
    {
        return $this->belongsToMany('\App\Models\ProductModel', 'category_product', 'category_id', 'product_id');
    }

}
