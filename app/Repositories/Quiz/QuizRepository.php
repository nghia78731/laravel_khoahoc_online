<?php

namespace App\Repositories\Quiz;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface QuizRepository.
 *
 * @package namespace App\Repositories\Quiz;
 */
interface QuizRepository extends RepositoryInterface
{
    public function getQuiz($class_id);
    public function getTotalQuestion($quiz_id);
}
