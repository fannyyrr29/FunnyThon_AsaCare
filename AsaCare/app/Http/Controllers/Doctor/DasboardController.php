<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $doctor = DB::table('users as u')->join('doctors as d', 'd.user_id', '=', 'u.id')->join('doctor_has_specializations as ds', 'ds.doctor_id', '=', 'd.id')->where('u.id', Auth::id())->first();
            $specialization = Specialization::find($doctor->specialization_id);
            $user = User::find($doctor->user_id);
            return view('doctors.index', compact('doctor', 'specialization', 'user'));
        } else {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
