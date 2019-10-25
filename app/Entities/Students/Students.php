<?php

namespace App\Entities\Students;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Students.
 *
 * @package namespace App\Entities\Customer;
 */
class Students extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'students';
    protected $fillable = ['user_id', 'name', 'gender', 'phone', 'email', 'money'];

    public function Student_Presence()
    {
        return $this->hasMany('App\Student_Presence', 'student_id', 'id');
    }
    public function Attend()
    {
        return $this->hasMany('App\Attend', 'student_id', 'id');
    }
    public  function User()
    {
        return $this->hasOne('App\Entities\Users\User', 'id', 'user_id');
    }

}
