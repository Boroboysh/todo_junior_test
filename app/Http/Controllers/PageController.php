<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function getMainPage()
    {
        return view('main');
    }

    public function getRegisterPage()
    {
        return view('auth.register');
    }

    public function getLoginPage()
    {
        return view('auth.login');
    }
}
