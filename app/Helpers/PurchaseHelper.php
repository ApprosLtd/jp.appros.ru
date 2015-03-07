<?php namespace App\Helpers;


class PurchaseHelper {

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

}