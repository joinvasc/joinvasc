<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class QRCodeController extends Controller
{
	public function index()
	{
		return view('qrcode');
	}
}