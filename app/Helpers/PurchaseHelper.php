<?php namespace App\Helpers;


class PurchaseHelper {

    public static function getProductsAvailableForSale($limit = 40, $offset = 0)
    {
        $products_in_purchase_relations = \DB::table('products_in_purchase')->get();

        if (empty($products_in_purchase_relations)) {
            return [];
        }

        $products_in_purchase_arr = [];

        foreach ($products_in_purchase_relations as $product_in_purchase_relation) {
            $product_in_purchase = new \App\Models\ProductsInPurchase($product_in_purchase_relation->product_id, $product_in_purchase_relation->purchase_id);

            if ($product_in_purchase) {
                $products_in_purchase_arr[] = $product_in_purchase;
            }
        }

        //$products_in_purchase_arr = \App\Models\ProductModel::offset($offset)->take($limit)->get();

        return $products_in_purchase_arr;
    }

    /**
     * Возвращает коллекцию данных для построения "Таблицы цен"
     * @param $product_id
     * @param $purchase_id
     * @return array
     */
    public static function getPricingGridMixForProduct($product_id, $purchase_id)
    {

        /**
         * @var $product \App\Models\ProductModel
         * @var $purchase \App\Models\PurchaseModel
         */
        $product = \App\Models\ProductModel::find($product_id);
        $purchase = \App\Models\PurchaseModel::find($purchase_id);

        $pricing_grid_columns = $purchase->getPricingGridColumns();

        $columns_ids_arr = [];
        foreach ($pricing_grid_columns as $column) {
            $columns_ids_arr[] = $column->id;
        }

        $product_prices = $product->prices($columns_ids_arr);
        $product_prices_unsorted = [];
        foreach ($product_prices as $product_price) {
            $product_prices_unsorted[$product_price->column_id] = $product_price->price;
        }

        $rows = [];

        foreach ($pricing_grid_columns as $column) {

            $rows[] = [
                'title' => $column->column_title,
                'expiry_date' => date('d.m.Y H:i'),
                'price' => $product_prices_unsorted[$column->id],
            ];
        }


        return $rows;
    }

    /**
     * Возвращает ID продукта по псевдониму(URL)
     * @param $alias
     * @return int|null
     */
    public static function getProductIdByAlias($alias)
    {
        $matches = [];

        preg_match('/^(\d+)_/', $alias, $matches);

        if (count($matches) != 2) {
            return null;
        }

        return (int) $matches[1];
    }

    /**
     * Возвращает ID закупки по псевдониму(URL)
     * @param $alias
     * @return int|null
     */
    public static function getPurchaseIdByAlias($alias)
    {
        $matches = [];

        preg_match('/_(\d+)$/', $alias, $matches);

        if (count($matches) != 2) {
            return null;
        }

        return (int) $matches[1];
    }

}