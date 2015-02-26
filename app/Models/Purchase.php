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

}
