<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function login() {
        $this->validate(request(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::query()->where('username', request('username'))->first();
        if(empty($user) || ! password_verify(request('password'), $user->password)) {
            return view('user.login')->with([
                'msg' => __('auth.failed'),
                'username' => request('username'),
            ]);
        }
        $user->last_logined_at = now();
        $user->save();
        saveUserSession($user->id);
        return redirect('/');
    }

    public function logout(Request $request) {
        $tokenKey = config('app.user_session_token_key');
        $token = $request->header($tokenKey) ?? $request->cookie($tokenKey);
        $cacheKey = config('app.user_session_cache_key_prefix') . $token;
        clearUserSession($cacheKey);
        return redirect('login');
    }

    public function register() {
        $this->validate(request(), [
            'username' => 'required|unique:users,username',
            'password' => 'required',
            're_password' => 'required',
        ]);
        if(request('password') != request('re_password')) {
            return view('user.register')->with([
                'username' => request('username'),
                'msg' => 'two password not the same',
            ]);
        }
        $user = new User;
        $user->username        = request('username');
        $user->password        = password_hash(request('password'), PASSWORD_DEFAULT);
        $user->nick            = request('username');
        $user->last_logined_at = now();
        $user->save();
        saveUserSession($user->id);
        return redirect('/');
    }

}