<?php

namespace App\Repositories\Classs;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ClasssRepository.
 *
 * @package namespace App\Repositories\Classs;
 */
interface ClasssRepository extends RepositoryInterface
{
    public function updateClass($class_id);
    public function classOfTeacher($user_id);
    public function listStudents($class_id);

}
