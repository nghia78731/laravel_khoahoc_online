<link rel="stylesheet" href="{{ asset('testmoi/style.css') }}" media="all">
<link href="{{ asset('testmoi/trung_new.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset('testmoi/all.min.css') }}">

<div class="khung_h">
    <div id="noidung">
        <style>
            .MathJax_SVG_Display {
                display: inline !important;
                width: inherit !important;
                margin: 0px;
            }
        </style>

        <div class="c1">
            <h2 class="header_decuong">Đề cương bài học</h2>
            <div class="decuong_toggle" style="height:813px; overflow:auto">
                @foreach($parentChapters as $parentChapter)
                    <div class="decuong_video_block">
                        <h3><i class="fal fa-book"></i>{{ $parentChapter->name }}</h3>
                        <div>
                            <div>
                                @foreach($parentChapter->Lession as $lession)
                                    <div class="c1">
                                        <div>
                                            <h4 class="dangchon mienphi">
                                                <i class="far fa-play-circle"></i>
                                                <a href="{{ route('join_lession.index', [$parentChapter->class_id, $lession->id]) }}">{{ $lession->name }}</a>
                                            </h4>
                                            <div class="div_video_dangxem"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @yield('content')
    </div>
</div>

