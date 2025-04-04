<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Drug;
use App\Models\EmergencyCall;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }
        return view('users.home', compact('user'));
    }

    public function showProfile(string $id){
        $user = User::find($id);
        if ($user) {
            // return response()->json(compact('user'));
            return view('users.editProfile', compact('user'));
        }
        // return response()->json(['error' => 'Pengguna tidak ditemukan!'], 404);
        return redirect()->back()->withErrors(['Error' => "Tidak dapat mengubah profil"], 404);
    }

    public function editProfile(Request $request){
        $user = User::find($request->id);
        if (!$user) {
            return redirect()->back()->withErrors(['Error' => "Pengguna tidak ditemukan!"]);
        }

        $user->name = $request->name;
        $user->address = $request->address;

        if ($user->save()) {
            return response()->json(['status' => 'Update Sukses']);
            // return redirect()->route('user.home')->with('Sukses', 'Profil telah diubah!');
        }

        return response()->json(['status' => 'Update Gagal']);

        // return redirect()->back()->withInput()->withErrors(['Error' => "Profil tidak dapat diubah!"]);

    }

    public function showAction(){
        $actions = Action::all();
        if ($actions) {
            # code...
            return view('users.homecare', compact('actions'));
        }
        return redirect()->back()->withErrors(['Error' => "Tidak ditemukan layanan!"]);
    }

    public function showEmergencyCall(string $id){
        $call = EmergencyCall::where('user_id', '=', $id)->get();

        // Check if the collection is empty
        if ($call->isNotEmpty()) {
            // return response()->json(['message' => "Data Berhasil Diambil!", 'calls' => $call]);
            return view('users.telp', compact('call'));
        }
        return redirect()->back()->with(['Error' => "Tidak dapat menampilkan Kontak Emergency Call"]);
        // return response()->json(['message' => "Data tidak ditemukan!"], 404);
    }

    public function showMedicalRecord(string $id){
        $medicalRecords = MedicalRecord::where('user_id', '=', $id)->get();
        
        if ($medicalRecords) {
            # code...
            return response()->json(compact('medicalRecords'));
        }
        return response()->json(['message' => "Data tidak ditemukan!"]);
    }

    public function showDrug(){
        $drugs = Drug::all();
        if ($drugs) {
            # code...
            return response()->json(compact('drugs'));
        }
        return redirect()->back()->withErrors(['Error' => "Tidak ditemukan data obat!"]);

    }
}