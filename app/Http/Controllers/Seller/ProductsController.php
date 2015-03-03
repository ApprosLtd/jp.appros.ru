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
     * Возвращает данные о продукте
     * @param $id
     * @return json
     */
    public function getProduct($id)
    {
        /**
         * @var $product \App\Models\Product
         */
        $product = \App\Models\Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Продукт не найден'
            ]);
        }

        $product_mix = $product->toArray();

        $attributes_mix = [];
        $attributes = $product->attributes()->get();
        if ($attributes->count()) {
            foreach ($attributes as $attribute) {
                $attributes_mix[$attribute->name] = $attribute->value;
            }
        }

        $product_mix['attributes'] = $attributes_mix;

        $categories_ids = [];
        $categories = $product->categories()->get(['id']);
        if ($categories) {
            foreach ($categories as $category) {
                $categories_ids[] = intval($category->id);
            }
        }

        $product_mix['categories_ids'] = $categories_ids;

        return response()->json($product_mix);
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

        $product_id = 0;
        if (isset($post_fields_arr['id']) and intval($post_fields_arr['id']) > 0) {
            $product_id = intval($post_fields_arr['id']);
        }

        if ($product_id) {
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

                $attribute = \App\Models\AttributeValue::where('product_id', '=', $product->id)->where('name', '=', $attribute_name)->first();

                if ($attribute) {
                    $attribute->value = $attribute_value;
                    $attribute->save();
                } else {
                    \App\Models\AttributeValue::create([
                        'product_id' => $product->id,
                        'name' => $attribute_name,
                        'value' => $attribute_value
                    ]);
                }
            }
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
