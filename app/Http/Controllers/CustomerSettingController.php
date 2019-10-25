<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeAvatar;
use App\Http\Requests\ChangePassword;
use App\Repositories\Students\StudentsRepository;
use App\Repositories\Teachers\TeachersRepository;
use App\Repositories\Users\UserRepository;
use App\Entities\Users\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CustomerSettingController extends Controller
{
    protected $students, $teachers, $user;


    public function __construct(StudentsRepository $studentsRepository,
                                TeachersRepository $teachersRepository,
                                UserRepository $userRepository)
    {
        $this->students = $studentsRepository;
        $this->teachers = $teachersRepository;
        $this->user = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id =  Auth::id();
        $teacher = $this->user->isTeacher($this->user->find($user_id));

        if ($teacher)
            $customers = $this->teachers->getInfo($user_id);
        else
            $customers = $this->students->getInfo($user_id);

        return view('view.pages.customer', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $teacher = $this->user->isTeacher($this->user->find($user_id));

        if ($teacher) {
            $value = $request->except('_token');

            $this->teachers->updateOrCreate(['user_id' => $user_id], $value);
        }
        else {
            $value = $request->except('_token');
            $this->students->updateOrCreate(['user_id' => $user_id], $value);
        }

        return back()->with('thongbao', 'Cập nhập thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeAvatar(ChangeAvatar $request)
    {
        $user_id = Auth::id();
        if ($request->hasFile('image'))
            $this->user->changeAvatar($request->image, $user_id);

        return back()->with('thongbao', 'Thay đổi Avatar thành công');
    }

    public function showAccount()
    {
        $user_id = Auth::id();
        $teachers = $this->user->isTeacher($this->user->find($user_id));
        if ($teachers)
            $customers = $this->teachers->getInfo($user_id);
        else
            $customers = $this->students->getInfo($user_id);

        return view('view.pages.account', compact('customers'));
    }

    public function changePassword(ChangePassword $request)
    {
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $user_id = Auth::id();

        if (Auth::check())
            if (Hash::check($old_password, Auth::user()->getAuthPassword()))
                $this->user->changePassword($new_password, $user_id);
            else
                return back()->with('error', 'Mật khẩu cũ không đúng');
        else
            return redirect('login');

        return back()->with('thongbao', 'Thay đổi mật khẩu thành công');
    }

    public function showProfile($role_id, $user_id)
    {
        if ($role_id == User::ROLE_STUDENT)
            $infoProfiles = $this->students->getInfo($user_id);
        else
            $infoProfiles = $this->teachers->getInfo($user_id);

        return view('view.pages.profile', compact('infoProfiles'));
    }
}
