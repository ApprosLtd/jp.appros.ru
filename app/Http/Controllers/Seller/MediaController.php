<?php namespace App\Http\Controllers\Seller;


class MediaController extends SellerController {

    public function postUpload()
    {
        $file_data = $_FILES['files'];

        $tmp_name = $file_data['tmp_name'][0];

        $file_extention = 'jpg';

        $file_name = md5(microtime()) . '.' . $file_extention;

        $file_path = "/cdn/images/" . $file_name;

        move_uploaded_file($tmp_name, base_path() . "/public" . $file_path);

        $media_model = new \App\Models\MediaModel;

        $media_model->product_id = \Input::get('product_id');
        $media_model->file_name  = $file_name;
        $media_model->save();

        return ['file_path' => $file_path];
    }

    public function getImage()
    {
        $image_path = base_path() . '/public' . \Input::get('src');

        $img = \Image::make($image_path)->fit(273, 200);

        return $img->response('jpg');
    }
}