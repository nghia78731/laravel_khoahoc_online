<?php

namespace App\Repositories\Attend;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AttendRepository.
 *
 * @package namespace App\Repositories\Attend;
 */
interface AttendRepository extends RepositoryInterface
{
    public function registerCourse($infoStudent);
    public function updateQuantity($class_id);
    public function getCurrentQuantity($class_id);
    public function getInfoAttend($student_id);
}
