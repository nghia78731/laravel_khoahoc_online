<?php

namespace App\Http\Controllers;

use App\Entities\Teachers\Teachers;
use App\Repositories\Chapter\ChapterRepository;
use App\Repositories\Classs\ClasssRepository;
use App\Repositories\Lession\LessionRepository;
use App\Repositories\Students\StudentsRepository;
use App\Repositories\Teachers\TeachersRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSettingController extends Controller
{

    protected $class, $teachers, $user, $chapter, $lession;


    public function __construct(ClasssRepository $classRepository,
                                TeachersRepository $teachersRepository,
                                ChapterRepository $chapterRepository,
                                LessionRepository $lessionRepository
                                )
    {
        $this->class = $classRepository;
        $this->teachers = $teachersRepository;
        $this->chapter = $chapterRepository;
        $this->lession = $lessionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_rooms = $this->class->all();
        $teachers = $this->teachers->getInfo(Auth::id());

        return view('view.pages.class', compact(['class_rooms', 'teachers']));
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
       $this->class->updateClass($request->class_id);

        return back()->with('thongbao', 'Nhận lớp thành công');
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

    public function showClassDetail()
    {
        $classDetails = $this->class->classOfTeacher(Auth::id());

        return view('view.pages.class_detail', compact('classDetails'));
    }

    public function showListStudents($class_id)
    {
        $listStudents = $this->class->listStudents($class_id);

        return view('view.pages.list_students', compact('listStudents'));
    }

    public function showClassManagement($class_id)
    {
        return view('view.pages.class_management', compact('class_id'));
    }

    public function addChapter(Request $request)
    {
        $array = $request->except('_token');
        $this->chapter->create($array);

        return back()->with('thongbao', 'Thêm chương học thành công');
    }

    public function showLession($class_id)
    {
        $chapters = $this->chapter->getChapter($class_id);

        return view('view.pages.lession', compact(['class_id', 'chapters']));
    }

    public function addLession(Request $request)
    {
        $array = $request->except('_token');
        $this->lession->create($array);

        return back()->with('thongbao', 'Thêm bài học thành công');
    }
}
