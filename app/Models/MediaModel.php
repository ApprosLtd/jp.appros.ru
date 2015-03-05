<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaModel extends Model {

	public $table = 'media';

    public $timestamps = false;

    public function delete()
    {
        echo 'hello-'.$this->id;

        switch($this->type){
            case 'image':
                $image_local_path = base_path() . "/public/cdn/images/" . $this->file_name;
                if (file_exists($image_local_path)) {
                    unlink($image_local_path);
                }
                break;
        }

        parent::delete();
    }

}
