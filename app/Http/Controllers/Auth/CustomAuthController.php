<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    public function adult(){
        return view('customAuth.index');
    }
}
