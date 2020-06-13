<?php

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

function dj(...$elems) {
    $dump = count($elems) == 1 ? $elems[0] : $elems;
    header('Content-Type: application/json');
    echo json_encode($dump);
    exit;
}

function vd(...$elems) {
    $dump = count($elems) == 1 ? $elems[0] : $elems;
    var_dump($dump);
    exit;
}

function now($unix = false) {
    return $unix ? time() : date('Y-m-d H:i:s');
}

function rs($data = [], $msg = '', $code = 0) {
    return response()->json(compact('code', 'msg', 'data'));
}

function user($setUser = null) {
    static $user;
    $setUser && $user = $setUser;
    return $user;
}

function getUserByToken($token) {
    $userId = Cache::get(config('app.user_session_cache_key_prefix') . $token);
    if($userId) {
        return User::query()->find($userId);
    }
    return null;
}

function saveUserSession($userId) {
    $thirtyDays = 60 * 60 * 24 * 30;
    $token = md5(Str::random(16) . $userId);
    setcookie(config('app.user_session_token_key'), $token, time() + $thirtyDays);
    Cache::put(config('app.user_session_cache_key_prefix') . $token, $userId, $thirtyDays);
}

function clearUserSession($cacheKey) {
    setcookie(config('app.user_session_token_key'), '', time() - 100);
    Cache::forget(config('app.user_session_cache_key_prefix') . $cacheKey);
}

function expIf($if, $msg, $code = 1) {
    if($if) {
        throw new Exception($msg, $code);
    }
}

function bladeIncludeExp($exp) {
    if(! $exp) {
        return [];
    }
    $exps = explode(';', $exp);
    $result = [];
    foreach($exps as $exp) {
        [$key, $val] = explode(':', $exp);
        $result[$key] = $val;
    }
    return $result;
}