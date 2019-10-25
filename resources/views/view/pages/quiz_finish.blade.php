@extends('view.layout.header')
<link rel="stylesheet" href="{{ asset('testmoi/style.css') }}" media="all">
<link href="{{ asset('testmoi/trung_new.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset('testmoi/all.min.css') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

<div class="thongbaodiem">

    <div class="ketquath_div">
        <h1 class="danhgia1_tieuhoc center">Xin chúc mừng bạn đã hoàn thành</h1>
        <div class="danhgia2_tieuhoc center">
            @for($i = 1 ; $i <= $result->yellow_star; $i++)
                <i class="fas fa-star yellow_star"></i>
            @endfor
            @for($j = 1; $j <= $result->star; $j++)
                    <i class="fas fa-star"></i>
            @endfor
        </div>
        <h1 style="font-weight:300; color:white;"> Bạn đã trả lời đúng <span style="color:green">{{ $totalCorrected ."/". $totalQuestion->question_count }}</span> câu</h1>
        <div class="ketquath_btn_div">
            <div style="margin-top: -90px">
                <div class="trolaith_btn"  ><a href="{{ route('clear_quiz_result.store', [$totalQuestion->id, $totalQuestion->class_id]) }}"><i style="margin-top: 20px" class="fas fa-redo"></i></a></div>
                <p class="lamlaith_btn_text" style="font-size:1.5em; margin-top:0.5em;">Làm lại bài</p>
            </div>
            <div style="margin-top: -90px">
                <button class="dapan_btn" ><i class="fas fa-fish"></i></button>
                <p class="lamlaith_btn_text" style="font-size:1.5em; margin-top:0.5em;">Xem đáp án </p>
            </div>
            <div style="margin-top: -90px">
                <div class="trolaith_btn"  ><a href="{{ route('course.index') }}"><i style="margin-top: 20px" class="fas fa-list"></i></a></div>
                <p style="font-size:1.5em; margin-top:0.5em;" >Trở lại khóa học</p>
            </div>
        </div>
    </div>


</div>

@extends('view.layout.footer')




