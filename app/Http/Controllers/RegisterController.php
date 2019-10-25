<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register;
use App\Repositories\Classs\ClasssRepository;
use App\Repositories\Students\StudentsRepository;
use App\Repositories\Teachers\TeachersRepository;
use App\Repositories\Users\UserRepository;
use App\Students;
use App\Teachers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation;

class RegisterController extends Controller
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
        return view('admin.pages.register');
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
    public function store(Register $request)
    {
        $info_user = $request->except(['_token', 'name']);
        $this->user->registerAccount($info_user);

        return redirect('login')->with('success', 'Đăng ký tài khoản thành công');
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
}
