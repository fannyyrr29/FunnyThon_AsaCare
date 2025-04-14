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
            $receiver = User::where('email', $request->email)->first();
            Family::create([
                'sender_id' =>$sender->id,
                'receiver_id' => $receiver->id,
                'status' => 0
            ]);
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Pertemanan Berhasil Ditambahkan!',
                'sender' => $sender,
                'receiver' => $receiver,
            ]);
            //  redirect()->route('user.family')->with([
            //     'header' => 'SUCCESS',
            //     'message' => 'Pertemanan Berhasil Ditambahkan!',
            //     'sender' => $sender,
            //     'receiver' => $receiver,
            // ]);

            // $sender->receivers()->attach($receiver->id, ['status' => 0]);
                
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 
                                      'message' => "Gagal menambahkan pertemanan! " . $e->getMessage()]);
            // return redirect()->route('user.family')->withErrors(['header' => 'ERROR', 
            //                           'message' => "Gagal menambahkan pertemanan! " . $e->getMessage()], 
            //                          500);
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
        $email = $request->email ?? '';
        $type = $request->type;
    
        if (empty($email) || empty($type)) {
            return response()->json(['users' => []]);
        }
    
        try {
            switch ($type) {
                case 'pending':
                    // Kamu mengirim request, tapi belum diterima (status = 0)
                    $users = DB::table('users')
                        ->whereIn('id', function ($query) use ($userId) {
                            $query->select('receiver_id')
                                ->from('families')
                                ->where('sender_id', $userId)
                                ->where('status', 0);
                        })
                        ->where(function ($query) use ($email) {
                            $query->where('email', 'like', '%' . $email . '%')
                                  ->orWhere('name', 'like', '%' . $email . '%');
                        })
                        ->get();
                    break;
            
                case 'invitor':
                    // Mereka kirim request ke kamu, tapi kamu belum terima (status = 0)
                    $users = DB::table('users')
                        ->whereIn('id', function ($query) use ($userId) {
                            $query->select('sender_id')
                                ->from('families')
                                ->where('receiver_id', $userId)
                                ->where('status', 0);
                        })
                        ->where(function ($query) use ($email) {
                            $query->where('email', 'like', '%' . $email . '%')
                                  ->orWhere('name', 'like', '%' . $email . '%');
                        })
                        ->get();
                    break;
            
                case 'families':
                    // Sudah diterima, status = 1
                    $users = DB::select('
                        SELECT * FROM users
                        WHERE id IN (
                            SELECT CASE
                                WHEN sender_id = ? THEN receiver_id
                                WHEN receiver_id = ? THEN sender_id
                            END
                            FROM families
                            WHERE (sender_id = ? OR receiver_id = ?)
                            AND status = 1
                        )
                        AND (email LIKE ? OR name LIKE ?)
                    ', [$userId, $userId, $userId, $userId, '%' . $email . '%', '%' . $email . '%']);
                    break;
            }
            
    
            return response()->json(['users' => $users]);
        } catch (\Throwable $th) {
            return response()->json(['users' => []]);
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
