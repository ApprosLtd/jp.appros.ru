<?php namespace App\Http\Controllers;


class ExtGeneratorController extends Controller {

    public function getComponent($alias)
    {
        return $alias;
    }

}