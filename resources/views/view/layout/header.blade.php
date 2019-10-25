<!DOCTYPE html>
<html lang="en">
<head>
    <title>Course</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Course Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/iziModal.min.css') }}">
    <link href="{{ asset('vnpay_php/assets/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="{{ asset('vnpay_php/assets/jumbotron-narrow.css') }}" rel="stylesheet">
    <script src="{{ asset('vnpay_php/assets/jquery-1.11.3.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.min') }}">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://skywalkapps.github.io/bootstrap-notifications/stylesheets/bootstrap-notifications.css">
    <!--[if lt IE 9]>
</head>
<body>

<div class="super_container">

    <!-- Header -->

    <header class="header d-flex flex-row" id="header-test">
        <div class="header_content d-flex flex-row align-items-center">
            <!-- Logo -->
            <div class="logo_container">
                <div class="logo">
                    <img src="{{ asset('images/lo.png') }}" alt="">
                    <span>course</span>
                </div>
            </div>
            <!-- Main Navigation -->
            <nav class="main_nav_container">
                <div class="main_nav">
                    <ul class="main_nav_list">
                        <li class="main_nav_item"><a href="#">home</a></li>
                        <li class="main_nav_item"><a href="#">about us</a></li>
                        <li class="main_nav_item"><a href="{{ route('course.index') }}">courses</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_side d-flex flex-row justify-content-center align-items-center" style="background-color: white">

            @if (\Illuminate\Support\Facades\Auth::check())
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <div class="dropdown dropdown-notifications">
                        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="{{ $countNotifi }}" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>

                        <div class="dropdown-menu dropmenu">
                            <div class="dropdown-toolbar">
                                <div class="dropdown-toolbar-actions">
                                    <a href="#">Mark all as read</a>
                                </div>
                                <h3 class="dropdown-toolbar-title">Notifications</h3>
                            </div>

                            <div class="nghia notification active" >

                                    @if (\Illuminate\Support\Facades\Auth::user()->role_id == $ROLE_STUDENT)
                                        @foreach ($notifications as $notification)
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="media-object">
                                                        <img src="https://api.adorable.io/avatars/71/1.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <strong class="notification-title">{{ $notification->title }}</strong>
                                                    <p class="notification-desc">

                                                    </p>
                                                    <div class="notification-meta">
                                                        <small class="timestamp">about a minute ago</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ($notifications as $notification)
                                            <div class="media">
                                                <form method="post" action="{{ route('course.store') }}">
                                                    @csrf
                                                    <div class="media-left">
                                                        <div class="media-object">
                                                            <img src="https://api.adorable.io/avatars/71/1.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <input type="hidden" value="{{ $notification->student_id }}" id="student_id" name="student_id">
                                                        <input type="hidden" value="{{ $notification->class_id }}" id="class_id" name="class_id">
                                                        <input type="hidden" value="{{ $notification->user_id }}" id="user_id" name="user_id">
                                                        <input type="hidden" value="Chúc mừng bạn đã được đăng ký" id="title" name="title">
                                                        <input type="hidden" value="{{ $notification->id }}" name="id">
                                                        <strong class="notification-title">{{ $notification->title }}</strong>
                                                        <p class="notification-desc">
                                                            <button>Chấp nhận</button>

                                                        </p>
                                                        <div class="notification-meta">
                                                            <small class="timestamp">about a minute ago</small>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endforeach
                                    @endif

                            </div>

                            <div class="dropdown-footer text-center">
                                <a href="#">View All</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </ul>
            </div>


            <div class="user-area dropdown float-right">
                @if (\Illuminate\Support\Facades\Auth::check())
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img style="height: 60px;width: 60px" class="user-avatar rounded-circle" src="{{ asset('images/avatar/' .\Illuminate\Support\Facades\Auth::user()->image) }}" alt="User Avatar">
                    </a>
                @else
                    <a href="{{ route('login.index') }}">Đăng nhập</a>
                @endif
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ route('info.index') }}"><i class="fa fa- user"></i>Cài đặt tài khoản</a>
                    @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == $ROLE_TEACHER)
                        <a class="nav-link" href="{{ route('class_room.index') }}"><i class="fa fa- user"></i>Giảng dạy</a>
                    @else
                        <a class="nav-link" href="{{ route('course.index') }}"><i class="fa fa- user"></i>Học tập</a>
                        <a class="nav-link" href="{{ route('courses_cost.index') }}"><i class="fa fa- user"></i>Nạp tiền <span class="count">13</span></a>
                    @endif

                    <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                    <a href="{{ route('login.destroy') }}" class="nav-link" href="#"><i class="fa fa-power -off"></i>Đăng xuất</a>
                </div>
            </div>
        </div>
        <div class="hamburger_container">
            <i class="fas fa-bars trans_200"></i>
        </div>

    </header>

    <!-- Menu -->
    <div class="menu_container menu_mm">

        <!-- Menu Close Button -->
        <div class="menu_close_container">
            <div class="menu_close"></div>
        </div>

        <!-- Menu Items -->
        <div class="menu_inner menu_mm">
            <div class="menu menu_mm">
                <ul class="menu_list menu_mm">
                    <li class="menu_item menu_mm"><a href="#">Home</a></li>
                    <li class="menu_item menu_mm"><a href="#">About us</a></li>
                    <li class="menu_item menu_mm"><a href="courses.html">Courses</a></li>
                    <li class="menu_item menu_mm"><a href="elements.html">Elements</a></li>
                    <li class="menu_item menu_mm"><a href="news.html">News</a></li>
                    <li class="menu_item menu_mm"><a href="contact.html">Contact</a></li>
                </ul>

                <!-- Menu Social -->

                <div class="menu_social_container menu_mm">
                    <ul class="menu_social menu_mm">
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>

                <div class="menu_copyright menu_mm">Colorlib All rights reserved</div>
            </div>

        </div>

    </div>
