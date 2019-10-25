@extends('view.layout.jsChat')
<!DOCTYPE html>
<html>
<head>
    <title>Chat App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chat.css') }}">
    <style type="text/css">
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }
        html,
        body {
            height: 100%;
        }
        body {
            background: linear-gradient(135deg, #044f48, #2a7561);
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            line-height: 1.3;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div id="app">
    <template>
        <div>
            <div class="chat">
                <div class="chat-title">
                    <h1>Chatroom</h1>
                </div>
                <div class="messages">
                    <div class="messages-content">
                        @foreach ($messages as $message)
                            <div class="message">
                                <div class="message-item user-name">
                                    {{ $message->user_email }}
                                </div>
                                <div class="message-item timestamp">
                                    | {{ $message->time }}:
                                </div>
                                <div class="message-item text-message">
                                   {{ $message->message }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                    <div class="message-box">
                        <input type="text" name="message" class="message-input" placeholder="Type message..." onkeyup="enter()">
                        <input type="hidden" class="user_email" name="user_email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                        <input type="hidden" class="time" name="time" value="{{date('H:i') }}">
                        <button type="button" class="message-submit" onclick="load_message()">Send</button>
                    </div>
            </div>
            <div class="bg"></div>
        </div>
    </template>
</div>
<script src="/js/app.js"></script>
<script type="text/javascript">
    function load_message() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : "post",
            url : "{{ route('chat.send') }}",
            data : {
                message : $('.message-input').val(),
                user_email : $('.user_email').val(),
                time : $('.time').val()
            },
            success : function (data) {
                console.log(data)
            }
        });
    }
    function enter() {
        if (event.keyCode === 13) {
            event.preventDefault();
            $('.message-submit').click();
            $('.message-input').val('');
        }
    }



</script>
</body>
</html>