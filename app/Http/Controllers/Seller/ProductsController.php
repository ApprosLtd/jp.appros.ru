<?php namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use Illuminate\Http\Request;

class ProductsController extends SellerController {

    public function getIndex()
    {
        $goods_models_arr = \App\Models\Product::paginate(50);

        return view('seller.products.index', ['goods_models_arr' => $goods_models_arr]);
    }

    /**
     * Создание или сохранение продукта
     * @param Request $request
     * @return string
     */
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
            $product = \App\Models\Product::find($post_fields_arr['id']);

            if (!$product) {
                return 'Ошибка: нет виджета с таким ID - ' . $post_fields_arr['id'];
            }

            $product->name        = $post_fields_arr['name'];
            $product->description = $post_fields_arr['description'];

            $product->save();
        } else {
            $product = \App\Models\Product::create($post_fields_arr);
        }

        if (isset($post_fields_arr['categories_ids']) and !empty($post_fields_arr['categories_ids'])) {
            $product->categories()->attach($post_fields_arr['categories_ids']);
        }

        if (isset($post_fields_arr['attributes']) and !empty($post_fields_arr['attributes'])) {

            foreach ($post_fields_arr['attributes'] as $attribute_name => $attribute_value) {
                \App\Models\Product::create([
                    'name' => $attribute_name,
                    'value' => $attribute_value
                ]);
            }

            $product->categories()->attach($post_fields_arr['categories_ids']);
        }
    }

    /**
     * Создание или сохранение категории
     * @param Request $request
     * @return string
     */
    public function postSaveCategory(Request $request)
    {
        $post_fields_arr = $request->all();

        /**
         * @var $category \Illuminate\Database\Eloquent\Model
         */
        if (isset($post_fields_arr['id'])) {
            $category = \App\Models\Category::find($post_fields_arr['id']);

            if (!$category) {
                return 'Ошибка: нет категории с таким ID - ' . $post_fields_arr['id'];
            }

            $category->name       = $post_fields_arr['name'];
            $category->parent_id  = $post_fields_arr['parent_id'];
            $category->project_id = $post_fields_arr['project_id'];

            $category->save();
        } else {
            \App\Models\Category::create($post_fields_arr);
        }

        return redirect('/seller/products');
    }
}
