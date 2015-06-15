<?php namespace App\Http\Controllers\Rest;

use Illuminate\Http\Request;

class BasketController extends RestController {

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        if ( \Auth::guest() ) {
            return \App\Helpers\RestHelper::exceptionAccessDenied();
        }

        /**
         * TODO: проверка прав пользователя на работу с корзиной
         */
        if (0) {
            return \App\Helpers\RestHelper::exceptionAccessDenied();
        }

        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'purchase_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return \App\Helpers\RestHelper::exceptionInvalidData($validator->errors()->all());
        }

        $product_in_purchase = \App\Models\ProductInPurchaseModel::findByProductIdAndByPurchaseId($request->get('product_id'), $request->get('purchase_id'));

        if (!$product_in_purchase) {
            return \App\Helpers\RestHelper::exceptionInvalidData(['Product in purchase not found']);
        }

        $this->user->basket()->addProduct($product_in_purchase->id, 1);

        return ['success' => true];
    }

}