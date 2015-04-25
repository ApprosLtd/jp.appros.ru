<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель "Закупка"
 * @package App\Models
 */
class PurchaseModel extends Model {

    public $table = 'purchases';

    protected $fillable = ['user_id', 'name', 'description', 'pricing_grid_id', 'expiration_time', 'supplier_id'];

    /**
     * "Продавец"
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    /**
     * "Поставщик товаров"
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('\App\Models\SupplierModel');
    }

    /**
     * Продукты в закупке
     * @return \App\Models\ProductModel
     */
	public function products()
    {
        return $this->belongsToMany('\App\Models\ProductModel', 'products_in_purchase', 'purchase_id', 'product_id');
    }

    /**
     * Продукты в закупке
     * @return \App\Models\ProductModel
     */
	public function pricing_grid_columns()
    {
        return $this->belongsToMany('\App\Models\PricingGridColumnModel', 'pricing_grids_columns_in_purchase', 'purchase_id', 'column_id');
    }

    /**
     * Прикрепляет продукт к закупке
     * @param $product_model_or_id - ID продукта или модель продукта
     * @return bool
     */
    public function appendProduct($product_model_or_id)
    {
        if ($product_model_or_id instanceof \App\Models\ProductModel) {
            $this->products()->attach($product_model_or_id->id);
            return true;
        }

        if (is_numeric($product_model_or_id)) {
            $this->products()->attach($product_model_or_id);
            return true;
        }

        return false;
    }

    /**
     * Открепляет продукт от закупки
     * @param $product_model_or_id - ID продукта или модель продукта
     * @return bool
     */
    public function removeProduct($product_model_or_id)
    {
        if ($product_model_or_id instanceof \App\Models\ProductModel) {
            $this->products()->detach($product_model_or_id->id);
            return true;
        }

        if (is_numeric($product_model_or_id)) {
            $this->products()->detach($product_model_or_id);
            return true;
        }

        return false;
    }

    public function setPricingGridColumns($beginning_column_id, $final_column_id = null)
    {
        $pricing_grid_columns_ids_arr = [];

        /**
         * @var $beginning_column_model \App\Models\PricingGridColumnModel
         */
        $beginning_column_model = \App\Models\PricingGridColumnModel::find($beginning_column_id);
        \App\Helpers\Assistant::assertModel($beginning_column_model, 'Не найдено модели PricingGridColumnModel с идентификатором ID#' . $beginning_column_id);

        $pricing_grid_model = $beginning_column_model->pricing_grid();
        \App\Helpers\Assistant::assertModel($pricing_grid_model, 'Не найдено связанной модели PricingGridModel с моделью PricingGridColumnModel ID#' . $beginning_column_id);

        $pricing_grid_columns_ids_arr[] = $beginning_column_model->id;

        $final_column_id = intval($final_column_id);

        if ($final_column_id) {
            $pricing_grid_columns_models = $pricing_grid_model->columns();
            \App\Helpers\Assistant::assertNotEmpty($pricing_grid_columns_models, 'Модель PricingGridModel ID#' . $pricing_grid_model->id . ' не имеет ценовых колонок');

            foreach ($pricing_grid_columns_models as $pricing_grid_column_model) {
                $pricing_grid_columns_ids_arr[] = $pricing_grid_column_model->id;
                if ($pricing_grid_column_model->id = $final_column_id) {
                    break;
                }
            }

            \App\Helpers\Assistant::assert(in_array($final_column_id, $pricing_grid_columns_ids_arr));
        }

        $this->pricing_grid_columns()->attach($pricing_grid_columns_ids_arr);

        return true;
    }

    public function clearPricingGridColumns()
    {
        //
    }

    /**
     * Ценовая сетка закупки
     * @return \App\Models\PricingGridModel
     */
    public function pricing_grid()
    {
        return $this->belongsTo('\App\Models\PricingGridModel');
    }

    /**
     * Возвращает колонки Ценовой сетки, привязанной к данной закупке
     * @param string $order_by
     * @return mixed
     */
    public function getPricingGridColumns($order_by = 'asc')
    {
        //$pricing_grid_id = $this->pricing_grid()->first()->id;
        $pricing_grid_id = 1;

        $pricing_grid_columns = \App\Models\PricingGridColumnModel::where('pricing_grid_id', '=', $pricing_grid_id)->orderBy('min_sum', $order_by)->get();

        return $pricing_grid_columns;
    }

    /**
     * Возвращает структуру цен по ценовым колонкам для продукта
     * @param $product_id
     * @return array
     */
    public function getPricingGridMixForProduct($product_id)
    {
        $headers = [];
        $prices = [];

        $pricing_grid_id = $this->pricing_grid->id;

        /**
         * TODO: здень неправильно запрашивается ценовая колонка, нужно определять еще саму закупку
         */
        $pricing_grid_columns = \App\Models\PricingGridColumnModel::where('pricing_grid_id', '=', $pricing_grid_id)->orderBy('min_sum')->get();

        $columns_ids_arr = [];

        foreach ($pricing_grid_columns as $column) {
            $headers[] = $column->column_title;
            $columns_ids_arr[] = $column->id;
        }

        /**
         * TODO: здень нужно выбирать только продукт для данной закупки, т.е. \App\Models\ProductInPurchaseModel, через $this->products()
         */
        $product = \App\Models\ProductModel::find($product_id);
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
