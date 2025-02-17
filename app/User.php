<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

    protected $basket = null;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function suppliers()
    {
        return $this->hasMany('\App\Models\SupplierModel');
    }

    public function products()
    {
        return $this->hasMany('\App\Models\ProductModel');
    }

    public function purchases()
    {
        return $this->hasMany('\App\Models\PurchaseModel');
    }

    public function basket()
    {
        if (!$this->basket) {
            $this->basket = new \App\Basket($this->id);
        }

        return $this->basket;
    }

    public function orders()
    {
        return $this->hasMany('\App\Models\OrderModel');
    }
}
