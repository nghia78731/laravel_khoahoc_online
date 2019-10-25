<?php

namespace App\Repositories\Attend;

use App\Classs;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Attend\AttendRepository;
use App\Entities\Attend\Attend;
use App\Validators\Attend\AttendValidator;

/**
 * Class AttendRepositoryEloquent.
 *
 * @package namespace App\Repositories\Attend;
 */
class AttendRepositoryEloquent extends BaseRepository implements AttendRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Attend::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function registerCourse($infoStudent)
    {
        $result = $this->create($infoStudent);
        $this->updateQuantity($infoStudent['class_id']);

        return $result;
    }

    public function updateQuantity($class_id)
    {
        $result = Classs::where('id', $class_id)->update(['current_quantity' => $this->getCurrentQuantity($class_id) + 1]);

        return $result;
    }

    public function getCurrentQuantity($class_id)
    {
        $result = Attend::where('class_id', $class_id)->count();

        return $result;
    }

    public function getInfoAttend($student_id)
    {
        $result = Attend::with('Classs')->where('student_id', '=', $student_id)->get();

        return $result;
    }

}
