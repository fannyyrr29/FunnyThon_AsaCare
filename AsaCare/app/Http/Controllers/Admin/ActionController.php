<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actions = Action::all();
        if ($actions) {
            return view('admins.service', compact('actions'));
        }
        return redirect()->back()->withErrors(['header' => "GAGAL", 'message' => "Tidak dapat menampilkan action!"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.tambahLayanan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $action = new Action();
            $action->name = $request->name;
            $action->description = $request->description;
            $action->type = $request->type;
            $action->price = $request->price;

            // Proses upload gambar
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // Buat nama file dari nama layanan (safe format)
                $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

                // Simpan file ke folder public/images (atau ubah sesuai kebutuhanmu)
                $file->move(public_path('images/layanan'), $filename);

                // Simpan nama file ke database
                $action->image = $filename;
            }

            if ($action->save()) {
                return redirect()->back()->with(['header' => 'SUKSES', 'message' => 'Layanan berhasil ditambahkan!']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['header' => 'GAGAL', 'message' => 'Layanan tidak dapat ditambahkan! ' . $th->getMessage()]);
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
        $action = Action::find($id);
        return view('admins.editLayanan', compact('action'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $action = Action::find($id);

            if (!$action) {
                return redirect()->back()->withErrors([
                    'header' => 'GAGAL',
                    'message' => 'Layanan tidak ditemukan!'
                ]);
            }

            $action->name = $request->name;
            $action->description = $request->description;

            // Jika user mengupload gambar baru
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('images/layanan'), $filename);

                $action->image = $filename;
            }

            // Simpan semua perubahan (termasuk jika tidak ada gambar baru)
            if ($action->save()) {
                return redirect()->back()->with([
                    'header' => 'SUKSES',
                    'message' => 'Layanan berhasil diubah!'
                ]);
            }

            return redirect()->back()->withErrors([
                'header' => 'GAGAL',
                'message' => 'Gagal menyimpan perubahan layanan.'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors([
                'header' => 'GAGAL',
                'message' => 'Layanan tidak dapat diubah! ' . $th->getMessage()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $action = Action::find($id);

        if (!$action) {
            return redirect()->route('action.index')->with([
                'header' => 'GAGAL',
                'message' => 'Layanan tidak ditemukan!'
            ]);
        }

        // Hapus file gambar (jika ada)
        if ($action->image && file_exists(public_path('images/layanan/' . $action->image))) {
            unlink(public_path('images/layanan/' . $action->image));
        }

        // Hapus data dari database
        if ($action->delete()) {
            return redirect()->route('action.index')->with([
                'header' => 'SUKSES',
                'message' => 'Layanan berhasil dihapus!'
            ]);
        }

        return redirect()->route('action.index')->with([
            'header' => 'GAGAL',
            'message' => 'Layanan tidak dapat dihapus!'
        ]);
    }

}
