<?php namespace App\Http\Controllers;


class CatalogController extends Controller {

    public function getIndex()
    {
        $offset = intval(\Input::get('start', 0));
        $limit = intval(\Input::get('limit', 40));

        $products_in_purchases = \App\Helpers\PurchaseHelper::getProductsAvailableForSale();

        return view('catalog.index', ['products_in_purchases' => $products_in_purchases]);
    }

}