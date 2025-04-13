<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\DrugRecord;
use App\Models\MedicalRecord;
use App\Models\Reminder;
use App\Models\ReminderTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Backtrace\Arguments\ReducedArgument\ReducedArgument;

class DrugController extends Controller
{
    public function checkout(Request $request){
        $user = User::find(Auth::id());
        $items = json_decode($request->items, true);

        $drugs = [];
        foreach ($items as $key => $item) {
            $drug = Drug::find($item['id']);
            array_push($drugs, $drug);
        } 
        // return response()->json(compact('user', 'drugs'));
        return view('users.checkout', compact('drugs', 'user', 'items'));
    }

    public function index(){
        $drugs = Drug::all();
        return view('users.tokoObat', compact('drugs'));
    }

    public function showTokoObat(){
        return view('users.transaksi');
    }

    public function order(Request $request)
    {
        $validatedData = $request->validate([
            'drugs' => 'required|array',
            'drugs.*.id' => 'required|integer|exists:drugs,id',
            'drugs.*.duration_day' => 'required|integer|min:1',
            'rate' => 'required|integer',
            'amount' => 'required|array'
        ]);
        
        

        $drugArr = $validatedData['drugs'];
        $medical = new MedicalRecord();
        $medical->date = now()->toDateString();
        $medical->rating = $validatedData['rate'];
        $medical->total = 0;
        $medical->user_id = Auth::id();

        if (!$medical->save()) {
            return redirect()->back()->with(['header'=> 'Gagal', 'message'=> "Gagal menyimpan catatan medis."]);
        }

        $total = 0;
        for ($i = 0; $i < count($drugArr); $i++) {
            $drugId = $drugArr[$i]['id'];
            $drug = Drug::find($drugId);
        
            if ($drug) {
                $drugRecord = new DrugRecord();
                $drugRecord->medical_record_id = $medical->id;
                $drugRecord->drug_id = $drug->id;
                $drugRecord->amount = $validatedData['amount'][$i];
                $drugRecord->subtotal = $drug->price * $drugRecord->amount;
                $drugRecord->status = 1;
                $total += $drugRecord->subtotal;
        
                if (!$drugRecord->save()) {
                    // return response()->json(['header'=>'GAGAL', 'message'=> 'Pemesanan Gagal!']);
                    return redirect()->back()->withErrors(['header'=>'GAGAL', 'message'=> 'Pemesanan Gagal!']);

                }
            }
            // Buat Reminder
            $reminder = Reminder::create([
                'user_id' => AUth::id(),
                'medical_record_id' => $medical->id,
                'drug_id' => $drug->id,
                'status' => 1,
                'start_date' => now()->toDateString(),
                'duration_day' => $drugArr[$i]['duration_day']
            ]);

            // Waktu Reminder berdasarkan dosis
            $timeMappings = [
                1 => [8],               // id jam 12:00
                2 => [6, 15],           // id jam 10:00, 18:00
                3 => [4, 10, 16],       // id jam 08:00, 13:00, 19:30
            ];

            $dose = $drug->dosis;
            $durasi = (int) $drugArr[$i]['duration_day'];

            if (isset($timeMappings[$dose])) {
                for ($d = 0; $d < $durasi; $d++) {
                    $tanggal = now()->addDays($d)->toDateString();
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
        }
        

        if ($total > 0) {
            $medical->total = $total + $request->ongkir;
            if ($medical->save()) {
                return redirect()->route('user.tokoObat')->with(['header' => 'SUKSES', 'message' => 'Pembayaran Sukses, Obat sedang dikemas!']);
            }
        }
        return redirect()->route('user.tokoObat')->withErrors(['header' => 'GAGAL', 'message' => 'Tolong lakukan pemesanan terlebih dahulu!']);

    }
}
