<?php

namespace App\Repositories\Teachers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Teachers\TeachersRepository;
use App\Entities\Teachers\Teachers;



/**
 * Class TeachersRepositoryEloquent.
 *
 * @package namespace App\Repositories\Teachers;
 */
class TeachersRepositoryEloquent extends BaseRepository implements TeachersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Teachers::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function showInfoCourse()
    {
        $result = Teachers::with('classOfTeacher', 'studentAttend')->whereNotNull('class_id')->get();

        return $result;
    }

}
