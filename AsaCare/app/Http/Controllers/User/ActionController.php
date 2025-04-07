<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
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
            return response()->json(compact('doctors'));
        }

        return response()->json(['header'=> 'ERROR', 'message' => 'Data tidak ditemukan!']);     
        
    }
}
