<?php

namespace App\Entities\Attend;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Attend.
 *
 * @package namespace App\Entities\Attend;
 */
class Attend extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'class_id', 'user_id'];
    protected $table = 'attend';

    public function Classs()
    {
        return $this->hasMany('App\Entities\Classs\Classs', 'id', 'class_id');
    }
}
