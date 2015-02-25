<?php namespace App\Http\Controllers\Seller;


class IndexController extends SellerController {

    public function getIndex()
    {
        $this->setContent('welcome', []);
    }

}
