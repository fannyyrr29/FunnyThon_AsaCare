<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InviteController extends Controller
{
    public function index($id) {
        $user = User::find($id);
        $invitor = $user->senders()->where('status', 0)->get();
        $pending = $user->receivers()->where('status', 0)->get();
        $families = DB::table('families')
                ->where(function ($query) use ($id) {
                    $query->where('sender_id', $id)
                        ->orWhere('receiver_id', $id);
                })
                ->where('status', 1)
                ->get();
        return response()->json(compact('pending', 'invitor', 'families'));
    }

    public function addFriend(Request $request){
        try {
            $sender = User::find($request->sender_id);
            $receiver = User::find($request->receiver_id);
            $sender->receivers()->attach($receiver->id, ['status' => 0]);
    
            return response()->json([
                'header' => 'SUCCESS',
                'message' => 'Pertemanan Berhasil Ditambahkan!',
                'sender' => $sender,
                'receiver' => $receiver,
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['header' => 'ERROR', 
                                      'message' => "Gagal menambahkan pertemanan! " . $e->getMessage()], 
                                     500);
        }
    }

    public function searchFriend(Request $request){
        $userId = $request->user_id;
        $email = $request->email;

        try {
            $users = DB::select('
                SELECT *
                FROM users
                WHERE id != ?
                AND id NOT IN (1, 2)
                AND email LIKE ?
                AND id NOT IN (
                    SELECT sender_id FROM families WHERE receiver_id = ?
                    UNION
                    SELECT receiver_id FROM families WHERE sender_id = ?
                )
            ', [
                $userId, '%' . $email . '%', $userId, $userId
            ]);
            return response()->json(compact('users'));
        } catch (\Throwable $th) {
            return response()->json(['header' => 'ERROR', 'message' => 'Pengguna tidak ditemukan']);
        }
    }

    public function reject(Request $request){
        $sender = $request->sender_id;
        $receiver = $request->receiver_id;

        $request = DB::table('families')->where('sender_id', '=', $sender)->where('receiver_id', '=', $receiver)->where('status', '=', 0)->delete();
        if ($request) {
            return response()->json(['header'=>'SUKSES', 'message' => 'Pertemanan ditolak!']);
        }
        return response()->json(['header'=> 'GAGAL', 'message' => 'Pertemanan tidak dapat ditolak!']);

    }
    
}
