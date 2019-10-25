<?php

namespace App\Repositories\Question;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface QuestionRepository.
 *
 * @package namespace App\Repositories\Question;
 */
interface QuestionRepository extends RepositoryInterface
{
    public function countQuestion();
}
