<?php

namespace App\Repositories\Users;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\Users;
 */
interface UserRepository extends RepositoryInterface
{
    public function isStudent($user);
    public function isTeacher($user);
    public function changeAvatar($inputImage, $user_id);
    public function moveFile($inputImage);
    public function changePassword($new_password, $user_id);
    public function registerAccount($info_user);
}
