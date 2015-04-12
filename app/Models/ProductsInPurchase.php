<?php namespace App\Models;


class ProductsInPurchase {

    protected $product_model = null;

    protected $purchase_model = null;

    public function __construct($product_id, $purchase_id)
    {
        $this->product_model = \App\Models\ProductModel::find($product_id);

        $this->purchase_model = \App\Models\PurchaseModel::find($purchase_id);

        if (!$this->product_model or !$this->purchase_model) {
            return null;
        }
    }

    public function product()
    {
        return $this->product_model;
    }

    public function purchase()
    {
        return $this->purchase_model;
    }

    public function alias()
    {
        return 'product-' . $this->product()->id . '_' . $this->purchase()->id;
    }

    public function stars()
    {
        return rand(1,5);
    }
}