<?php namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use Illuminate\Http\Request;

class GoodsController extends SellerController {

    public function getIndex()
    {
        return view('seller.goods.index');
    }

}
