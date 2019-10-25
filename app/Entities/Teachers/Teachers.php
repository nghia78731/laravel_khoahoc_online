<?php

namespace App\Entities\Teachers;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Teachers.
 *
 * @package namespace App\Entities\Teachers;
 */
class Teachers extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'teachers';
    protected $fillable = ['user_id', 'name', 'gender', 'phone', 'email'];

    public function User()
    {
        return $this->hasOne('App\Entities\Users\User', 'id', 'user_id');
    }

    public function classOfTeacher()
    {
        return $this->hasOne('App\Entities\Classs\Classs', 'id', 'class_id');
    }

    public function studentAttend()
    {
        return $this->hasOne('App\Entities\Attend\Attend', 'class_id', 'class_id');
    }
}
