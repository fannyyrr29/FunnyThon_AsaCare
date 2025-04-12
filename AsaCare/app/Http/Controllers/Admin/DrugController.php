<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugs = Drug::all();
        return view('admins.drug', compact('drugs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.tambahObat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $drug = new Drug();
            $drug->name = $request->name;
            $drug->price = $request->price;
            $drug->quantity = $request->quantity;
            $drug->dosis = $request->dosis;
            $drug->type = $request->type;
            $drug->periode = $request->periode;
            if ($drug->save()) {
                // return response()->json(['header' => 'SUKSES', 'message' => 'Obat berhasil ditambahkan!']);
                return redirect()->route('admin.obat.index')->with(['header' => 'SUKSES', 'message' => 'Obat berhasil ditambahkan!']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            // return response()->json(['header' => 'GAGAL', 'message' => 'Obat tidak berhasil ditambahkan! ' . $th->getMessage()]);
            return redirect()->route('admin.obat.create')->withErrors(['header' => 'GAGAL', 'message' => 'Obat tidak berhasil ditambahkan! ' . $th->getMessage()]);

        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $drug = Drug::find($id);  
        return view('admins.editObat', compact('drug'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $drug = Drug::find($id);  
            $drug->name = $request->name;
            $drug->price = $request->price;
            $drug->quantity = $request->quantity;
            $drug->dosis = $request->dosis;
            $drug->type = $request->type;
            $drug->periode = $request->periode;
            if ($drug->save()) {
                // return response()->json(['header' => 'SUKSES', 'message' => 'Obat berhasil diubah!']);
                return redirect()->route('admin.obat.index')->with(['header' => 'SUKSES', 'message' => 'Obat berhasil ditambahkan!']);

            }
        } catch (\Throwable $th) {
            //throw $th;
            // return response()->json(['header' => 'GAGAL', 'message' => 'Obat tidak berhasil diubah! ' . $th->getMessage()]);
            return redirect()->route('admin.obat.edit')->withErrors(['header' => 'GAGAL', 'message' => 'Obat tidak berhasil ditambahkan! ' . $th->getMessage()]);

        }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $drug = Drug::find($id);
            if ($drug->delete()) {
                // return response()->json(['header' => 'SUKSES', 'message' => 'Obat berhasil dihapus!']);
                return redirect()->route('admin.obat.index')->with(['header' => 'SUKSES', 'message' => 'Obat berhasil dihapus!']);

            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.obat.index')->withErrors(['header' => 'GAGAL', 'message' => 'Obat tidak berhasil dihapus! ' . $th->getMessage()]);
            // return response()->json(['header' => 'GAGAL', 'message' => 'Obat tidak berhasil dihapus! ' . $th->getMessage()]);
        }
    }
}
