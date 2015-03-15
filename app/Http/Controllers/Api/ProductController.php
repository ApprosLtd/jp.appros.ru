<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;

class ProductController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $start = intval(\Input::get('start', 0));
        $limit = intval(\Input::get('limit', 40));

        $products = \App\Models\ProductModel::offset($start)->take($limit)->get(['id', 'name']);

        if (!$products->count()) {
            return [];
        }

        $output_arr = [];
        foreach ($products as $product) {

            $image_min = '';
            $first_image = $product->media('image')->first();
            if ($first_image) {
                $image_min = $first_image->file_name;
            }

            $output_arr[] = [
                'id' => $product->id,
                'name' => $product->name,
                'image_min' => $image_min,
                'alias' => 'product-' . $product->id,
                'stars' => rand(1,5),
            ];
        }

        return $output_arr;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}

}
