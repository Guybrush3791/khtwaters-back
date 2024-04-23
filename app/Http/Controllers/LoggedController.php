<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoggedController extends Controller
{

    public function index() {

        return view('logged.index');
    }
}
