<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Condition;
use App\Models\Doctor;
use App\Models\Drug;
use App\Models\EmergencyCall;
use App\Models\MedicalRecord;
use App\Models\User;
use Database\Seeders\DrugSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'User') {
            abort(403);
        }

        return view('users.home');
    }

    // public function showProfile(string $id){
    //     $user = User::find($id);
    //     if ($user) {
    //         // return response()->json(compact('user'));
    //         return view('users.editProfile', compact('user'));
    //     }
    //     // return response()->json(['error' => 'Pengguna tidak ditemukan!'], 404);
    //     return redirect()->back()->withErrors(['Error' => "Tidak dapat mengubah profil"], 404);
    // }

    public function showProfile()
    {
        $user = auth()->user(); 
        if ($user) {
            return view('users.editProfile', compact('user'));
        }
        return redirect()->back()->withErrors(['Error' => "Tidak dapat mengubah profil"]);
    }

    public function editProfile(Request $request)
    {
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

    public function showAction()
    {
        $actions = Action::all();
        if ($actions) {
            # code...
            return view('users.homecare', compact('actions'));
        }
        return redirect()->back()->withErrors(['Error' => "Tidak ditemukan layanan!"]);
    }

    public function showEmergencyCall(string $id)
    {
        $call = EmergencyCall::where('user_id', '=', $id)->get();

        // Check if the collection is empty
        if ($call->isNotEmpty()) {
            // return response()->json(['message' => "Data Berhasil Diambil!", 'calls' => $call]);
            return view('users.telp', compact('call'));
        }
        return redirect()->back()->with(['Error' => "Tidak dapat menampilkan Kontak Emergency Call"]);
        // return response()->json(['message' => "Data tidak ditemukan!"], 404);
    }

    public function showMedicalRecord(string $id)
    {
        $medicalRecords = DB::table('medical_records as mr')
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

        if ($medicalRecords->isEmpty()) {
            return response()->json(['message' => "Data tidak ditemukan!"], 404);
        }

        $doctors = [];
        foreach ($medicalRecords as $key => $mr) {
            $doctor = Doctor::find($mr->doctor_id);
            if ($doctor) {
                array_push($doctors, $doctor);
            } else {
                return response()->json(['message' => "Dokter tidak ditemukan!"], 404);
            }
        }

        $drugs = [];
        foreach ($medicalRecords as $key => $record) {
            $drug = Drug::find($record->drug_id);
            if ($drug) {
                # code...
                array_push($drugs, $drug);
            } else {
                return response()->json(['message' => "Obat tidak ditemukan!"], 404);

            }
        }
        return view('users.riwayat', compact('medicalRecords', 'doctors', 'drugs'));
    }

    public function showDrug()
    {
        $drugs = Drug::all();
        if ($drugs) {
            # code...
            return response()->json(compact('drugs'));
        }
        return redirect()->back()->withErrors(['Error' => "Tidak ditemukan data obat!"]);

    }
    public function addMood(Request $request)
    {
        try {
            $condition = new Condition();
            $condition->condition = $request->condition;
            $condition->date = now()->toDateString();
            $condition->user_id = $request->user_id;
            if ($condition->save()) {
                return response()->json(['header' => 'SUKSES', 'message' => 'Data berhasil diinputkan!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['header' => 'ERROR', 'message' => 'Data gagal diinputkan! ' . $th->getMessage()]);
        }
    }

    public function showMood($id)
    {
        $conditions = Condition::where('user_id', '=', $id)->get();
        if ($conditions) {
            return response()->json(['header' => 'SUKSES', 'conditions' => $conditions]);
        }
        return response()->json(['header' => 'GAGAL', 'message' => 'Kondisi Pengguna tidak ditemukan!']);
    }

    public function showActionHomeCare()
    {
        $homecare = Action::where('type', '=', 'Homecare')->get();
        return view('users.homecare', compact('homecare'));
    }

    public function showActionHospitalCare()
    {
        $hospitalCare = Action::where('type', '=', 'Hospitalcare')->get();
        return view('users.homecare', compact('hospitalCare'));
    }

    public function cariLayanan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (!empty($request->name)) {
            $action = Action::where('name', 'like', '%' . $request->input('name') . '%')->get();
        } else {
            $action = collect();
        }

        return response()->json(compact('action'));

    }
}