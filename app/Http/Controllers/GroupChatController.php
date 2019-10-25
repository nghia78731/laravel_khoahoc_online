<?php

namespace App\Http\Controllers;

use App\Repositories\Attend\AttendRepository;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\Students\StudentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class GroupChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $student, $attend, $chat;
    public function __construct(StudentsRepository $studentsRepository,
                                AttendRepository $attendRepository,
                                ChatRepository $chatRepository)
    {
        $this->student = $studentsRepository;
        $this->attend = $attendRepository;
        $this->chat = $chatRepository;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

    public function index()
    {
        $student_id = $this->student->getStudentId(Auth::id());
        $infoAttends = $this->attend->getInfoAttend($student_id);

        return view('view.pages.group_chat', compact('infoAttends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showChat()
    {
        $messages = $this->chat->showMessageChat();

        return view('view.pages.chat', compact('messages'));
    }

    public function sendChat(Request $request)
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

        $pusher->trigger('ChatEvent', 'room-chat', $data);
        $this->chat->addMessageChat($data);

    }
}
