<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['user_id', 'name', 'description'];

    public function delete()
    {
        \DB::table(\App\Helpers\Project::PRICES_TABLE_NAME)->where('product_id', '=', $this->id)->delete();
        \DB::table('category_product')->where('product_id', '=', $this->id)->delete();
        \DB::table('attribute_values')->where('product_id', '=', $this->id)->delete();

        parent::delete();
    }

    public function purchases()
    {
        return $this->belongsToMany('\App\Models\Purchase');
    }

    public function categories()
    {
        return $this->belongsToMany('\App\Models\Category');
    }

    public function attributes()
    {
        return $this->hasMany('\App\Models\AttributeValue');
    }

    public function media($type = null)
    {
        $media = $this->hasMany('\App\Models\MediaModel')->orderBy('position');

        if ($type) {
            $media = $media->where('type', '=', $type);
        }

        return $media;
    }

    /**
     * Возвращает коллекцию цен данного продукта для связанных "Ценовых сеток"
     * @return mixed
     */
    public function prices()
    {
        return \DB::table(\App\Helpers\Project::PRICES_TABLE_NAME)->where('product_id', $this->id)->get(['column_id', 'price']);
    }

}
