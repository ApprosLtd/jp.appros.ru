<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsInPurchaseModel extends Model {

    protected $table = 'products_in_purchase';

    protected $fillable = ['purchase_id', 'product_id', 'product_data'];

    public static function create(array $attributes)
    {
        $purchase_id = array_get($attributes, 'purchase_id');
        $product_id = array_get($attributes, 'product_id');

        if (!$purchase_id or !$product_id) {
            return null;
        }

        $first = \App\Models\ProductsInPurchaseModel::where('purchase_id', '=', $purchase_id)
                    ->where('product_id', '=', $product_id)
                    ->first();

        if ($first) {
            return null;
        }

        return parent::create($attributes);
    }

    public function product()
    {
        return $this->belongsTo('\App\Models\ProductModel');
    }

    public function purchase()
    {
        return $this->belongsTo('\App\Models\PurchaseModel');
    }

    public function image()
    {
        //
    }

    public function alias()
    {
        return 'product-' . $this->product->id . '_' . $this->purchase->id;
    }

    public function stars()
    {
        return rand(1,5);
    }

    public function getFullData()
    {
        return json_decode($this->data);
    }
}