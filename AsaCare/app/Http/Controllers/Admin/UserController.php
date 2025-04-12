<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admins.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.tambahUser');
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
            $user->email = $request->email;
            $user->password = $request->password;
            $user->created_at = now();

            // Proses upload profile (jika ada)
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();

                $destination = public_path('assets/images/profile');

                $file->move($destination, $filename);
                $user->profile = $filename;
            }

            if ($user->save()) {
                return redirect()->route('admin.user.index')->with([
                    'header' => 'SUKSES',
                    'message' => 'Data berhasil ditambahkan!'
                ]);
            }

        } catch (\Throwable $th) {
            return redirect()->route('admin.user.create')->withInput()->withErrors([
                'header' => 'GAGAL',
                'message' => 'Data tidak dapat ditambahkan! ' . $th->getMessage()
            ]);
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

            if (!$user) {
                return redirect()->route('admin.user.edit', $id)->withErrors([
                    'header' => 'GAGAL',
                    'message' => 'User tidak ditemukan!'
                ]);
            }

            // Validasi dasar
            $request->validate([
                'nik' => 'required',
                'name' => 'required',
                'email' => 'required|email',
            ]);

            $user->NIK = $request->nik;
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->role = $request->role;
            $user->gender = $request->gender;
            $user->birthdate = $request->birthdate;
            $user->email = $request->email;
            $user->updated_at = now();

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }else{
                $user->password = $request->old_password;
            }

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();

                $destination = public_path('assets/images/profile');

                if ($user->profile && File::exists($destination . '/' . $user->profile)) {
                    File::delete($destination . '/' . $user->profile);
                }

                $file->move($destination, $filename);
                $user->profile = $filename;
            }

            if ($user->save()) {
                return redirect()->route('admin.user.index')->with([
                    'header' => 'SUKSES',
                    'message' => 'Data berhasil diubah!'
                ]);
            }

        } catch (\Throwable $th) {
            return redirect()->route('admin.user.edit', $id)->withInput()->withErrors([
                'header' => 'GAGAL',
                'message' => 'Data tidak dapat diubah! ' . $th->getMessage()
            ]);
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
            return redirect()->route('admin.user.index')->with(['header'=> 'GAGAL', 'message' => 'Pengguna tidak dapat dihapus! ' . $th->getMessage()]);
        }
    
    }
}
