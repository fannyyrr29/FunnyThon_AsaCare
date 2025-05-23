<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            
            switch ($user->role) {
                case 'Admin':
                    # code...
                    return redirect()->route('admin.dashboard');
                case 'Dokter':
                    // return response()->json(compact('user'));
                    return redirect()->route('doctor.index');
                case 'User':
                    // return response()->json(compact('user'));
                    return redirect()->route('user.home');
                default:
                    # code...
                    return redirect()->route('login')->withInput()->withErrors(['Error' => 'Peran anda tidak ditemukan!']);
            }

        }else{
            return back()->withErrors([
                'password' => 'Password yang anda masukkan salah!',
            ])->withInput();
        }

        return back()->withErrors([
            'account' => 'Pengguna tidak ditemukan',
        ])->withInput();
    }

    protected function redirectTo()
    {
        $role = auth()->user()->role;

        if ($role === 'Admin') {
            return '/admin/dashboard';
        } elseif ($role === 'User') {
            return '/user';
        } elseif ($role === 'Dokter') {
            return '/doctor';
        }

        return '/login'; // default jika role tidak dikenali
    }



    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
