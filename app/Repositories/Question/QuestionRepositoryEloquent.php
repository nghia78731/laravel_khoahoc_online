<?php

namespace App\Repositories\Question;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Question\QuestionRepository;
use App\Entities\Question\Question;
use App\Validators\Question\QuestionValidator;

/**
 * Class QuestionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Question;
 */
class QuestionRepositoryEloquent extends BaseRepository implements QuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function countQuestion() {
        $result = Question::all()->count();

        return $result;
    }

}
