<?php namespace App\Http\Controllers\Seller;


use App\Http\Controllers\Controller;

abstract class SellerController extends Controller {

    protected $layout = 'seller.layout';

    public function callAction($method, $parameters)
    {
        $response = call_user_func_array(array($this, $method), $parameters);

        if (is_null($response) && !is_null($this->layout))
        {
            $response = view($this->layout);
        }

        return $response;
    }

}