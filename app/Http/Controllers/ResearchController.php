<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DB;

class ResearchController extends Controller
{
	public function index()
	{
		return view('research');
    }
    
    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $university = $request->input('university');
        $indicated = $request->input('indicated');

        \DB::table('research')->insert([
            ['name' => $name, 'email' => $email, 'university' => $university, 'indicated' => $indicated]
        ]);

        return view('auth.login');
    }
}