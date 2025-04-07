<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ActionController extends Controller
{
    public function showDoctors(string $id){
        $doctors = DB::table('doctor_has_specializations as ds')
        ->join('doctors as d', 'd.id', '=', 'ds.doctor_id')
        ->select('d.*')
        ->where('ds.action_id', '=', 7)
        ->distinct() 
        ->get(); 

        if ($doctors) {
            return view('users.doctors', compact('doctors'));
        }else{
            return redirect()->back()->withErrors(['header' => 'ERROR', 'message' => 'Dokter tidak ditemukan!']);     
        }        
    }
}
