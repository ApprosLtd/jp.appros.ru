<?php namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;

class WidgetsController extends AdminController {

	public function getIndex()
	{
        $widgets_models_arr = \App\Models\WidgetModel::orderBy('region')->orderBy('position')->paginate(50);

        return view('admin.widgets.index', ['widgets_models_arr' => $widgets_models_arr]);
	}

    public function postSave(Request $request)
    {
        $post_fields_arr = $request->all();

        $validator = \Validator::make($post_fields_arr, [
            'name' => 'required|max:100',
            'description' => 'max:255',
            'handler' => 'required|max:255',
            'region' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return 'Невалидные данные';
        }

        if (isset($post_fields_arr['id'])) {
            $widget_model = \App\Models\WidgetModel::find($post_fields_arr['id']);

            if (!$widget_model) {
                return 'Ошибка: нет виджета с таким ID - ' . $post_fields_arr['id'];
            }

            $widget_model->name        = $post_fields_arr['name'];
            $widget_model->description = $post_fields_arr['description'];
            $widget_model->handler     = $post_fields_arr['handler'];
            $widget_model->region      = $post_fields_arr['region'];
            $widget_model->status      = $post_fields_arr['status'];

            $widget_model->save();
        } else {
            \App\Models\WidgetModel::create($post_fields_arr);
        }

        return redirect('/admin/widgets');
    }

}
