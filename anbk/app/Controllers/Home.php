<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['menu'] = 'Dashboard';
        dd(user());
        return view('user/index', $data);
    }

    public function login()
    {
        $data['menu'] = 'Dashboard';
        return view('auth/login', $data);
    }
    public function register()
    {
        $data['menu'] = 'Dashboard';
        return view('auth/register', $data);
    }
    public function user()
    {
        $data['menu'] = 'Dashboard';
        return view('user/index', $data);
    }
    public function tulis($satu)
    {
        dd($satu);
    }
}
