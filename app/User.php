<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

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

    public $grid_columns = [
        [
            'text' => 'ID',
            'dataIndex' => 'id',
            'width' => 50
        ],
        [
            'text' => 'Имя',
            'dataIndex' => 'name',
            'width' => 400
        ],
        [
            'text' => 'Email',
            'dataIndex' => 'email',
            'flex' => 1
        ],
    ];

    public function getBaseRole()
    {
        return 'buyer';
    }

    public function isBuyer()
    {
        if ($this->getBaseRole() == 'buyer') {
            return true;
        }

        return false;
    }

    public function isSeller()
    {
        if ($this->getBaseRole() == 'seller') {
            return true;
        }

        return false;
    }

}
