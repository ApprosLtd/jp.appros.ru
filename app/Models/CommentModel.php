<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model {

    protected $table = 'comments';

    const TARGET_TYPE_SELLER   = 'seller';

    const TARGET_TYPE_PRODUCT  = 'product';

    const TARGET_TYPE_PRODUCT_IN_PURCHASE  = 'product_in_purchase';

    const TARGET_TYPE_PURCHASE = 'purchase';

}