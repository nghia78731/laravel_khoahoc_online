<?php

namespace App\Repositories\Quiz;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Quiz\QuizRepository;
use App\Entities\Quiz\Quiz;
use App\Validators\Quiz\QuizValidator;

/**
 * Class QuizRepositoryEloquent.
 *
 * @package namespace App\Repositories\Quiz;
 */
class QuizRepositoryEloquent extends BaseRepository implements QuizRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Quiz::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getQuiz( $class_id ) {
        $result = Quiz::with( 'Question.Answer')
                        ->where('class_id' , '=', $class_id)
                        ->get();

        return $result;
    }

    public function getTotalQuestion( $quiz_id ) {
        $result = Quiz::find($quiz_id);

        return $result;
    }

}
