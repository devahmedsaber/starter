<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class UserController extends Controller
{
    public function showUserName(){
        return "Ahmed Saber";
    }

    public function getIndex(){
//        $data = [];
//        $data["id"] = 22;
//        $data["name"] = "ahmmmmed";
//
//        $obj = new \stdClass();
//        $obj->name = "Ahmed";
//        $obj->id = 4;
//        $obj->gender = "Male";
        $data = [];
        return view('welcome', compact("data"));
    }
}
