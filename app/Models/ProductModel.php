<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model {

    public $table = 'products';

    protected $fillable = ['user_id', 'name', 'description'];

    public function delete()
    {
        \DB::table(\App\Helpers\ProjectHelper::PRICES_TABLE_NAME)->where('product_id', '=', $this->id)->delete();
        \DB::table('category_product')->where('product_id', '=', $this->id)->delete();
        \DB::table('attribute_values')->where('product_id', '=', $this->id)->delete();

        $media = $this->media()->get();
        if ($media->count()) {
            foreach ($media as $media_object) {
                $media_object->delete();
            }
        }

        parent::delete();
    }

    public function purchases()
    {
        return $this->belongsToMany('\App\Models\PurchaseModel', 'products_in_purchase', 'product_id', 'purchase_id');
    }

    public function categories()
    {
        return $this->belongsToMany('\App\Models\CatalogModel', 'category_product', 'product_id', 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany('\App\Models\AttributeValueModel', 'product_id');
    }

    public function media($type = null)
    {
        $media = $this->hasMany('\App\Models\MediaModel', 'product_id')->orderBy('position');

        if ($type) {
            $media = $media->where('type', '=', $type);
        }

        return $media;
    }

    /**
     * Возвращает коллекцию цен данного продукта для связанных "Ценовых сеток",
     * @param int $column_id
     * @return array
     */
    public function prices(array $columns_ids_arr = [])
    {
        $res = \DB::table(\App\Helpers\ProjectHelper::PRICES_TABLE_NAME)->where('product_id', $this->id);

        if (!empty($columns_ids_arr)) {
            $res = $res->whereIn('column_id', $columns_ids_arr);
        }

        return $res->get(['column_id', 'price']);
    }

    public function getFirstPriceByPurchaseId($purchase_id)
    {
        //
    }

    /**
     * Возвращает значение атрибута, связанного с продуктом
     * @param $attribute_name
     * @return mixed
     */
    public function attr($attribute_name)
    {
        $attribute_name = trim($attribute_name);

        $attribute_obj = \App\Models\AttributeModel::where('name', '=', $attribute_name)->first(['id']);

        $attribute_value_obj = $this->attributes()->where('attribute_id', '=', $attribute_obj->id)->first(['value']);

        return $attribute_value_obj->value;
    }

}
