<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingGrid extends Model {

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
        return $this->belongsToMany('\App\Models\Project', 'projects_pricing_grids');
    }

    public function columns()
    {
        return $this->hasMany('\App\Models\PricingGridColumn');
    }

}
