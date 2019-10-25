
@extends('view.layout.jsPusherReturn')

@extends('view.layout.header')


<link rel="stylesheet" type="text/css" href="{{ asset('styles/courses_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/courses_responsive.css') }}">

<div class="home">
    <div class="home_background_container prlx_parent">
        <div class="home_background prlx"
             style="background-image:url({{ asset('images/courses_background.jpg') }}"></div>
    </div>

    <div class="home_content">
        <h1>THÔNG TIN </h1>
    </div>
</div>
<div class="popular page_section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title text-center">
                    <h1 id="monhoc">HỌC TẬP</h1>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('thongbao'))
            <div class="btn btn-success" style="width: 100%">
                {{ session('thongbao') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="btn btn-danger" style="width: 100%">
                {{ session('error') }}
            </div>
        @endif

        <div class="row course_boxes">
            <div class="col-lg-2 course_box"></div>
            <div class="col-lg-10 course_box">
                <div class="">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="true"
                               href="{{ route('course.index') }}">
                                <span>MÔN HỌC MIỄN PHÍ</span>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="false"
                               href="{{ route('group-chat.index') }}">
                                <span>CHAT NHÓM</span>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="true"
                               href="{{ route('courses_cost.index') }}">
                                <span>MÔN HỌC TRẢ PHÍ</span>
                            </a>
                        </li>
                    </ul>
                    <div class="row course_boxes">
                        <!-- Popular Course Item -->

                        @foreach ($infoCourses as $infoCourse)
                            @if(!isset($infoCourse->classOfTeacher->price))
                                    <div class="col-lg-4 course_box">
                                            <div class="card">
                                                <form method="post" action="{{ route('postMessage') }}">
                                                    @csrf
                                                    <img class="card-img-top" src="{{  asset('images/' . $infoCourse->classOfTeacher->image) }}" alt="https://unsplash.com/@claybanks1989">
                                                    <div class="card-body text-center">
                                                        <div class="card-title"><span style="color: red;font-size: medium" >Tên môn học: </span>{{ $infoCourse->classOfTeacher->name }}</div>
                                                        <div class="card-text"><span style="color: red;font-size: medium">Mô tả: </span>{{ $infoCourse->classOfTeacher->description }}</div>
                                                        <div class="card-quantity"><span style="color: red;font-size: medium">Số lượng: </span>{{ $infoCourse->classOfTeacher->current_quantity }} / {{ $infoCourse->classOfTeacher->capacity }}</div>
                                                    </div>
                                                    <div class="price_box d-flex flex-row align-items-center">
                                                        <div class="course_author_name">{{ $infoCourse->name }} <span>Author</span></div>
                                                    </div>
                                                        <div>
                                                            <input type="hidden" id="student_id" name="student_id" value="{{ $student_id }}">
                                                            <input type="hidden" id="class_id" name="class_id" value="{{ $infoCourse->classOfTeacher->id }}">
                                                            <input type="hidden" id="title" name="title" value="Bạn có học sinh {{ $infoCourse->name }} yêu cầu tham gia lớp học">
                                                            <input type="hidden" id="user_id" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                                            <input type="hidden" id="teacher_id" name="teacher_id" value="{{ $infoCourse->user_id }}">
                                                                @if (@$infoCourse->studentAttend->user_id == \Illuminate\Support\Facades\Auth::id())
                                                                <a href="{{ route('join_course.index', $infoCourse->class_id) }}"><span class="btn btn-info" style="width: 100%; height: 100%">Bắt đầu khóa học</span></a>
                                                                <a href="{{ route('quiz.index', $infoCourse->class_id) }}"><span class="btn btn-info" style="width: 100%; height: 100%">Trắc nghiệm ôn tập</span></a>
                                                                @elseif($infoCourse->classOfTeacher->current_quantity  < $infoCourse->classOfTeacher->capacity)
                                                                <button type="submit" class="btn btn-success" style="width: 100%">Đăng ký học</button>
                                                                    @else
                                                                <span class="btn btn-danger" style="width: 100%; height: 100%">Lớp đã hết chỗ</span>
                                                                @endif
                                                        </div>
                                                </form>
                                            </div>
                                    </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('view.layout.footer')

