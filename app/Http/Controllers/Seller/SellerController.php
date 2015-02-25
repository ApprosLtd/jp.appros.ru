<?php namespace App\Http\Controllers\Seller;


use App\Http\Controllers\Controller;

abstract class SellerController extends Controller {

    protected $layout = 'seller.layout';

    protected function setupLayout()
    {
        if (!is_null($this->layout))
        {
            $this->layout = view($this->layout);
        }
    }

    public function callAction($method, $parameters)
    {
        $response = call_user_func_array(array($this, $method), $parameters);

        if (is_null($response) && !is_null($this->layout))
        {
            $response = $this->layout;
        }

        return $response;
    }

}