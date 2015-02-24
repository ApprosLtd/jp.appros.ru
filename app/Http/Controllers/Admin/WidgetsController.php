<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;

class WidgetsController extends AdminController {

    public $layout = 'admin.layout';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        return view('admin.widgets.index');
	}

}
