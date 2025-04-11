<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::where('doctor_id', Auth::id())->with('user')->get();
        if($consultations){
            return view('doctors.consultation', compact('consultations'));
        }
        return redirect()->back()->withErrors(['header' => "GAGAL", 'message' => "Tidak dapat menampilkan consultation!"]);
    }
}
