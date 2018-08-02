<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DB;

class PendingRegistrationController extends Controller
{
    public function index()
    {
        return view('signup');
    }
    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $code = $request->input('code');

        \DB::table('pendingRegistration')->insert([
            ['name' => $name, 'email' => $email, 'password' => $password, 'code' => $code]
        ]);

        $approvedCodes = \DB::select('SELECT code FROM aprovedresearch');

        for($i=0; $i<sizeof($approvedCodes); $i++) 
        {
            if ($approvedCodes[$i]->code == $code)
            {
                \DB::table('users')->insert([
                    ['name' => $name, 'email' => $email, 'password' => $password, 'access_level' => 3]
                ]);
                continue;
            }
        }

        return view('auth.login');
    }
}
