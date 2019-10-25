<?php

namespace App\Repositories\Users;

use App\Entities\Students\Students;
use App\Entities\Teachers\Teachers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Users\UserRepository;
use App\Entities\Users\User;
use App\Validators\Users\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\Users;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isStudent($user)
    {
        $result = $user->role_id == User::ROLE_STUDENT;

        return $result;
    }

    public function isTeacher($user)
    {
        $result = $user->role_id == User::ROLE_TEACHER;

        return $result;
    }

    public function changeAvatar($inputImage, $user_id)
    {
        $name_image = $inputImage->getClientOriginalName();

        $this->updateOrCreate([
            'id' => $user_id,
        ],[
            'image' => $name_image
        ]);
        $this->moveFile($inputImage);

        return $this;

    }

    public function moveFile($inputImage)
    {
        $name_image = $inputImage->getClientOriginalName();
        $inputImage->move('images\avatar', $name_image);

        return $this;
    }

    public function changePassword($new_password, $user_id)
    {
       $this->update(['password' => $new_password], $user_id);

       return $this;
    }

    public function registerAccount($info_user)
    {
        $user = $this->create($info_user);

        if ($user->role_id == User::ROLE_STUDENT)
            Students::create(['user_id' => $user->id, 'email' => $user->email]);
        else
            Teachers::create(['user_id' => $user->id, 'email' => $user->email]);
    }

}
