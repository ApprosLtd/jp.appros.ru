<?php namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;

class AttributesController extends SellerController {

    public function getIndex()
    {
        return view('seller.attributes.index');
    }

    public function postSaveGroup(Request $request)
    {
        $post_fields_arr = $request->all();

        $post_fields_arr['user_id'] = $this->user->id;

        /**
         * @var $attributes_group_model \Illuminate\Database\Eloquent\Model
         */
        if (isset($post_fields_arr['id'])) {
            $attributes_group_model = \App\Models\AttributesGroup::find($post_fields_arr['id']);

            if (!$attributes_group_model) {
                return 'Ошибка: нет категории с таким ID - ' . $post_fields_arr['id'];
            }

            $attributes_group_model->name       = $post_fields_arr['name'];

            $attributes_group_model->save();
        } else {
            \App\Models\AttributesGroup::create($post_fields_arr);
        }

        return redirect('/seller/attributes');
    }
}