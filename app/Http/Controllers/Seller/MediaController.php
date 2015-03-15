<?php namespace App\Http\Controllers\Seller;


class MediaController extends SellerController {

    public function postUpload()
    {
        $file_data = $_FILES['files'];

        $tmp_name = is_array($file_data['tmp_name']) ? $file_data['tmp_name'][0] : $file_data['tmp_name'];

        $file_extention = 'jpg';

        $file_name = md5(microtime()) . '.' . $file_extention;

        $file_path = "/cdn/images/" . $file_name;

        move_uploaded_file($tmp_name, base_path() . "/public" . $file_path);

        $media_model = new \App\Models\MediaModel;

        $media_model->product_id = \Input::get('product_id');
        $media_model->file_name  = $file_name;
        $media_model->save();

        $media_model->success = true;

        return $media_model;
    }

    public function getImage($width_height, $file_name)
    {
        /*
        $file_name = \Input::get('src');
        $width  = \Input::get('w', 273);
        $height = \Input::get('h', 200);
        */

        $width_height_arr = explode('x', $width_height);
        $width  = $width_height_arr[0];
        $height = $width_height_arr[1];

        $image_path = base_path() . '/public/cdn/images/' . $file_name;

        if (!file_exists($image_path)) {
            $img = \Image::canvas($width, $height);
            $img->text('Image not found ;{', 110, 110, function($font) {
                $font->size(48);
                $font->align('center');
            });
            return $img->response('jpg');
        }

        $img = \Image::make($image_path)->fit($width, $height);

        $storage_dir = base_path() . '/public/media/images/' . $width_height;

        $storage_file = $storage_dir . '/' . $file_name;

        if (!file_exists($storage_dir)) {
            mkdir($storage_dir);
        }

        $img->save($storage_file);

        return $img->response('jpg');
    }
}