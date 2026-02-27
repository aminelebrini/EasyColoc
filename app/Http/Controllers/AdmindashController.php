<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmindashController extends Controller
{
    public function show()
    {
        return view('admindash');
    }

}
