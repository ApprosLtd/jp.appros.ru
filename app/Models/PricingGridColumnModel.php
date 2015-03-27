<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingGridColumnModel extends Model {

	public $table = 'pricing_grids_columns';

    /**
     * Ценовая сетка колонки
     * @return \App\Models\PricingGridModel
     */
    public function pricing_grid()
    {
        return $this->belongsTo('\App\Models\PricingGridModel');
    }

}
