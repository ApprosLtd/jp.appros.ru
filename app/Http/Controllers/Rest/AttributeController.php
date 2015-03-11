<?php namespace App\Http\Controllers\Rest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AttributeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $attributes_groups = \App\Models\AttributesGroupModel::all();

        if (!$attributes_groups) {
            return [];
        }

        $output_arr = [];

        foreach ($attributes_groups as $attributes_group) {
            $attributes = $attributes_group->attributes;

            if (!$attributes) {
                continue;
            }

            foreach ($attributes as $attribute) {
                $output_arr[] = [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'title' => $attribute->title,
                    'value' => '',
                    'group' => $attributes_group->name,
                    'group_id' => $attributes_group->id
                ];
            }
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
        return 'create';
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        return 'store';
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return 'show';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return 'edit';
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        return 'update';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        return 'destroy';
	}

}
