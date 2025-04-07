<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

use function Illuminate\Validation\Rules\message;

class PusherController extends Controller
{
    public function index($chat_id){
        return view('users.konsultasi.index', compact('chat_id'));
    }
    public function broadcast(Request $request){
        broadcast(new PusherBroadcast($request->get('chat_id'), $request->get('message')))->toOthers();
        
        return view('users.konsultasi.broadcast', ['chat_id'=>$request->get('chat_id'),'message'=>$request->get('message')]);
    }
    public function receive(Request $request){
        return view('users.konsultasi.receive', ['chat_id'=>$request->get('chat_id'), 'message'=>$request->get('message')]);
    }

    // public function message(Request $request){
    //     event(new PusherBroadcast($request->input('username'), $request->input('message')));

    //     return[];
    // }
}
