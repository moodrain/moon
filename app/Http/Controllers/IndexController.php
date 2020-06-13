<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class IndexController extends Controller {

    public function index() {
        return view('index', ['user' => user()]);
    }

}
