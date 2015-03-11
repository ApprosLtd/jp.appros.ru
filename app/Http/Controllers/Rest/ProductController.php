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

        /**
         * @var $product \App\Models\ProductModel
         */
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'name' => $product->name,
                'cn_link' => $product->attr('cn_link')
            ];
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
		//
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
