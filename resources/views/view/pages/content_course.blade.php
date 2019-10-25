@extends('view.pages.join_course')

@section('content')
    <div class="c2" style="width:50.7%;">
        <div class="video">
            <div id="thanhdinhhuong">
                <div>
                    <a href="/">Trang chủ</a> > <a href="/lop-5/">{{ $lession->name }}</a>
                </div>
            </div>
            <div class="video">

                <iframe width="700" height="400" src="{{ $lession->url_video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


            </div>
        </div>


        <div class="khung_duoi_video">

            <div class="c1">
                <div>
                    <ul class="menu_chitiet">
                        <li class="active"><a name="gioithieu"
                                              href="/toan-lop-5/bai-6-phan-so-thap-phan-hon-so.html#gioithieu"><i
                                    class="fal fa-file-alt"></i>Giới thiệu nội dung bài học</a></li>
                    </ul>

                    <div id="#gioithieu" style="padding: 20px 20px;">
                        {{ $lession->content }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
