<?php

namespace App\Repositories\Notification;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Notification\NotificationRepository;
use App\Entities\Notification\Notification;
use App\Validators\Notification\NotificationValidator;

/**
 * Class NotificationRepositoryEloquent.
 *
 * @package namespace App\Repositories\Notification;
 */
class NotificationRepositoryEloquent extends BaseRepository implements NotificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Notification::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function addNotification($array)
    {
        $result = $this->create($array);

        return $result;
    }

    public function deleteNotification($id)
    {
        $result = $this->delete($id);

        return $result;
    }

}
