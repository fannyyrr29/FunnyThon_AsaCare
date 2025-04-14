<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Drug;
use App\Models\Family;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InviteController extends Controller
{
    public function index() {
        $id = Auth::id(); // Tambahkan ini untuk menghindari error "undefined variable"
    
        $user = User::find($id);
        $invitor = $user->senders()->where('status', 0)->get();
        $pending = $user->receivers()->where('status', 0)->get();

        $rawRecords = DB::table('medical_records as mr')
            ->join('drug_records as dr', 'mr.id', '=', 'dr.medical_record_id')
            ->select(
                'mr.id',
                'mr.diagnose',
                'mr.description',
                'mr.date',
                'mr.rating',
                'mr.doctor_id',
                'dr.drug_id',
                'dr.amount'
            )
            ->where('mr.user_id', '=', $id)
            ->get();

        // if ($rawRecords->isEmpty()) {
        //     return response()->json(['message' => "Data tidak ditemukan!"], 404);
        // }

        // Grouping berdasarkan medical record ID
    
        $families = Family::with(['sender', 'receiver'])
            ->where(function ($query) use ($id) {
                $query->where('sender_id', $id)
                      ->orWhere('receiver_id', $id);
            })
            ->where('status', 1)
            ->get();
        // return response()->json(compact('pending', 'invitor', 'families'));
        return view('users.family', compact('pending', 'invitor', 'families'));
    }

    public function showRecord(Request $request){
        $medicalRecord = MedicalRecord::with(['drugRecords.drug', 'actions'])->find($request->id);
        return response()->json(compact('medicalRecord'));
    }

    public function addFriend(Request $request){
        try {
            $sender = User::find($request->sender_id);
            $receiver = User::find($request->receiver_id);
            Family::create([
                'sender_id' =>$sender->id,
                'receiver_id' => $receiver->id,
                'status' => 0
            ]);
            return redirect()->route('user.family')->with([
                'header' => 'SUCCESS',
                'message' => 'Pertemanan Berhasil Ditambahkan!',
                'sender' => $sender,
                'receiver' => $receiver,
            ]);

            // $sender->receivers()->attach($receiver->id, ['status' => 0]);
                
        } catch (\Exception $e) {
            return redirect()->route('user.family')->withErrors(['header' => 'ERROR', 
                                      'message' => "Gagal menambahkan pertemanan! " . $e->getMessage()], 
                                     500);
        }
    }

    public function acceptFriend(Request $request){
        try {
            $sender = User::find($request->sender_id);
            $receiver = User::find($request->receiver_id);
            $family = Family::where('sender_id', '=', $sender->id)->where('receiver_id', '=', $receiver->id);
            
            if ($family->delete()) {
                $fam = Family::create([
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'status' => 1
                ]);
                return redirect()->route('user.family')->with([
                    'header' => 'SUCCESS',
                    'message' => 'Pertemanan Berhasil Ditambahkan!',
                ]);
            }

        } catch (\Throwable $th) {
            return redirect()->route('user.family')->withErrors(['header' => 'ERROR', 
                                      'message' => "Gagal menambahkan pertemanan! " . $th->getMessage()], 
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
                AND role = \'User\'
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
            return redirect()->route('user.family')->with(['header'=>'SUKSES', 'message' => 'Pertemanan ditolak!']);
        }
        return redirect()->route('user.family')->with(['header'=> 'GAGAL', 'message' => 'Pertemanan tidak dapat ditolak!']);
    }
    public function delete(Request $request){
        $sender = $request->sender_id;
        $receiver = $request->receiver_id;

        $request = DB::table('families')->where('sender_id', '=', $sender)->where('receiver_id', '=', $receiver)->where('status', '=', 0)->delete();
        if ($request) {
            return redirect()->route('user.family')->with(['header'=>'SUKSES', 'message' => 'Pertemanan dihapus!']);
        }
        return redirect()->route('user.family')->with(['header'=> 'GAGAL', 'message' => 'Pertemanan tidak dapat dihapus!']);
    }
    
}
