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
        $start = intval(\Input::get('start'));
        $limit = intval(\Input::get('limit'));

        $products = \App\Models\ProductModel::offset($start)->take($limit)->get(['id', 'name']);

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
        $product = \App\Models\ProductModel::create([
            'user_id' => \Auth::user()->id,
            'name' => \Input::get('name'),
            'description' => \Input::get('description'),
        ]);

        if (!$product) {
            return;
        }

        $attributes_mix_arr = (array) \Input::get('attributes', []);

        if (!empty($attributes_mix_arr)) {
            foreach ($attributes_mix_arr as $attribute_mix) {
                $attributes[] = new \App\Models\AttributeValueModel([
                    'attribute_id' => $attribute_mix['id'],
                    'value' => $attribute_mix['value'],
                ]);
            }

            $product->attributes()->saveMany($attributes);
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
		//
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
