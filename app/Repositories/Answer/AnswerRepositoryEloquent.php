<?php

namespace App\Repositories\Answer;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Answer\AnswerRepository;
use App\Entities\Answer\Answer;
use App\Validators\Answer\AnswerValidator;

/**
 * Class AnswerRepositoryEloquent.
 *
 * @package namespace App\Repositories\Answer;
 */
class AnswerRepositoryEloquent extends BaseRepository implements AnswerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Answer::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
