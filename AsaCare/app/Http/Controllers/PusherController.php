<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

use function Illuminate\Validation\Rules\message;

class PusherController extends Controller
{
    public function index(){
        return view('users.konsultasi.index');
    }
    public function broadcast(Request $request){
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();
        
        return view('users.konsultasi.broadcast', ['message'=>$request->get('message')]);
    }
    public function receive(Request $request){
        return view('users.konsultasi.receive', ['message'=>$request->get('message')]);
    }

    // public function message(Request $request){
    //     event(new PusherBroadcast($request->input('username'), $request->input('message')));

    //     return[];
    // }
}
