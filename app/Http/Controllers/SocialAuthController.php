<?php

namespace App\Http\Controllers;

use App\Entities\Students\Students;
use App\Entities\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $getInfo = Socialite::driver('facebook')->user();
        $user = $this->createUser($getInfo,'facebook');
        Auth::login($user);

        return redirect()->route('home');
    }

    function createUser($getInfo){
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'role_id'     => 1,
                'email'    => $getInfo->email,
                'image' => $getInfo->avatar,
                'provider' => 'facebook',
                'provider_id' => $getInfo->id
            ]);

            Students::create([
                'user_id'     => $user->id,
                'name'    => $getInfo->name,
                'email' => $getInfo->email,
            ]);
        }

        return $user;
    }


}
