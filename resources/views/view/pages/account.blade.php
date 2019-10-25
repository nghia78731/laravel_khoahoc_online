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
                    <h1>TÀI KHOẢN VÀ MẬT KHẨU</h1>
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

            <div class="col-lg-2 course_box">
                <div class="card">
                    <div class="image-control">
                        <a href="#" data-izimodal-open="#modal" >
                            @foreach($customers as $customer)
                                <img id="izi-modal" class="card-img-top" src="{{ asset('images/avatar/' .$customer->user->image) }}"
                                     alt="Click vào để cập nhập avatar">
                            @endforeach
                        </a>
                    </div>
                    <div id="modal">
                        <form action="{{ route('info.avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="file">
                                <input type="file" name="image">
                            </div>
                            <br>
                            <input name="zoom" type="range" min="1" max="3" step="0.01" value="1" style="width: 15%; margin: 0px auto">
                            <br>
                            <button type="submit" value="save"><span>Lưu</span></button>
                            <button  value="cancel" data-izimodal-close="" data-izimodal-transitionout="bounceOutDown">Hủy bỏ</button>
                        </form>
                    </div>
                    <div class="card-body text-center">
                            @foreach ($customers as $customer)
                                <p>
                                    <label style="color: red">Tên:  </label>
                                    <span>{{ $customer->name }}</span>
                                </p>
                                <p>
                                    <label style="color: red">Giới tính: </label>
                                    <span>{{ $customer->gender }}</span>
                                </p>
                                <p>
                                    <label style="color: red">Phone: </label>
                                    <span>{{ $customer->phone }}</span>
                                </p>
                                <p>
                                    <label style="color: red">Email: </label>
                                    <span>{{ $customer->email }}</span>
                                </p>
                            @if ($customer->role_id == $ROLE_STUDENT)
                                <div class="card-title btn btn-success">HỌC SINH</div>
                            @endif
                                <div class="card-title btn btn-success">GIÁO VIÊN</div>
                            @endforeach

                    </div>
                </div>
            </div>
            <div class="col-lg-10 course_box">
                <div class="">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="true"
                               href="{{ route('info.index') }}">
                                <span>THÔNG TIN</span>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a id="tap1-tab-info" role="tab" aria-controls="tap1-pane-info" aria-selected="false"
                               href="{{ route('account.show') }}">
                                <span>TÀI KHOẢN VÀ MẬT KHẨU</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <form action="#" method="post">
                            @csrf
                            <div class="row">
                                @csrf
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p><span class="display_name">Tài khoản</span></p>
                                                @foreach($customers as $customer)
                                                    <p><input class="display_input" name="name" type="text" value="{{$customer->user->email}}" readonly="true"></p>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p><span class="display_name">Mật khẩu cũ</span></p>
                                                <p><input class="display_input" name="old_password" type="password" value=""></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p><span class="display_name">Mật khẩu mới</span></p>
                                                <p><input class="display_input" name="new_password" type="password" value=""></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p><span class="display_name">Mật khẩu mới</span></p>
                                                <p><input class="display_input" name="new_password_confirmation" type="password" value=""></p>
                                            </div>
                                        </div>

                                <div class="col-md-12" style="text-align: center;">
                                    <button style="width: 100%" class="btn btn-dark " type="submit"><span >Cập nhập</span></button>
                                </div>
                            </div>
                        </form>
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

