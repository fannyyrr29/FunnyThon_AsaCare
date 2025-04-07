<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function home(){
        return view('users.home');
    }
     

    public function index()
    {
        return view('users.profile');
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
        $user = User::find($request->id);
        if (!$user) {
            return redirect()->back()->withErrors(['Error' => "Pengguna tidak ditemukan!"]);
        }

        $user->name = $request->name;
        $user->address = $request->address;

        if ($user->save()) {
            return response()->json(['status' => 'Update Sukses']);
            // return redirect()->route('user.home')->with('Sukses', 'Profil telah diubah!');
        }
        return response()->json(['status' => 'Update Gagal']);

        // return redirect()->back()->withInput()->withErrors(['Error' => "Profil tidak dapat diubah!"]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak ditemukan!'], 404);
        }
        return response()->json(compact('user'));
        // return view('users.editProfile', compact('user'));
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
