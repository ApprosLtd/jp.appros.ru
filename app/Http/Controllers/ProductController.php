<?php namespace App\Http\Controllers;


class ProductController extends Controller {

    public function getProduct($alias = null)
    {
        if (empty($alias)) {
            return response(view('errors.product_404'), 404);
        }

        $product = \App\Models\ProductModel::find($alias);

        //$product_in_purchase = \App\Models\ProductInPurchaseModel::find(1, $alias);

        if (!$product) {
            return response(view('errors.product_404'), 404);
        }

        $purchase = \App\Models\PurchaseModel::find(11);

        return view('product.card', [
            'product_in_purchase' => $product,
            'product' => $product,
            'purchase' => $purchase
        ]);
    }

}