<?php

namespace App\Entities\Quiz;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Quiz.
 *
 * @package namespace App\Entities\Quiz;
 */
class Quiz extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    protected $table = 'quiz';



    public function Question()
    {
        return $this->hasMany('App\Entities\Question\Question', 'id_quiz', 'id');
    }

}
