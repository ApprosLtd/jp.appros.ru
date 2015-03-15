<?php namespace App\Http\Controllers\Rest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductController extends RestController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $start = intval(\Input::get('start', 0));
        $limit = intval(\Input::get('limit', 40));

        $root_category_id = intval(\Input::get('root_category_id', \App\Models\CatalogModel::ROOT_NESTED_SETS_ID));

        if ($root_category_id == \App\Models\CatalogModel::ROOT_NESTED_SETS_ID) {

            $products = \App\Models\ProductModel::offset($start)->take($limit)->get(['id', 'name']);

        } else {

            $ns_categories_list = \App\Models\CatalogModel::find($root_category_id)->descendants()->get(['id']);

            $categories_ids_arr = [$root_category_id];
            if ($ns_categories_list->count()) {
                foreach ($ns_categories_list as $ns_category) {
                    $categories_ids_arr[] = intval($ns_category->id);
                }
            }

            $products = \App\Models\ProductModel::offset($start)
                ->take($limit)
                ->leftJoin('category_product', function($join) {
                    $join->on('products.id', '=', 'category_product.product_id');
                })
                ->whereIn('category_product.category_id', $categories_ids_arr)
                ->get(['id', 'name']);

        }

        if (!$products) {
            return [];
        }

        $data = [];

        $pricing_grid_id = intval(\Input::get('pricing_grid_id'));

        $pricing_grid = \App\Models\PricingGridModel::find($pricing_grid_id);

        $columns_ids_arr = [];

        if ($pricing_grid) {
            $columns_ids_arr = $pricing_grid->columnsIdsArr();
        }

        /**
         * @var $product \App\Models\ProductModel
         */
        foreach ($products as $product) {

            $product_mix = [
                'id' => $product->id,
                'name' => $product->name . '(' . $product->id . ')',
                'cn_link' => $product->attr('cn_link'),
            ];

            if ($pricing_grid) {
                $prices = $product->prices($columns_ids_arr);

                if (!empty($prices)) {
                    foreach ($prices as $price) {
                        $product_mix['col_' . $price->column_id] = $price->price;
                    }
                }
            }

            $data[] = $product_mix;
        }

        return $data;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return 'create';
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $product_id = intval(\Input::get('product_id', 0));

        $attributes_mix_arr = (array) \Input::get('attributes', []);

        if ($product_id) {
            $product = \App\Models\ProductModel::find($product_id);

            if (!$product) {
                return;
            }

            $product->user_id = \Auth::user()->id;
            $product->name = \Input::get('name');
            $product->description = \Input::get('description');

            $product->save();

            if (!empty($attributes_mix_arr)) {
                foreach ($attributes_mix_arr as $attribute_mix) {
                    $attribute = $product->attributes()->where('attribute_id', '=', $attribute_mix['id'])->first();
                    if ($attribute) {
                        $attribute->value = $attribute_mix['value'];
                        $attribute->save();
                    }
                }
            }

        } else {
            $product = \App\Models\ProductModel::create([
                'user_id' => \Auth::user()->id,
                'name' => \Input::get('name'),
                'description' => \Input::get('description'),
            ]);

            if (!$product) {
                return;
            }

            if (!empty($attributes_mix_arr)) {
                $attributes = [];
                foreach ($attributes_mix_arr as $attribute_mix) {
                    $attributes[] = new \App\Models\AttributeValueModel([
                        'attribute_id' => $attribute_mix['id'],
                        'value' => $attribute_mix['value'],
                    ]);
                }

                $product->attributes()->saveMany($attributes);
            }
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = \App\Models\ProductModel::find($id);

        if (!$product) {
            return [];
        }

        $product->attributes = $product->attributes()->get(['attribute_id', 'value']);

        $product->media = $product->media('image')->get(['id', 'file_name', 'position', 'type']);

        return $product;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$product = \App\Models\ProductModel::find($id);

        if (!$product) {
            return;
        }

        $input_fields = \Input::all();

        if (empty($input_fields)) {
            return;
        }

        if (array_key_exists('categories_ids', $input_fields)) {
            $categories_ids_str = str_replace(' ', '', $input_fields['categories_ids']);
            $categories_ids_arr = explode(',', $categories_ids_str);
            $categories_ids_arr = array_unique($categories_ids_arr);

            $product->categories()->sync($categories_ids_arr);
        }

        /**
         * Установка цен
         */
        foreach ($input_fields as $field_name => $field_value) {
            \App\Models\PricingGridModel::setPriceByPriceCode($field_name, $field_value, $product->id);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        \App\Models\ProductModel::destroy($id);
	}

}
