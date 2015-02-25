<?php namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use Illuminate\Http\Request;

class PricingGridsController extends SellerController {

    public function getIndex()
    {
        $goods_models_arr = \App\Models\PricingGrid::paginate(50);

        return view('seller.pricing_grids.index', ['goods_models_arr' => $goods_models_arr]);
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

        if (isset($post_fields_arr['id'])) {
            $widget_model = \App\Models\PricingGrid::find($post_fields_arr['id']);

            if (!$widget_model) {
                return 'Ошибка: нет виджета с таким ID - ' . $post_fields_arr['id'];
            }

            $widget_model->name        = $post_fields_arr['name'];
            $widget_model->description = $post_fields_arr['description'];

            $widget_model->save();
        } else {
            \App\Models\PricingGrid::create($post_fields_arr);
        }

        return redirect('/seller/pricing-grids');
    }

}