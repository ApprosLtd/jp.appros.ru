<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	public function categories()
    {
        return $this->hasMany('\App\Models\Category');
    }

    public function pricing_grids()
    {
        return $this->hasMany('\App\Models\PricingGrid');
    }

}
