<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{
    public function index(){
        return view('Auth.login');
    }


    public function authenticate(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Retrieve the user by email
        $user = User::where('email', $credentials['email'])->first();

        // Check if the user exists and the password matches
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Authentication passed, log the user in manually
            Auth::login($user);

            session(['user' => $user]);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); 
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard'); 
            } elseif ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard'); 
            }else {
                return redirect()->route('home')->with('error', 'Role tidak dikenali!');
            }
        }

        // If authentication fails, return an error response
        return response()->json(['message' => 'Akun tidak ditemukan!'], 401);
    }


    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
