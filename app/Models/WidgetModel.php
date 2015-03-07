<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetModel extends Model {

    public $table = 'widgets';

    protected $fillable = ['name', 'description', 'handler', 'region', 'status'];

}
