<?php

namespace App\Repositories\Students;

use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Students\StudentsRepository;
use App\Entities\Students\Students;
use App\Validators\Customer\StudentsValidator;

/**
 * Class StudentsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Customer;
 */
class StudentsRepositoryEloquent extends BaseRepository implements StudentsRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Students::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getStudentId($user_id)
    {
        $result = DB::table('students')
                ->where('user_id', $user_id)
                ->value('id');

        return $result;
    }

    public function addMoney( $user_id, $money ) {
        $currentMoney = DB::table('students')
                        ->where('user_id', $user_id)
                        ->value('money');


        $result = DB::table('students')
                    ->where('user_id', $user_id)
                    ->update(['money' => $money + $currentMoney]);

        return $result;

    }
}
