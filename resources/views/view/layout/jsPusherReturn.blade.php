<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationMenu = notificationsWrapper.find('div.dropmenu');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationMenu.find('div.nghia');



    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        cluster: 'eu',
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('ReturnNotifiCourse');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('send-message{{ \Illuminate\Support\Facades\Auth::id() }}', function(data) {

        var existingNotifications = notifications.html();
        var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        var newNotificationHtml = `
                <div class="media">

            <div class="media-left">
              <div class="media-object">
                <img src="https://api.adorable.io/avatars/71/\`+avatar+\`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
              </div>
            </div>
            <div class="media-body">

                                  <strong class="notification-title">`+data.title+`</strong>
                                  <p class="notification-desc">

                                  </p>
                                  <div class="notification-meta">
                                    <small class="timestamp">about a minute ago</small>
                                  </div>
                                </div>
                              </div>

        `;

        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });
</script>

