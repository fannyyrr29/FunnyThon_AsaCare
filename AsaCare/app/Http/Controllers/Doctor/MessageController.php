<?php

namespace App\Http\Controllers\Doctor;

use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $consultation_id = $request->input('consultation_id');
        $user_name = $request->input('user_name');
        $messages = Message::with(['sender'])->get();
        if($messages){
            return view('doctors.chat', compact('messages', 'consultation_id', 'user_name'));
            // return response()->json($messages);
        }
        return view('doctors.chat');
    }
    public function broadcast(Request $request){
        $consultation_id = $request->get('consultation_id');
        
        broadcast(new PusherBroadcast($consultation_id, $request->get('message')))->toOthers();

        $message = new Message();
        $message->consultation_id = $consultation_id;
        $message->sender_id = $request->get('sender_id');
        $message->message = $request->get('message');
        $message->save();
        
        $messages = Message::with(['sender'])->get();
        return view('doctors.chat', compact('messages', 'consultation_id'));
        // return view('doctors.chat', ['consultation_id'=>$request->get('consultation_id'), 'message'=>$request->get('message')]);
    }
    public function receive(Request $request){
        $consultation_id = $request->get('consultation_id');
        $messages = Message::with(['sender'])->get();
        return view('doctors.chat', compact('messages', 'consultation_id'));
        // return view('doctors.chat', ['consultation_id'=>$request->get('consultation_id'), 'message'=>$request->get('message')]);
    }

}
