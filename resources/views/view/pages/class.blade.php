@extends('view.layout.header')
<link rel="stylesheet" type="text/css" href="{{ asset('styles/courses_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/courses_responsive.css') }}">


<div class="home">
    <div class="home_background_container prlx_parent">
        <div class="home_background prlx"
             style="background-image:url({{ asset('images/courses_background.jpg') }}"></div>
    </div>

    <div class="home_content">
        <h2>ĐĂNG KÝ LỚP HỌC </h2>
    </div>
</div>
<div class="popular page_section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title text-center">
                    <h1>GIẢNG DẠY</h1>
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
                               href="{{ route('class_room.index') }}">
                                <span>ĐĂNG KÝ DẠY</span>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="false"
                               href="{{ route('class_detail.index') }}">
                                <span>CHI TIẾT LỚP HỌC</span>
                            </a>
                        </li>
                    </ul>
                            <div class="row course_boxes">
                                <!-- Popular Course Item -->
                                @foreach ($teachers as $teacher)
                                    @if ($teacher->class_id < 1)
                                        @foreach ($class_rooms as $class_room)
                                                <div class="col-lg-4 course_box">
                                                    <form method="post" action="{{ route('class_room.store') }}">
                                                     @csrf
                                                        <div class="card">
                                                            <img class="card-img-top" src="{{ asset('images/' . $class_room->image) }}">
                                                            <div class="card-body text-center">
                                                                <div class="card-title"><a href="courses.html">Tên lớp học: {{ $class_room->name }}</a></div>
                                                                <div class="card-text">Mô tả: {{ $class_room->description }}</div>
                                                            </div>

                                                            <div class="class_id"><input type="hidden" name="class_id" value="{{ $class_room->id }}"></div>
                                                            <div class="price_box d-flex flex-row" style="padding-left: 0;">
                                                                <button type="submit" class="btn btn-success" style="width: 100%; height: 100%">Nhận lớp</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-warning" style="width: 100%">Bạn chỉ được đăng ký 1 lớp học</div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

@extends('view.layout.footer')
