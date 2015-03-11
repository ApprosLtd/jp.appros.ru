<?php namespace App\Http\Controllers\Rest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CatalogController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return [
            'success' => true,
            'items' => [
                ['id' => 1, 'name' => 'My Name']
            ]
        ];

		return \App\Models\NestedSets::all();
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
		$name = \Input::get('name');
		$parent_id = intval(\Input::get('parent_id'));

        if (!$parent_id) {
            $parent_id = \App\Models\CatalogModel::ROOT_NESTED_SETS_ID;
        }

        $parent = \App\Models\NestedSets::find($parent_id);

        if (!$parent) {
            return ['success' => false, 'msg' => 'Parent not found'];
        }

        $item = \App\Models\NestedSets::create(['name' => $name], $parent);

        return ['item' => $item->get(['id', 'name'])];
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($node_id)
	{
        $node_id = intval($node_id);

        if (!$node_id) {
            $node_id = \App\Models\CatalogModel::ROOT_NESTED_SETS_ID;
        }

        $node_obj = \App\Models\NestedSets::find($node_id);

        if (!$node_obj) {
            return [];
        }

        return [
            'children' => $node_obj->children()->get(['id', 'name as text'])
        ];
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
