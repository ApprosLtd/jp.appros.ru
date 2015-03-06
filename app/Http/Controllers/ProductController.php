<?php namespace App\Http\Controllers;


class ProductController extends Controller {

    public function getProduct($alias = null)
    {
        if (empty($alias)) {
            return response(view('errors.product_404'), 404);
        }

        $product = \App\Models\Product::find($alias);

        if (!$product) {
            return response(view('errors.product_404'), 404);
        }

        $purchase = \App\Models\Purchase::find(1);

        return view('product.card', [
            'product' => $product,
            'purchase' => $purchase
        ]);
    }

}