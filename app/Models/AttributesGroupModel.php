<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributesGroupModel extends Model {

    public $table = 'attributes_groups';

    protected $fillable = ['name', 'user_id'];

}
