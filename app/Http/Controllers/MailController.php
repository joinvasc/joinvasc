<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
 
class MailController extends Controller
{
    public function send($emailPaciente)
    {
        $obj = new \stdClass();

        Mail::to($emailPaciente)->send(new FollowEmail($obj));
    }
}