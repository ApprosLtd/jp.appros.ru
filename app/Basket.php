<?php namespace App;

class Basket {

    const TABLE_PRODUCTS_IN_BASKETS = 'orders';

    protected $user_id = null;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getPurchasesQuantity()
    {
        $purchases_quantity = \DB::table(self::TABLE_PRODUCTS_IN_BASKETS)
            ->where('user_id', '=', $this->user_id)
            ->sum('amount');

        return $purchases_quantity;
    }

    public function addProduct($product_in_purchase_id, $amount = 1)
    {
        $products_in_baskets = \DB::table(self::TABLE_PRODUCTS_IN_BASKETS)
            ->select('*')
            ->where('user_id', '=', $this->user_id)
            ->where('product_id', '=', $product_in_purchase_id)
            ->first();

        if ($products_in_baskets) {

            $new_amount = $products_in_baskets->amount + $amount;

            \DB::table(self::TABLE_PRODUCTS_IN_BASKETS)
                ->where('user_id', '=', $this->user_id)
                ->where('product_id', '=', $product_in_purchase_id)
                ->update(['amount' => $new_amount]);
        } else {
            \DB::table(self::TABLE_PRODUCTS_IN_BASKETS)->insert([
                'user_id' => $this->user_id,
                'product_id' => $product_in_purchase_id,
                'amount' => 1
            ]);
        }
    }

}