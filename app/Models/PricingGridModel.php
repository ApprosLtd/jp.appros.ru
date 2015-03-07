<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingGridModel extends Model {

    public $table = 'pricing_grids';

    protected $fillable = ['user_id', 'name', 'description'];

    public static function getPricingGridsForCurrentUser()
    {
        $user = \Auth::user();

        if (!$user) {
            return [];
        }

        $result = self::where('user_id', '=', $user->id)->get(['id', 'name']);

        if (!$result) {
            return [];
        }

        return $result;
    }

    public function projects()
    {
        return $this->belongsToMany('\App\Models\ProjectModel', 'projects_pricing_grids', 'pricing_grid_id', 'project_id');
    }

    public function columns()
    {
        return $this->hasMany('\App\Models\PricingGridColumnModel', 'pricing_grid_id');
    }

    /**
     * Устанавливает значение колонки цены
     * @param $price_code
     * @param $price_value
     * @param $product_id
     */
    public static function setPriceByPriceCode($price_code, $price_value, $product_id)
    {
        $matches = [];

        preg_match('/^col_([\d]+)$/', $price_code, $matches);

        if (count($matches) != 2) {
            return false;
        }

        $price_value = str_replace(' ', '', $price_value);
        $price_value = str_replace(',', '.', $price_value);

        $column_id = intval($matches[1]);

        $column_price = \DB::table(\App\Helpers\ProjectHelper::PRICES_TABLE_NAME)->where('product_id', $product_id)->where('column_id', $column_id)->first();

        if ($column_price) {
            \DB::table(\App\Helpers\ProjectHelper::PRICES_TABLE_NAME)
                ->where('product_id', $product_id)
                ->where('column_id', $column_id)
                ->update([
                    'product_id' => $product_id,
                    'column_id' => $column_id,
                    'price' => floatval($price_value),
                ]);
        } else {
            \DB::table(\App\Helpers\ProjectHelper::PRICES_TABLE_NAME)
                ->insert([
                    'product_id' => $product_id,
                    'column_id' => $column_id,
                    'price' => floatval($price_value),
                ]);
        }
    }

}
