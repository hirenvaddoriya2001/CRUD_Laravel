<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dummyapi extends Controller
{
    function getdata(){
        return ["name"=>"darshan"];
    }
}
