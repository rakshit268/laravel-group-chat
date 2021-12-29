<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Redis;
use LRedis;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendMessage(Request $request){
     
        $redis = LRedis::connection();

        $data = ['message' => $request->message, 'user' => $request->user];
        
        $redis->publish('message', json_encode($data));
        
        return response()->json($data);
    }
}
