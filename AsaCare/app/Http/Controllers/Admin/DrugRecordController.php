<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\DrugRecord;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class DrugRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugRecord = DrugRecord::all();
        return view('admins.catatanObat', compact('drugRecord'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicalRecords = MedicalRecord::all();
        $drugs = Drug::all();
        return view('admins.tambahCatatanObat', compact('drugs', 'medicalRecords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $drugRecord = new DrugRecord();
        $drugRecord->medical_record_id = $request->medical_record_id;
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
