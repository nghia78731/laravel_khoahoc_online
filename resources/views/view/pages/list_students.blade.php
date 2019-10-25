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
                    <h2>DANH SÁCH LỚP</h2>
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
                    </ul>
                    <div class="row course_boxes">
                        <!-- Popular Course Item -->
                        <div class="col-lg-12 course_box">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Tên học sinh</th>
                                        <th scope="col">Giới tính</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Thông tin học sinh</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listStudents as $listStudent)
                                        <tr>
                                                <th scope="row">{{ $listStudent->id }}</th>
                                                <th scope="row">{{ $listStudent->name }}</th>
                                                <th scope="row">{{ $listStudent->gender }}</th>
                                                <th scope="row">{{ $listStudent->phone }}</th>
                                                <th scope="row">{{ $listStudent->email }}</th>
                                                <th scope="row"><a href="{{ route('profile.index', ['role_id' => $listStudent->role_id, 'user_id' => $listStudent->user_id]) }}">Xem</a></th>
                                                <th scope="row"><span class="glyphicon glyphicon-trash"></span></th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('view.layout.footer')
