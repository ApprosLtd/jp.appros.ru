<?php namespace App\Http\Controllers\Seller;


class MediaController extends SellerController {

    public function postUpload()
    {
        $file_data = $_FILES['files'];

        $tmp_name = $file_data['tmp_name'];

        $form_data = \Input::all();


        return $form_data;
    }

}