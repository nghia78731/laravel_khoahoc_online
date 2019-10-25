<?php

namespace App\Repositories\OrderClass;

use App\Classs;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderClassRepository.
 *
 * @package namespace App\Repositories\OrderClass;
 */
interface OrderClassRepository extends RepositoryInterface
{
    public function addOrderClassByCourse($class_id, $price);
    public function getOrderClassByKey($key);
    public function updateOrderClassSucess($key);
}
