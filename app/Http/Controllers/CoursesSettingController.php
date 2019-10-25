<?php

namespace App\Http\Controllers;

use App\Classs;
use App\Repositories\Attend\AttendRepository;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\OrderClass\OrderClassRepository;
use App\Repositories\Students\StudentsRepository;
use App\Repositories\Teachers\TeachersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class CoursesSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $teachers, $students, $attend, $notification, $orderClass;

    public function __construct(
        TeachersRepository $teachersRepository,
        StudentsRepository $studentsRepository,
        AttendRepository $attendRepository,
        NotificationRepository $notificationRepository,
        OrderClassRepository $orderClassRepository
    ) {
        $this->students     = $studentsRepository;
        $this->teachers     = $teachersRepository;
        $this->attend       = $attendRepository;
        $this->notification = $notificationRepository;
        $this->orderClass = $orderClassRepository;
    }

    public function index()
    {
        $infoCourses = $this->teachers->showInfoCourse();
        $student_id = $this->students->getStudentId(Auth::id());

        return view('view.pages.courses', compact(['infoCourses', 'student_id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $this->attend->registerCourse($data);
        $this->notification->addNotification($data);
        $this->notification->deleteNotification($request->id);
        $this->returnNotifiCourse($data['user_id']);

        return back()->with('thongbao', 'Đăng ký lớp thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function returnNotifiCourse($user_id)
    {
        $data['title'] = "Chúc mừng bạn đã được đăng ký";
        $options = array(
            'cluster' => 'eu',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('ReturnNotifiCourse', 'send-message'. $user_id, $data);
    }
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

    public function showCoursesCost()
    {
        $infoCourses = $this->teachers->showInfoCourse();
        $student_id = $this->students->getStudentId(Auth::id());

        return view('view.pages.courses_cost', compact(['infoCourses', 'student_id']));
    }

    public function addCoursesCost(Request $request)
    {
        $data = $request->except('_token');
        //$this->attend->registerCourse($data);


        return $data;
    }
}
