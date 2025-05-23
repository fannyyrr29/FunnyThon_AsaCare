<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Condition;
use App\Models\Doctor;
use App\Models\Drug;
use App\Models\EmergencyCall;
use App\Models\Family;
use App\Models\MedicalRecord;
use App\Models\User;
use Database\Seeders\DrugSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::find($request->user_id);
        if (!$user) {
            return redirect()->back()->withErrors(['Error' => "Pengguna tidak ditemukan!"]);
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $extension = $image->getClientOriginalExtension();

            $fileName = $user->id . '.' . $extension;
            $destinationPath = public_path('assets/images/profile/');

            if ($user->profile && file_exists($destinationPath . $user->profile)) {
                unlink($destinationPath . $user->profile);
            }

            $image->move($destinationPath, $fileName);

            $user->profile = $fileName;
        }

        $user->NIK = $request->nik;
        $user->name = $request->nama;
        $user->gender = $request->gender;
        $user->birthdate = $request->tanggal_lahir;
        $user->phone_number = "+62" . $request->phone;
        $user->address = $request->alamat;

        if ($user->save()) {
            // return response()->json(['status' => 'Update Sukses']);
            return redirect()->route('user.home')->with('Sukses', 'Profil telah diubah!');
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

    public function showEmergencyCall()
    {
        $userID = auth()->id();

        $emergencycalls = EmergencyCall::where('user_id', '=', $userID)->get();

        return view('users.telp', compact('emergencycalls'));
    }

    public function storeEmergencyCall(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        EmergencyCall::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone_number' => '+62'.$request->phone_number,
        ]);

        return redirect()->back()->with('success', 'Kontak darurat berhasil ditambahkan!');
    }

    public function showMedicalRecord(string $id)
    {
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
        $medicalRecords = $rawRecords->groupBy('id')->map(function ($items) {
            $first = $items->first(); // ambil satuan data rekam medis

            $drugList = $items->map(function ($item) {
                $drug = Drug::find($item->drug_id);
                if ($drug) {
                    $drug->amount = $item->amount;
                    return $drug;
                }
                return null;
            })->filter()->values();

            $doctor = Doctor::find($first->doctor_id);

            $actions = DB::table('medical_actions')
                ->where('medical_record_id', $first->id)
                ->join('actions', 'actions.id', '=', 'medical_actions.action_id')
                ->select('actions.*', 'medical_actions.created_at as action_time')
                ->get();

            return [
                'id' => $first->id,
                'diagnose' => $first->diagnose,
                'description' => $first->description,
                'date' => $first->date,
                'rating' => $first->rating,
                'doctor' => $doctor,
                'drugs' => $drugList,
                'actions' => $actions,
            ];
        })->values();
        // return response()->json(compact('medicalRecords'));
        return view('users.riwayat', compact('medicalRecords'));

    }

    public function showDrug()
    {
        $drugs = Drug::all();
        if ($drugs) {
            # code...
            return view('users.menuObat', compact('drugs'));
        }
        return redirect()->back()->withErrors(['Error' => "Tidak ditemukan data obat!"]);
    }
    // public function addMood(Request $request)
    // {
    //     try {
    //         $condition = new Condition();
    //         $condition->condition = $request->condition;
    //         $condition->date = now()->toDateString();
    //         $condition->user_id = $request->user_id;
    //         if ($condition->save()) {
    //             return response()->json(['header' => 'SUKSES', 'message' => 'Data berhasil diinputkan!']);
    //         }
    //     } catch (\Throwable $th) {
    //         return response()->json(['header' => 'ERROR', 'message' => 'Data gagal diinputkan! ' . $th->getMessage()]);
    //     }
    // }

    public function addMood(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return back()->withErrors(['error' => 'Pengguna tidak terautentikasi!']);
            }

            $request->validate([
                'condition' => 'required|string|in:Sehat,Kurang Sehat,Sakit',
            ]);

            Condition::where('user_id', $user->id)
                ->whereDate('date', today())
                ->delete();

            $condition = new Condition();
            $condition->condition = $request->condition;
            $condition->date = now()->toDateString();
            $condition->user_id = $user->id;

            if ($condition->save()) {
                return redirect()->back()->with('success', 'Data berhasil diinputkan!');
            }
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Data gagal diinputkan! ' . $th->getMessage()]);
        }
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

    public function showFamily()
    {
        $families = Family::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->orWhere('receiver_id', Auth::id());
        })->get();

        // return response()->json(compact('families'));

        return view('users.family', compact('families'));
    }

    public function showDoctor()
    {
        $doctors = User::with(['doctor.specialization'])->where('role', 'Dokter')->get();

        return view('users.pilihDokter', compact('doctors'));
        // return response()->json(compact('doctors'));
    }
}
