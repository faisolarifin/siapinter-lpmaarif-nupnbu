<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registerPage() {
        return view('auth.register');
    }
    public function loginPage() {
        return view('auth.login');
    }
    public function cekNpsnPage() {
        return view('auth.ceknpsn');
    }

    public function processCekNpsn() {


    }
}