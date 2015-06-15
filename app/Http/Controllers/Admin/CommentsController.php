<?php namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;

class CommentsController extends AdminController {

    public function getIndex()
    {
        $comments_models_arr = \App\Models\CommentModel::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.comments.index', ['comments_models_arr' => $comments_models_arr]);
    }

}