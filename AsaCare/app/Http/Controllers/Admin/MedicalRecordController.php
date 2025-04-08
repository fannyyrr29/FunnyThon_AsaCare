<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalRecord = MedicalRecord::all();
        return view('admins.riwayatKesehatan', compact('medicalRecord'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $doctors = Doctor::all();
        return view('admins.tambahRiwayatKesehatan', compact('users', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $actions = $request->action_ids;
            $medicalRecord = new MedicalRecord();
            $medicalRecord->diagnose = $request->diagnose;
            $medicalRecord->description = $request->description;
            $medicalRecord->date = now();
            $medicalRecord->user_id = $request->user_id;
            $medicalRecord->doctor_id = $request->doctor_id;
            $total = 0;
            $medicalRecord->rating = $request->rating;
            $medicalRecord->save();

            foreach ($actions as $value) {
                $action = Action::find($value);
                if ($action) {
                    $medicalRecord->actions()->attach($action->id); // attach tanpa if
                    $total += $action->price;
                }
            }
            $medicalRecord->total = $total;
            if ($medicalRecord->save()) {
                return response()->json(['header' => 'SUKSES', 'message' => 'Data rekam medis berhasil disimpan']);
                // return redirect()->route('admin.riwayatKesehatan.index')->with(['header' => 'SUKSES', 'message' => 'Data rekam medis berhasil disimpan']);
            }
            

        } catch (\Throwable $th) {
            return response()->json(['header' => 'GAGAL', 'message' => 'Data rekam medis tidak  berhasil disimpan! ' . $th->getMessage()]);
            // return redirect()->back()->withInput()->withErrors(['header' => 'SUKSES', 'message' => 'Data rekam medis tidak dapat disimpan! ' . $th->getMessage()]);
        }
        
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medicalRecord = MedicalRecord::find($id);
        return view('admins.ubahRiwayatKesehatan', compact('medicalRecord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $medicalRecord = MedicalRecord::find($id);
            $actions = $request->action_ids;

            // Update data utama
            $medicalRecord->diagnose = $request->diagnose;
            $medicalRecord->description = $request->description;
            $medicalRecord->date = now();
            $medicalRecord->user_id = $request->user_id;
            $medicalRecord->doctor_id = $request->doctor_id;
            $medicalRecord->rating = $request->rating;
            $medicalRecord->save();

            // Sync actions (hapus & masukkan relasi sekaligus)
            $medicalRecord->actions()->sync($actions);

            // Hitung ulang total dari actions yang dipilih
            $total = Action::whereIn('id', $actions)->sum('price');
            $medicalRecord->update(['total' => $total]);

            return redirect()->route('admin.riwayatKesehatan.index')->with(['header' => 'SUKSES', 'message' => 'Data rekam medis berhasil diubah']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['header' => 'GAGAL', 'message' => 'Data rekam medis tidak dapat diubah! ' . $th->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $medicalRecord = MedicalRecord::find($id);
            if ($medicalRecord) {
                # code...
                $medicalRecord->delete();
                return response()->json(['header' => 'SUKSES', 'message' => 'Data rekam medis berhasil dihapus!']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['header' => 'GAGAL', 'message' => 'Data rekam medis tidak dapat dihapus! ' . $th->getMessage()]);
        }
        

    }
}
