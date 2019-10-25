<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">
    var messages          = $('.messages-content');

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        cluster: 'eu',
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('ChatEvent');


    // Bind a function to a Event (the full Laravel class)
    channel.bind('room-chat', function(data) {
        var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes();
        var newMessageHtml = `
                 <div class="message">
                                <div class="message-item user-name">
                                    `+data.user_email+`
                                </div>
                                <div class="message-item timestamp">
                                    | `+time+`:
                                </div>
                                <div class="message-item text-message">
                                   `+data.message+`
                                </div>
                 </div>
        `;

        messages.html(newMessageHtml + messages.html());
    });
</script>


