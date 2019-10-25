<?php

namespace App\Repositories\Teachers;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TeachersRepository.
 *
 * @package namespace App\Repositories\Teachers;
 */
interface TeachersRepository extends RepositoryInterface
{
    public function showInfoCourse();
}
