<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\DrugRecord;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function checkout(Request $request){
        $chartArray = $request->chart_array;
        return view('users.checkout', compact('chartArray'));
    }

    public function order(Request $request)
    {
        $validatedData = $request->validate([
            'drugs' => 'required|array',
            'rate' => 'required|integer',
            'amount' => 'required|array'
        ]);

        $drugArr = $validatedData['drugs'];
        $medical = new MedicalRecord();
        $medical->date = now()->toDateString();
        $medical->rating = $validatedData['rate'];
        $medical->total = 0;

        if (!$medical->save()) {
            return response()->json(['header'=> 'Gagal', 'message'=> "Gagal menyimpan catatan medis."], 500);
        }

        $total = 0;
        for ($i = 0; $i < count($drugArr); $i++) {
            $drugName = is_array($drugArr[$i]) ? $drugArr[$i]['name'] : $drugArr[$i]->name;
            $drug = Drug::where('name', 'LIKE', '%' . $drugName . '%')->first();
            if ($drug) {
                $drugRecord = new DrugRecord();
                $drugRecord->medical_record_id = $medical->id;
                $drugRecord->drug_id = $drug->id;
                $drugRecord->amount = $validatedData['amount'][$i];
                $drugRecord->subtotal = $drug->price * $drugRecord->amount;
                $drugRecord->status = 1;
                $total += $drugRecord->subtotal;

                if (!$drugRecord->save()) {
                    return response()->json(['header'=>'GAGAL', 'message'=> 'Pemesanan Gagal!']);
                }
            }
        }
        
        if ($total > 0) {
            $medical->total = $total;
            if ($medical->save()) {
                return response()->json(['header' => 'SUKSES', 'message' => 'Pembayaran Sukses, Obat sedang dikemas!']);
            }
        }
        return response()->json(['header'=> 'Gagal', 'message' => 'Tolong lakukan pemesanan terlebih dahulu!']);
    }
}
