<?php

namespace App\Repositories\Classs;

use App\Entities\Teachers\Teachers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Classs\ClasssRepository;
use App\Entities\Classs\Classs;
use App\Validators\Classs\ClasssValidator;

/**
 * Class ClasssRepositoryEloquent.
 *
 * @package namespace App\Repositories\Classs;
 */
class ClasssRepositoryEloquent extends BaseRepository implements ClasssRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Classs::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function updateClass($class_id)
    {
        Teachers::where('user_id', Auth::id())->update(['class_id' => $class_id]);
    }

    public function classOfTeacher($user_id)
    {
        $result = DB::table('teachers')
                ->join('class', 'teachers.class_id', '=', 'class.id')
                ->where('user_id', '=', $user_id)
                ->get()
                ->toArray();

        return $result;
    }

    public function listStudents($class_id)
    {
        $result = DB::table('students')
                ->join('attend', 'students.id', '=', 'attend.student_id')
                ->join('users', 'students.user_id', '=', 'users.id')
                ->where('class_id', '=', $class_id)
                ->get();

        return $result;
    }
}
