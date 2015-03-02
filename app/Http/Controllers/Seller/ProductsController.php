<?php namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use Illuminate\Http\Request;

class ProductsController extends SellerController {

    public function getIndex()
    {
        $goods_models_arr = \App\Models\Product::paginate(50);

        return view('seller.products.index', ['goods_models_arr' => $goods_models_arr]);
    }

    public function postSave(Request $request)
    {
        $post_fields_arr = $request->all();

        $validator = \Validator::make($post_fields_arr, [
            'name' => 'required|max:100',
            'description' => 'max:255',
        ]);

        if ($validator->fails()) {
            return 'Невалидные данные';
        }

        $post_fields_arr['user_id'] = $this->user->id;

        if (isset($post_fields_arr['id'])) {
            $widget_model = \App\Models\Product::find($post_fields_arr['id']);

            if (!$widget_model) {
                return 'Ошибка: нет виджета с таким ID - ' . $post_fields_arr['id'];
            }

            $widget_model->name        = $post_fields_arr['name'];
            $widget_model->description = $post_fields_arr['description'];

            $widget_model->save();
        } else {
            \App\Models\Product::create($post_fields_arr);
        }

        return redirect('/seller/products');
    }

    public function postSaveCategory(Request $request)
    {
        $post_fields_arr = $request->all();

        /**
         * @var $category_model \Illuminate\Database\Eloquent\Model
         */
        if (isset($post_fields_arr['id'])) {
            $category_model = \App\Models\Category::find($post_fields_arr['id']);

            if (!$category_model) {
                return 'Ошибка: нет категории с таким ID - ' . $post_fields_arr['id'];
            }

            $category_model->name       = $post_fields_arr['name'];
            $category_model->parent_id  = $post_fields_arr['parent_id'];
            $category_model->project_id = $post_fields_arr['project_id'];

            $category_model->save();
        } else {
            \App\Models\Category::create($post_fields_arr);
        }

        return redirect('/seller/products');
    }
}
