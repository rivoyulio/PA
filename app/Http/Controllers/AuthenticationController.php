<?php

namespace App\Http\Controllers;


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
            // Logika jika pengguna berhasil login sebagai web guard

            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->level === 'mahasiswa') {
                return back()->withErrors([
                    'email' => 'Email atau password yang diberikan tidak cocok dengan data kami.',
                ]);
            }

            session(['nama_user' => $user->nama_user]);
            session(['foto_user' => $user->foto_user]);

            if ($user->level === 'admin') {
                // Logika untuk admin
                return redirect('/dashboard')->with('success', 'Anda Berhasil Login');
            } elseif ($user->level === 'kaprodi') {
                // Logika untuk kaprodi
                return redirect('/dashboard')->with('success', 'Anda Berhasil Login');
            } elseif ($user->level === 'dosen') {
                // Logika untuk dosen
                return redirect('/dashboard')->with('success', 'Anda Berhasil Login');
            }
        } else {
            // Logika jika pengguna gagal login di web guard
            // Coba login sebagai mahasiswa guard
            if (Auth::guard('mahasiswa')->attempt($credentials)) {
                // Logika jika pengguna berhasil login sebagai mahasiswa guard
                $request->session()->regenerate();
                $mahasiswa = Auth::guard('mahasiswa')->user();
                session(['nama_mhs' => $mahasiswa->nama_mhs]);
                session(['fotomhs' => $mahasiswa->fotomhs]);
                return redirect('/index')->with('success', 'Anda Berhasil Login');
            } else {
                // Logika jika pengguna gagal login di kedua guard
                return back()->withErrors([
                    'email' => 'Email atau password yang diberikan tidak cocok dengan data kami.',
                ]);
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

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
