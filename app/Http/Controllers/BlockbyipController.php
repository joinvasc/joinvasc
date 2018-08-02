<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class BlockbyipController extends Controller
{
	public function index()
	{
		//$ip = $request->input('ip');

		/*
		DB::table('ip')->insert(
		['ipBlocked' => $ip]
		);
		*/

		return view('ip');
	}

	public function returnIp()
	{
		$ipBloqueado = DB::Table('ip')->select('ipBlocked');
		return view('ip', ["ipBloqueados" => $ipBloqueado]);
	}
}