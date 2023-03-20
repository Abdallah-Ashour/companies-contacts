<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class welcomeController extends Controller
{
    // if we have one controller use the magic method __invoke

    // welcome method
    public function __invoke(){
        return view('welcome');
    } //end of welcome method
}
