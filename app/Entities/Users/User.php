<?php

namespace App\Entities\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Contracts\Auth\Authenticatable as Authenticatable;

/**
 * Class User.
 *
 * @package namespace App\Entities\Users;
 */
class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'role_id', 'email', 'password', 'image', 'provider', 'provider_id'
    ];

    /**
     * ROLE_ID
     */
       public const ROLE_STUDENT = 1;
      public const ROLE_TEACHER = 2;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {

        $this->attributes['password'] = bcrypt($value);
    }

    public function Teachers()
    {
        return $this->hasOne('App\Entities\Teachers\Teachers', 'user_id', 'id');
    }

}
