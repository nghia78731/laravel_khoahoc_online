<?php

namespace App\Entities\Question;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Question.
 *
 * @package namespace App\Entities\Question;
 */
class Question extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    protected $table = 'question';

    public function Answer()
    {
        return $this->hasMany('App\Entities\Answer\Answer', 'question_id', 'id');
    }
}
