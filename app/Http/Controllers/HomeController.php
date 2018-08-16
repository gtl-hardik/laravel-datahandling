<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Log;
use App\Jobs\SendWelcomeEmail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function send()
    {
        /*
        Log::info("Process without Queues started");
        Mail::send('email.welcome', ['data'=>'data'], function ($message) {

            $message->from('hardik112@gmail.com', 'Hardik Soni');

            $message->to('hardik112@gmail.com');

        });
        Log::info("Process without Queues finished");*/

        Log::info("Process with Queues Begins");
        //$this->dispatch(new SendWelcomeEmail()->delay(now()->addMinutes(2)));
        SendWelcomeEmail::dispatch()->delay(now()->addMinutes(2));
        Log::info("Process with Queues Ends");

        return "Record processed";
    }
}
