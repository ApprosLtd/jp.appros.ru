<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['user_id', 'name', 'description'];

    public function purchases()
    {
        return $this->belongsToMany('\App\Models\Purchase');
    }

}
