
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
                    <h1 id="monhoc">CHAT NHÓM</h1>
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
                                <span>MÔN HỌC</span>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="false"
                               href="#">
                                <span>CHAT NHÓM</span>
                            </a>
                        </li>
                    </ul>
                    <div class="row course_boxes">
                        <!-- Popular Course Item -->
                        @foreach ($infoAttends as $infoAttend)
                            <div class="col-lg-4 course_box">
                                <div class="card">
                                        @csrf
                                        <img class="card-img-top" src="{{ asset('images/'. $infoAttend->Classs->first()->image) }}" alt="https://unsplash.com/@claybanks1989">
                                        <div class="card-body text-center">
                                            <div class="card-title"><span style="color: red;font-size: medium" >Tên môn học: {{ $infoAttend->Classs->first()->name }}</span></div>
                                        </div>
                                        <div>
                                            <a href="{{ route('chat.show', $infoAttend->Classs->first()->id) }}" class="btn btn-success" style="width: 100%; height: 100%">Tham gia nhóm chat</a>
                                        </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


