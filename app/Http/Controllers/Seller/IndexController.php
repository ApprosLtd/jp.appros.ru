<?php namespace App\Http\Controllers\Seller;


class IndexController extends SellerController {

    public function getIndex()
    {
        return view('atlant.layout');
    }

}
