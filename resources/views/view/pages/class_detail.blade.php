@extends('view.layout.header')
<link rel="stylesheet" type="text/css" href="{{ asset('styles/courses_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/courses_responsive.css') }}">

<div class="home">
    <div class="home_background_container prlx_parent">
        <div class="home_background prlx"
             style="background-image:url({{ asset('images/courses_background.jpg') }}"></div>
    </div>

    <div class="home_content">
        <h2>GIẢNG DẠY</h2>
    </div>
</div>
<div class="popular page_section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title text-center">
                    <h2>CHI TIẾT LỚP HỌC</h2>
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
                                <span>ĐĂNG KÝ LỚP HỌC</span>
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
                                    <div class="col-lg-4 course_box">
                                        @foreach($classDetails as $classDetail)
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('images/'. $classDetail->image) }}">
                                                    <div class="card-body text-center">
                                                        <div class="card-title"><a href="courses.html">Tên lớp học: {{ $classDetail->name }}</a></div>
                                                          <div class="card-text">Mô tả: {{ $classDetail->description }}</div>
                                                        <div class="card-capacity">Số lượng: {{ $classDetail->current_quantity}} / {{ $classDetail->capacity }}</div>
                                                    </div>
                                                    <div class="price_box d-flex flex-row" style="padding-left: 0;">
                                                        <a href="{{ route('list_students.index', $classDetail->id) }}" class="btn btn-success" style="width: 100%; height: 100%; padding: 20px">Danh sách lớp</a>
                                                        <a href="{{ route('class_management.index', $classDetail->id) }}" class="btn btn-success" style="width: 100%; height: 100%; padding: 20px">Quản lý lớp học</a>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('view.layout.footer')
