<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::all();
        return view('admins.hospital', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.insertHospital');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hospital = new Hospital();
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->phone_number = $request->phone_number;
        if ($hospital->save()) {
            return redirect()->back()->with(['header' => 'SUKSES', 'message' => "Data Rumah Sakit berhasil ditambahkan!"]);
        }
        return redirect()->back()->withErrors(['header' => 'GAGAL', 'message' => 'Data Rumah sakit tidak dapat ditambahkan!']);
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
        $hospital = Hospital::find($id);
        return view('admins.edit', compact('hospital'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hospital = Hospital::find($id);
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->phone_number = $request->phone_number;
        $hospital->updated_at = now();
        if ($hospital->save()) {
            return redirect()->back()->with(['header' => 'SUKSES', 'message' => "Data Rumah Sakit berhasil diubah!"]);
        }
        return redirect()->back()->withInput()->withErrors(['header' => 'GAGAL', 'message' => "Data Rumah Sakit tidak berhasil diubah!"]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hospital = Hospital::find($id);
        if ($hospital->delete()) {
            return redirect()->back()->with(['header' => 'SUKSES', 'message' => "Data Rumah Sakit berhasil dihapus!"]);
        }
        return redirect()->back()->withErrors(['header' => 'GAGAL', 'message' => "Data Rumah Sakit tidak dapat dihapus!"]);
    }
}
