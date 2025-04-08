<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

use function Illuminate\Validation\Rules\message;

class PusherController extends Controller
{
    public function index($chat_id){
        return view('doctors.chat', compact('chat_id'));
    }
    public function broadcast(Request $request){
        broadcast(new PusherBroadcast($request->get('chat_id'), $request->get('message')))->toOthers();
        
        return view('doctors.chat', ['chat_id'=>$request->get('chat_id'),'message'=>$request->get('message')]);
    }
    public function receive(Request $request){
        return view('doctors.chat', ['chat_id'=>$request->get('chat_id'), 'message'=>$request->get('message')]);
    }

}
