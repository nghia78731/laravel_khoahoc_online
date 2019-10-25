<?php


namespace App\Http\ViewComposers;


use App\Entities\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TestViewComposer
{
    public function compose(View $view) {
        if (Auth::check())
        {
            $user_role = Auth::user()->role_id;
            $user_id = Auth::id();

            if ($user_role == User::ROLE_STUDENT) {
                $notifications = DB::table('notification')
                    ->select('*')
                    ->where('user_id', '=', $user_id)
                    ->whereNull('teacher_id')
                    ->get();

                $countNotifi = DB::table('notification')
                            ->where('user_id', '=', $user_id)
                            ->whereNull('teacher_id')
                            ->count();
            }
            else {
                $notifications = DB::table('notification')
                    ->select('*')
                    ->where('teacher_id', '=', $user_id)
                    ->get();

                $countNotifi = DB::table('notification')
                    ->where('teacher_id', '=', $user_id)
                    ->count();
            }

            $view->with('notifications', $notifications);
            $view->with('countNotifi', $countNotifi);

        }

    }
}