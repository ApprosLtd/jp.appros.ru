<?php namespace App\Http\Controllers\Seller;


class IndexController extends SellerController {

    public function getIndex()
    {
        $this->layout->content = 'hello index seller';
    }

}
