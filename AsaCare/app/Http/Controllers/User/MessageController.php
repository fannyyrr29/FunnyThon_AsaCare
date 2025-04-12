<?php

namespace App\Http\Controllers\User;

use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $consultation = Consultation::create(['user_id'=> Auth::id(), 'doctor_id' => $request->input('doctor_id')]);
        
        $consultation_id = $consultation->id;
        $doctor_name = $request->input('doctor_name');
        $messages = Message::with(['sender'])->where('consultation_id', $consultation_id)->get();
        if($messages){
            return view('users.chat', compact('messages', 'consultation_id', 'doctor_name'));
            // return response()->json($messages);
        }
        return view('users.chat', compact('consultation_id', 'doctor_name'));
    }
    public function broadcast(Request $request){
        $consultation_id = $request->get('consultation_id');
        $doctor_name = $request->get('doctor_name');

        broadcast(new PusherBroadcast($consultation_id, $request->get('message')))->toOthers();

        $message = new Message();
        $message->consultation_id = $consultation_id;
        $message->sender_id = $request->get('sender_id');
        $message->message = $request->get('message');
        $message->save();
        
        $messages = Message::with(['sender'])->get();
        return view('users.chat', compact('messages', 'consultation_id', 'doctor_name'));
        // return view('doctors.chat', ['consultation_id'=>$request->get('consultation_id'), 'message'=>$request->get('message')]);
    }
    public function receive(Request $request){
        $doctor_name = $request->get('doctor_name');
        $consultation_id = $request->get('consultation_id');
        $messages = Message::with(['sender'])->get();
        return view('users.chat', compact('messages', 'consultation_id', 'doctor_name'));
        // return view('doctors.chat', ['consultation_id'=>$request->get('consultation_id'), 'message'=>$request->get('message')]);
    }
}
