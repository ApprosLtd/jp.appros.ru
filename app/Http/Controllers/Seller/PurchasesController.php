<?php namespace App\Http\Controllers\Seller;

use App\Http\Requests;

use Illuminate\Http\Request;

class PurchasesController extends SellerController {

    public function getIndex()
    {
        $items_models_arr = \App\Models\PurchaseModel::where('user_id', '=', $this->user->id)->paginate(50);

        return view('seller.purchases.index', ['items_models_arr' => $items_models_arr]);
    }

    public function getProducts($id)
    {
        $purchase = \App\Models\PurchaseModel::find($id);

        if (!$purchase) {
            abort(404);
        }

        return view('seller.purchases.products', ['purchase' => $purchase]);
    }

    public function postSave(Request $request)
    {
        $post_fields_arr = $request->all();

        $validator = \Validator::make($post_fields_arr, [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'pricing_grid_id' => 'required',
            'pricing_grid_column' => '',
            'expiration_time' => 'required',
        ]);

        if ($validator->fails()) {
            return 'Невалидные данные';
        }

        $post_fields_arr['user_id'] = $this->user->id;

        if (isset($post_fields_arr['id'])) {
            $purchase_model = \App\Models\PurchaseModel::find($post_fields_arr['id']);

            if (!$purchase_model) {
                return 'Ошибка: нет закупки с таким ID - ' . $post_fields_arr['id'];
            }

            $purchase_model->name        = $post_fields_arr['name'];
            $purchase_model->description = $post_fields_arr['description'];

            $purchase_model->save();
        } else {
            \App\Models\PurchaseModel::create($post_fields_arr);
        }

        return redirect('/seller/purchases');
    }
}
