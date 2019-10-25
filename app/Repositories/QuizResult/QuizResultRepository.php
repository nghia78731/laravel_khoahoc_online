<?php

namespace App\Repositories\QuizResult;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface QuizResultRepository.
 *
 * @package namespace App\Repositories\QuizResult;
 */
interface QuizResultRepository extends RepositoryInterface
{
    public function getCorrected($user_id, $quiz_id);
    public function checkCompleted($user_id, $quiz_id);
    public function clearQuizResult($user_id, $quiz_id);
}
