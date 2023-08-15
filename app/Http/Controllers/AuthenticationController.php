<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        Session::flash('email', $request->email);

        $data = User::all();

        return view('login')->with('data', $data);
    }

    protected function guard()
    {
        return Auth::guard('user');
    }


    public function username()
    {
        return 'email';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            session(['nama_user' => $user->nama_user]);
            session(['foto_user' => $user->foto_user]);

            if ($user->level === 'admin') {
                return redirect('/')->with('success', 'Anda Berhasil Login');
            } elseif ($user->level === 'kaprodi') {
                return redirect('/kaprodi')->with('success', 'Anda Berhasil Login');
            } elseif ($user->level === 'dosen') {
                return redirect('/dosen')->with('success', 'Anda Berhasil Login');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function pageRegister(Request $request)
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ],[
            'nama_user.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Email Harus Berformat Email',
            'password.required' => 'Password Harus Diisi',
            'password.min' => 'Password Minimal 8 Karakter'
        ]);

        $data = [
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ];

        User::create($data);

        return redirect('/login')->with('success', 'Register Berhasil');
    }

    public function logout(AuthService $authService) {
        if ($guard = $authService->currentUserGuard()) {
            Auth::guard($guard)->logout();
        }

        return redirect('/welcome');
    }
}
