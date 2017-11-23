<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;


class SiteController extends Controller
{
    public function index(){
    	
    	return view('layouts.template');

    }


}
