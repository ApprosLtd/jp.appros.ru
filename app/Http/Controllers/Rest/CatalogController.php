<?php namespace App\Http\Controllers\Rest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CatalogController extends Controller {

    const ROOT_NESTED_SETS_ID = 1;

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
            $parent_id = self::ROOT_NESTED_SETS_ID;
        }

        $item = \App\Models\NestedSets::append($parent_id, ['name' => $name]);

        return ['item' => $item];
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $id = intval($id);

        return [
            'children' => [
                ['text' => 'Парфюмерия'],
                ['text' => 'Косметика'],
            ]
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
