<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function login() {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('member.memberhome');
            } else if ($usertype == 'admin') {
                return view('index');
            } else {
                return redirect()->back();
            };
        };
    }
}
