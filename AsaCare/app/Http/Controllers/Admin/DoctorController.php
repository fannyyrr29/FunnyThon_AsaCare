<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Doctor;
use App\Models\DoctorAction;
use App\Models\Hospital;
use App\Models\MedicalRecord;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with(['specialization', 'actions', 'hospital'])->get();
        // $doctors = Doctor::with('doctorSpecialization.specialization', 'doctorSpecialization.action')->get();
        // return response()->json(compact('doctors'));
        // return response()->json(compact('doctors'));
        return view('admins.doctor', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        $specializations = Specialization::all();
        $actions = Action::all();
        $users = User::all();

        
        return view('admins.tambahDokter', compact('hospitals', 'specializations', 'actions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'license_number' => 'required|string|unique:doctors,license_number',
            'experience_year' => 'required|integer',
            'hospital_id' => 'required|exists:hospitals,id',
            'specialization_id' => 'required|exists:specializations,id',
            'user_id' => 'required|exists:users,id',
            'actions' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->license_number = $request->license_number;
            $doctor->experience_year = $request->experience_year;
            $doctor->hospital_id = $request->hospital_id;
            $doctor->user_id = $request->user_id;
            $doctor->specialization_id = $request->specialization_id;
            $doctor->created_at = now();

            if ($doctor->save()) {
                foreach ($request->actions as $actionId) {
                    DoctorAction::create([
                        'doctor_id' => $doctor->id,
                        'action_id' => $actionId,
                    ]);
                }

                DB::commit();
                return redirect()->route('admin.dokter.index')->with(['header' => 'SUKSES', 'message' => "Berhasil menambahkan dokter!"]);
            }

            DB::rollBack();
            return redirect()->route('admin.dokter.index')->withErrors(['header' => 'GAGAL', 'message' => "Dokter tidak dapat disimpan."]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'header' => 'GAGAL',
                'message' => "Gagal menambahkan dokter: " . $th->getMessage()
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::with('specialization', 'actions')->findOrFail($id);
        $actions = Action::all();
        $specializations = Specialization::all();
        $hospitals = Hospital::all();
        // Ambil spesialisasi (ambil dari satu baris pertama, karena satu dokter hanya punya 1 spesialisasi)
        // $specialization = $doctor->doctorSpecializations->first()->specialization ?? null;

        // Ambil semua action_id
        // $actions = $doctor->doctorSpecializations->pluck('action')->unique('id');

        // return response()->json(compact('doctor', 'actions', 'specializations'));
        return view('admins.ubahDokter', compact('doctor', 'actions', 'specializations', 'hospitals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'license_number' => [
                'required',
                'string',
                Rule::unique('doctors')->ignore((int) $id, 'id')
            ],
            'experience_year' => 'required|integer',
            'hospital_id' => 'required|exists:hospitals,id',
            'actions' => 'required|array|distinct',
            'actions.*' => 'exists:actions,id',
        ]);

        DB::beginTransaction();

        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->name = $request->name;
            $doctor->license_number = $request->license_number;
            $doctor->experience_year = $request->experience_year;
            $doctor->rating = $request->rating;
            $doctor->hospital_id = $request->hospital_id;

            if ($doctor->save()) {
                // Hapus relasi lama dulu
                DoctorAction::where('doctor_id', $doctor->id)->delete();

                // Insert relasi baru
                foreach ($request->actions as $actionId) {
                    DoctorAction::create([
                        'doctor_id' => $doctor->id,
                        'action_id' => $actionId,
                    ]);
                }

                DB::commit();
                // return response()->json(['header' => 'SUKSES', 'message' => "Berhasil mengubah data dokter!"]);
                return redirect()->route('admin.dokter.index')->with(['header' => 'SUKSES', 'message' => "Berhasil mengubah data dokter!"]);
            }

            DB::rollBack();
            return redirect()->back()->withErrors(['header' => 'GAGAL', 'message' => "Dokter tidak dapat diubah."]);

        } catch (\Throwable $th) {
            DB::rollBack();
            // return response()->json(['header' => 'SUKSES', 'message' => "Berhasil mengubah data dokter!"]);
            return redirect()->back()->withErrors([
                'header' => 'GAGAL',
                'message' => "Tidak dapat mengubah data dokter: " . $th->getMessage()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::find($id);
        $query = DoctorAction::where('doctor_id', $doctor->id)->delete();
        if ($query) {
            if ($doctor->delete()) {
                return redirect()->route('admin.dokter.index')->with(['header' => 'SUKSES', 'message' => "Berhasil menghapus data dokter!"]);
            }
        }
        return redirect()->back()->withErrors(['header' => 'GAGAL', 'message' => "Data dokter tidak dapat dihapus!"]);
        

    }
}
