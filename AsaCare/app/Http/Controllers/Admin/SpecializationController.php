<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = Specialization::all();
        return view('admins.specialization', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.tambahSpesialisasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $specialization = new Specialization();
            $specialization->name = $request->name;
            if ($specialization->save()) {
                return redirect()->route('admins.specialization.index')->with(['header' => 'SUKSES', 'message' => 'Spesialisasi berhasil ditambahkan!']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['header' => 'GAGAL', 'message' => 'Spesialisasi tidak berhasil ditambahkan! ' . $th->getMessage()]);
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
        $specialization = Specialization::find($id);
        return view('admins.editSpesialisasi', compact('specialization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $specialization = Specialization::find($id);
            $specialization->name = $request->name;
            if ($specialization->save()) {
                return redirect()->route('admins.specialization.index')->with(['header' => 'SUKSES', 'message' => 'Spesialisasi berhasil diubah!']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['header' => 'GAGAL', 'message' => 'Spesialisasi tidak berhasil diubah! ' . $th->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $specialization = Specialization::find($id);
            if ($specialization->delete()) {
                // return response()->json(['header'=> 'SUKSES', 'message' => 'Data berhasil dihapus!']);
                return redirect()->route('admin.specialization.index')->with(['header'=> 'SUKSES', 'message' => 'Spesialisasi berhasil dihapus!']);
            }
        } catch (\Throwable $th) {
            // return response()->json(['header'=> 'GAGAL', 'message' => 'Data tidak dapat dihapus! ' . $th->getMessage()]);
            return redirect()->route('admin.specialization.index')->with(['header'=> 'GAGAL', 'message' => 'Spesialisasi tidak dapat dihapus! ' . $th->getMessage()]);
        }
    }
}
