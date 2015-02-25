<?php namespace App\Http\Controllers\Seller;


use App\Http\Controllers\Controller;

abstract class SellerController extends Controller {

    protected $layout = 'seller.layout';

    protected function layout($data, $view = null)
    {
        if ($view) {
            $layout_data = ['content' => view($view, $data)];
        } else {
            $layout_data = $data;
        }

        return view($this->layout, $layout_data);
    }

}