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

        $this->layout = view($this->layout, $layout_data);
    }

    public function callAction($method, $parameters)
    {
        $response = call_user_func_array(array($this, $method), $parameters);

        if (is_null($response) && ! is_null($this->layout))
        {
            $response = $this->layout;
        }

        return $response;
    }

}