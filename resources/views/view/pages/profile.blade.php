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
                    <h1>THÔNG TIN TÀI KHOẢN</h1>
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

        <div class="row course_boxes">
            @foreach ($infoProfiles as $infoProfile)

            <div class="col-lg-2 course_box">
                <div class="card">
                    <div class="image-control">
                        <a href="#" data-izimodal-open="#modal" >

                                <img id="izi-modal" class="card-img-top" src="{{ asset('images/avatar/'. $infoProfile->user->image) }}"
                                     alt="Click vào để cập nhập avatar">

                        </a>
                    </div>

                    <div class="card-body text-center">

                            <p>
                                <label style="color: red">Tên:  </label>
                                <span>{{ $infoProfile->name }}</span>
                            </p>
                            <p>
                                <label style="color: red">Giới tính: </label>
                                <span>{{ $infoProfile->gender }}</span>
                            </p>
                            <p>
                                <label style="color: red">Phone: </label>
                                <span>{{ $infoProfile->phone }}</span>
                            </p>
                            <p>
                                <label style="color: red">Email: </label>
                                <span>{{ $infoProfile->email }}</span>
                            </p>
                            @if ($infoProfile->user->role_id == \App\Entities\Users\User::ROLE_STUDENT)
                                <div class="card-title btn btn-success">HỌC SINH</div>
                            @else
                                <div class="card-title btn btn-success">GIÁO VIÊN</div>
                            @endif

                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-lg-10 course_box">
                <div class="">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="true"
                               href="{{ route('info.index') }}">
                                <span>THÔNG TIN</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">


                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('styles/bootstrap4/popper.js') }}"></script>
        <script src="{{ asset('styles/bootstrap4/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/iziModal.min.js') }}" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#modal").iziModal();
            })
        </script>
@extends('view.layout.footer')
