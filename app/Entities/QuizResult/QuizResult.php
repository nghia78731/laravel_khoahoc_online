<?php

namespace App\Entities\QuizResult;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class QuizResult.
 *
 * @package namespace App\Entities\QuizResult;
 */
class QuizResult extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'question_id', 'quiz_id', 'correct', 'answered'];
    protected $table = 'quiz_result';



}
