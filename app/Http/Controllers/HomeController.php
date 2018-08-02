<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$ip_visitante = $_SERVER['REMOTE_ADDR'];
        return view('home');
    }
}
