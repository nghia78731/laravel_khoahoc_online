<?php

namespace App\Repositories\QuizResult;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\QuizResult\QuizResultRepository;
use App\Entities\QuizResult\QuizResult;
use App\Validators\QuizResult\QuizResultValidator;

/**
 * Class QuizResultRepositoryEloquent.
 *
 * @package namespace App\Repositories\QuizResult;
 */
class QuizResultRepositoryEloquent extends BaseRepository implements QuizResultRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return QuizResult::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCorrected($user_id, $quiz_id) {
        $result = QuizResult::where([
            ['correct', '=', 1],
            ['quiz_id', '=', $quiz_id],
            ['user_id', '=', $user_id]
        ])->count();


        return $result;
    }

    public function checkCompleted( $user_id, $quiz_id ) {
        $result = QuizResult::where([
            ['quiz_id', '=', $quiz_id],
            ['user_id', '=', $user_id]
        ])->count();

        return $result;
    }

    public function clearQuizResult( $user_id, $quiz_id ) {
        $result = QuizResult::where([
            ['quiz_id', '=', $quiz_id],
            ['user_id', '=', $user_id]
        ])->delete();

        return $result;
    }
}
