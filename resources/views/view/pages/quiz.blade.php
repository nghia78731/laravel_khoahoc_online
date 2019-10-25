@extends('view.layout.header')
    <link rel="stylesheet" href="{{ asset('testmoi/style.css') }}" media="all">
    <link href="{{ asset('testmoi/trung_new.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{ asset('testmoi/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">



<div class="background_tieuhoc">
    <br/>
    <div class="cot1">
        <div style="margin-left: 80%;position: fixed;border: 1px solid red;background: orange;margin-top: 10%;">Thời gian còn lại <p><span style="line-height: 74px;color: #ee7600;font-size: 34px;text-align: center;display: inline-block" id="time"></span></p>
        </div>
        <div class="khung_t">
            <div id="noidung">
                <div id="detuluyen_tieuhoc" style="background:none;">
                    <form method="post" action="{{ route('quiz.store') }}">
                        @csrf
                        <div class="noidungtuluyen_tieuhoc">
                            @foreach($quizs as $quiz)
                                <input type="hidden" value="{{ $quiz->duration }}" id="minutes">
                                <input type="hidden" name="question_count" value="{{ $quiz->question_count }}">
                                <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                @foreach($quiz->Question as $question)

                                    <div class="noidungtuluyen_tieuhoc_cauhoi danglamtieuhoc " id="question_id">
                                        <h2 class="tencauhoi">
                                            <p class="test">Câu {{ $question->id }}</p>
                                            <input type="hidden" name="question_{{ $question->id }}" value="{{ $question->id }}">
                                            <div class="cauhoi_span">{{ $question->question_text }}</div>

                                        </h2>
                                        <div class="ten_div"></div>
                                        <div class="cauhoi_tieuhoc_div">
                                            <ol type="A">
                                                @foreach ($question->Answer as $answer)
                                                    @if (isset($answer))
                                                        <label style="width:45%;" class="dapanoption">
                                                            <li class="answer">
                                                                <input type="radio" name="answer_question{{ $question->id }}" value="{{ $answer->correct. "|". $answer->id }}">
                                                                {{ $answer->answer_text }}
                                                            </li>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                            <button type="submit" class="nut" style="margin-left: 40%;height: 15%"><i class="fal fa-share-square"></i> Gửi bài làm</button>
                        </div>
                    </form>


                    <script language="javascript">
                        function startTimer(duration, display) {
                            var timer = duration, minutes, seconds;
                            setInterval(function () {
                                minutes = parseInt(timer / 60, 10);
                                seconds = parseInt(timer % 60, 10);

                                minutes = minutes < 10 ? "0" + minutes : minutes;
                                seconds = seconds < 10 ? "0" + seconds : seconds;

                                display.textContent = minutes + ":" + seconds;

                                if (--timer < 0) {
                                   $('.nut').click();
                                   alert('Thời gian làm bài đã hết')
                                }
                            }, 1000);
                        }

                        window.onload = function () {
                            var minutes = $('#minutes').val(),
                                duration = 60 * minutes,
                                display = document.querySelector('#time');
                            startTimer(duration, display);
                        };
                    </script>


@extends('view.layout.footer')




