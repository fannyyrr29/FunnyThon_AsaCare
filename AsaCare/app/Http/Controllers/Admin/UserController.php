<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('admins.user', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.membuatUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->NIK = $request->nik;
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->role = $request->role;
            $user->gender = $request->gender;
            $user->birthdate = $request->birthdate;
            $user->profile = $request->profile;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->created_at = now();
            if ($user->save()) {
                return redirect()->route('admin.user.index')->with(['header'=> 'SUKSES', 'message' => 'Data berhasil ditambahkan!']);
            }
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['header'=> 'GAGAL', 'message' => 'Data tidak dapat ditambahkan! ' . $th]);
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
        $user = User::find($id);
        return view('admins.ubahUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::find($id);
            $user->NIK = $request->nik;
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->role = $request->role;
            $user->gender = $request->gender;
            $user->birthdate = $request->birthdate;
            $user->profile = $request->profile;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->updated_at = now();
        if ($user->save()) {
            // return response()->json(['header'=> 'SUKSES', 'message' => 'Data berhasil diubah!']);
            return redirect()->route('admin.user.index')->with(['header'=> 'SUKSES', 'message' => 'Data berhasil ditambahkan!']);
        }
        } catch (\Throwable $th) {
            // return response()->json(['header'=> 'GAGAL', 'message' => 'Data tidak dapat diubah! ' . $th->getMessage()]);

            return redirect()->back()->withInput()->withErrors(['header'=> 'GAGAL', 'message' => 'Data tidak dapat ditambahkan! ' . $th->getMessage()]);
        }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $user = User::find($id);
            if ($user->delete()) {
                // return response()->json(['header'=> 'SUKSES', 'message' => 'Data berhasil dihapus!']);
                return redirect()->route('admin.user.index')->with(['header'=> 'SUKSES', 'message' => 'Pengguna berhasil dihapus!']);
            }
        } catch (\Throwable $th) {
            // return response()->json(['header'=> 'GAGAL', 'message' => 'Data tidak dapat dihapus! ' . $th->getMessage()]);
            return redirect()->route('admin.user.index')->with(['header'=> 'GAGAL', 'message' => 'Pengguna tidak dapat dihapus!']);
        }
        

    }
}
