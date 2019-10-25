<?php

namespace App\Repositories\Students;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface StudentsRepository.
 *
 * @package namespace App\Repositories\Customer;
 */
interface StudentsRepository extends RepositoryInterface
{
    public function getStudentId($user_id);
    public function addMoney($user_id, $money);
}
