<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model {

    protected $fillable = ['user_id', 'description', 'pricing_grid_id', 'pricing_grid_column', 'expiration_time'];

    /**
     * Продукты в закупке
     * @return \App\Models\Product
     */
	public function products()
    {
        return $this->belongsToMany('\App\Models\Product');
    }

    /**
     * Ценовая сетка закупки
     * @return \App\Models\PricingGrid
     */
    public function pricing_grid()
    {
        return $this->belongsTo('\App\Models\PricingGrid');
    }

    /**
     * Возвращает колонки Ценовой сетки, привязанной к данной закупке
     * @param string $order_by
     * @return mixed
     */
    public function getPricingGridColumns($order_by = 'asc')
    {
        $pricing_grid_id = $this->pricing_grid->id;

        $pricing_grid_columns = \App\Models\PricingGridColumn::where('pricing_grid_id', '=', $pricing_grid_id)->orderBy('min_sum', $order_by)->get();

        return $pricing_grid_columns;
    }

    public function getPricingGridMixForProduct($product_id)
    {
        $headers = [];
        $prices = [];

        $pricing_grid_id = $this->pricing_grid->id;

        $pricing_grid_columns = \App\Models\PricingGridColumn::where('pricing_grid_id', '=', $pricing_grid_id)->orderBy('min_sum')->get();

        $columns_ids_arr = [];

        foreach ($pricing_grid_columns as $column) {
            $headers[] = $column->column_title;
            $columns_ids_arr[] = $column->id;
        }

        $product = \App\Models\Product::find($product_id);
        $product_prices = $product->prices($columns_ids_arr);

        $product_prices_unsorted = [];

        foreach ($product_prices as $product_price) {
            $product_prices_unsorted[$product_price->column_id] = $product_price->price;
        }

        foreach ($pricing_grid_columns as $column) {
            $prices[] = $product_prices_unsorted[$column->id];
        }

        return [
            'headers' => $headers,
            'prices' => $prices
        ];
    }

}
