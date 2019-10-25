<?php

namespace App\Http\Controllers;

use App\Repositories\Notification\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class SendNotification extends Controller
{
    public $notification;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notification = $notificationRepository;
    }

    public function index()
    {
        return view('send_message');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $options = array(
            'cluster' => 'eu',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('NotifiCourse', 'send-message'. $data['teacher_id'], $data);
        $this->notification->addNotification($data);

        return redirect()->route('course.index');
    }


}
