<?php

namespace App\Repositories\Notification;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NotificationRepository.
 *
 * @package namespace App\Repositories\Notification;
 */
interface NotificationRepository extends RepositoryInterface
{
    public function addNotification($array);
    public function deleteNotification($id);
}
