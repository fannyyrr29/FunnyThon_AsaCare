<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Doctor;
use App\Models\Drug;
use App\Models\DrugRecord;
use App\Models\MedicalAction;
use App\Models\MedicalRecord;
use App\Models\Reminder;
use App\Models\ReminderTime;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalRecords = MedicalRecord::with([
            'user',
            'doctor',
            'drugRecords.drug',
            'reminders.reminderTimes.time',
            'actions'
        ])->get();
        // return response()->json(compact('medicalRecords'));
        return view('doctors.riwayatKesehatan', compact('medicalRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', '=', 'User')->get();
        $drugs = Drug::all();          
        $actions = Action::all();       
        $times = Time::all();          

        return view('doctors.tambahRiwayatKesehatan', compact('users', 'drugs', 'actions', 'times'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $doctor = Doctor::where('user_id', Auth::id())->first();
            // 1. Simpan Medical Record
            $medicalRecord = new MedicalRecord();
            $medicalRecord->diagnose = $request->diagnosa;
            $medicalRecord->description = $request->deskripsi;
            $medicalRecord->date = now();
            $medicalRecord->user_id = $request->user_id;
            $medicalRecord->doctor_id = $doctor->id;
            $medicalRecord->rating = null;
            $medicalRecord->total = 0;
            $medicalRecord->save();

            foreach ($request->action_ids as $actionId) {
                $action = Action::find($actionId);
                $medicalAction = new MedicalAction();
                $medicalAction->medical_record_id = $medicalRecord->id;
                $medicalAction->action_id = $action->id;
                $medicalAction->save();
            }

            $totalHargaObat = 0;

            // 2. Simpan Drug Records dan Reminder
            foreach ($request->drugs as $drugData) {
                $drug = Drug::find($drugData['id']);
                if (!$drug) {
                    continue;
                }

                $subtotal = $drug->price * $drugData['amount'];
                $totalHargaObat += $subtotal;

                // Simpan drug_records
                DrugRecord::create([
                    'medical_record_id' => $medicalRecord->id,
                    'drug_id' => $drug->id,
                    'amount' => $drugData['amount'],
                    'subtotal' => $subtotal,
                    'status' => 1
                ]);

                // Buat Reminder
                $reminder = Reminder::create([
                    'user_id' => $request->user_id,
                    'medical_record_id' => $medicalRecord->id,
                    'drug_id' => $drug->id,
                    'status' => 1,
                    'start_date' => now()->toDateString(),
                    'duration_day' => $drugData['duration_day']
                ]);

                if ($drug->periode === 'Setiap Hari') {
                    $timeMappings = [
                        1 => [8],               // id jam 12:00
                        2 => [6, 15],           // id jam 10:00, 18:00
                        3 => [4, 10, 16],       // id jam 08:00, 13:00, 19:30
                    ];
    
                    $dose = $drug->dosis;
                    $durasi = (int) $drugData['duration_day'];
    
                    if (isset($timeMappings[$dose])) {
                        for ($i = 0; $i < $durasi; $i++) {
                            $tanggal = now()->addDays($i)->toDateString();
                            foreach ($timeMappings[$dose] as $timeId) {
                                ReminderTime::insert([
                                    'reminder_id' => $reminder->id,
                                    'time_id' => $timeId,
                                    'date' => $tanggal,
                                    'status' => 1,
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);                            
                            }
                        }
                    }
                }else continue;
                
            }

            $medicalRecord->total = $totalHargaObat;
            $medicalRecord->save();

            DB::commit();
            return redirect()->route('medicalRecord.index')->with(['header' => 'SUKSES', 'message' => 'Data rekam medis berhasil disimpan']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['header' => 'GAGAL', 'message' => 'Terjadi kesalahan: ' . $th->getMessage()]);
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
        $medicalRecord = MedicalRecord::with([
            'reminders.drug',
            'drugRecords.drug',          // Ambil detail obat dari drug_records
            'reminders.reminderTimes',  // Ambil reminder dan waktu-waktunya
            'actions',                  // Kalau kamu punya tindakan medis yang direlasikan
        ])->find($id);

        if (!$medicalRecord) {
            // return redirect()->back()->with(['header' => 'GAGAL', 'message' => 'Data rekam medis tidak ditemukan!']);
            return response()->json(['header' => 'GAGAL', 'message' => 'Data rekam medis tidak ditemukan!']);

        }

        // Opsional: bisa juga ambil semua obat, jam, dll jika kamu ingin dropdown di view
        $allDrugs = Drug::all();
        $allTimes = Time::all();
        $allActions = Action::all();
        $allUsers = User::all();

        // return response()->json(compact('medicalRecord', 'allDrugs', 'allTimes', 'allActions'));
        return view('doctors.ubahRiwayatKesehatan', compact('medicalRecord', 'allDrugs', 'allTimes', 'allActions', 'allUsers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $medicalRecord = MedicalRecord::findOrFail($id);
            $doctorId = DB::table('doctors')->where('user_id', Auth::id())->value('id');
    
            // Update medical record
            $medicalRecord->update([
                'diagnose' => $request->diagnosa,
                'description' => $request->deskripsi,
                'date' => now(),
                'user_id' => $request->user_id,
                'doctor_id' =>  $doctorId,
                'rating' => $request->rating ?? null,
            ]);
    
            // Hapus medical actions lama
            MedicalAction::where('medical_record_id', $medicalRecord->id)->delete();

            // Simpan medical actions baru
            if ($request->has('action_ids')) {
                foreach ($request->action_ids as $actionId) {
                    $action = Action::find($actionId);
                    if (!$action) continue;

                    MedicalAction::create([
                        'medical_record_id' => $medicalRecord->id,
                        'action_id' => $action->id,
                    ]);
                }
            }


            $totalHargaObat = 0;
    
            // Hapus drug_records lama
            DrugRecord::where('medical_record_id', $medicalRecord->id)->delete();
    
            // Hapus reminders & reminder_times lama
            $oldReminders = Reminder::where('medical_record_id', $medicalRecord->id)->get();
            foreach ($oldReminders as $reminder) {
                ReminderTime::where('reminder_id', $reminder->id)->delete();
                $reminder->delete();
            }
    
            // Simpan drug_records dan reminder baru
            foreach ($request->drugs as $drugData) {
                $drug = Drug::find($drugData['id']);
                if (!$drug) continue;
    
                $subtotal = $drug->price * $drugData['amount'];
                $totalHargaObat += $subtotal;
    
                DrugRecord::create([
                    'medical_record_id' => $medicalRecord->id,
                    'drug_id' => $drug->id,
                    'amount' => $drugData['amount'],
                    'subtotal' => $subtotal,
                    'status' => 1
                ]);
    
                // Buat Reminder
                $reminder = Reminder::create([
                    'user_id' => $request->user_id,
                    'medical_record_id' => $medicalRecord->id,
                    'drug_id' => $drug->id,
                    'start_date' => now()->toDateString(),
                    'duration_day' => $drugData['duration_day'],
                    'status' => 1
                ]);
    
                // Mapping dosis ke time_id
                $timeMappings = [
                    1 => [8],             // 12:00
                    2 => [6, 15],         // 10:00, 18:00
                    3 => [4, 10, 16],     // 08:00, 13:00, 19:30
                ];
    
                $dose = $drug->dosis;
                $durasi = (int) $drugData['duration_day'];
    
                if (isset($timeMappings[$dose])) {
                    for ($i = 0; $i < $durasi; $i++) {
                        $tanggal = now()->copy()->addDays($i)->toDateString();
    
                        foreach ($timeMappings[$dose] as $timeId) {
                            ReminderTime::create([
                                'reminder_id' => $reminder->id,
                                'time_id' => $timeId,
                                'date' => $tanggal,
                                'status' => 1
                            ]);
                        }
                    }
                }
            }
    
            // Update total harga
            $medicalRecord->update(['total' => $totalHargaObat]);
    
            DB::commit();
            return response()->json([
                'header' => 'SUKSES',
                'message' => 'Data rekam medis berhasil diperbarui.'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'header' => 'GAGAL',
                'message' => 'Terjadi kesalahan: ' . $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $medicalRecord = MedicalRecord::find($id);
            if (!$medicalRecord) {
                return response()->json(['header' => 'GAGAL', 'message' => 'Data rekam medis tidak ditemukan!']);
            }

            // 1. Hapus reminder_times dari setiap reminder yang terkait dengan medical_record ini
            $reminders = Reminder::where('medical_record_id', $medicalRecord->id)->get();
            foreach ($reminders as $reminder) {
                ReminderTime::where('reminder_id', $reminder->id)->delete();
            }

            // 2. Hapus reminders
            Reminder::where('medical_record_id', $medicalRecord->id)->delete();

            // 3. Hapus drug_records
            DrugRecord::where('medical_record_id', $medicalRecord->id)->delete();

            // 4. Hapus relasi actions jika ada (jika kamu pakai pivot table untuk tindakan medis)
            $medicalRecord->actions()->detach();

            // 5. Hapus medical record-nya
            $medicalRecord->delete();

            DB::commit();

            // return response()->json(['header' => 'SUKSES', 'message' => 'Data rekam medis beserta relasinya berhasil dihapus!']);
            return redirect()->back()->with(['header' => 'SUKSES', 'message' => 'Data rekam medis beserta relasinya berhasil dihapus!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            // return response()->json(['header' => 'GAGAL', 'message' => 'Data rekam medis tidak dapat dihapus! ' . $th->getMessage()]);   
            return redirect()->back()->with(['header' => 'GAGAL', 'message' => 'Data rekam medis tidak dapat dihapus! ' . $th->getMessage()]);
        }
    }
}
