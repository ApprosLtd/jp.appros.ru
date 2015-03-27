<?php namespace App\Helpers;


class CatalogHelper {

    public static function getProducts($purchase_id = null, $catalog_id = null, $limit = 40, $offset = 0)
    {
        $products_in_purchase = \App\Models\ProductModel::offset($offset)->take($limit)->get();

        return $products_in_purchase;
    }

}