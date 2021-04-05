<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecondController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except("showString1");
    }

    public function showString0(){
        return "Static String0";
    }
    public function showString1(){
        return "Static String1";
    }
    public function showString2(){
        return "Static String2";
    }
    public function showString3(){
        return "Static String3";
    }
}
