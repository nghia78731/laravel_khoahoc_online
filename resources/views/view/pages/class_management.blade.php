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
                    <h2>QUẢN LÝ LỚP HỌC</h2>
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
                               href="{{ route('class_management.index', $class_id) }}">
                                <span>THÊM CHƯƠNG HỌC</span>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="false"
                               href="{{ route('lession.index', $class_id) }}">
                                <span>THÊM BÀI HỌC</span>
                            </a>
                        </li>
                    </ul>
                    <div class="row course_boxes">
                        <!-- Popular Course Item -->
                        <div class="col-lg-9 course_box">
                            <form method="POST" action="{{ route('chapter.store') }}">
                                @csrf
                                <h2 style="text-align: center">Thêm chương học</h2>
                                <div class="form-group">
                                    <label>Tên chương học</label>
                                    <input type="text" name="name" style="width: 100%">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="class_id" value="{{ $class_id }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" style="text-align: center" class="btn btn-success">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('view.layout.footer')
