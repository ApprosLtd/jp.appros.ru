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
        $widgets_models_arr = \App\Models\Widget::paginate(20);

        return view('admin.widgets.index', ['widgets_models_arr' => $widgets_models_arr]);
	}

}
