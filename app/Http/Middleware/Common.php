<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;

class Common {

    public function handle(Request $request, callable $next) {
        $key = config('app.user_session_token_key');
        $token = $request->header($key) ?? $request->cookie($key);
        $token && user(getUserByToken($token));
        return $next($request);
    }
}
