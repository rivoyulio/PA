<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{

    public function index(Request $request)
    {
        Session::flash('nim', $request->nim);

        $data = Mahasiswa::all();

        return view('loginmahasiswa')->with('data', $data);
    }

    public function username()
    {
        return 'nim';
    }

    protected function guard()
    {
        return Auth::guard('mahasiswa');
    }

    public function login(Request $request)
    {

        $request->validate([
            'nim' => 'required',
            'password' => 'required|min:5'
        ],[
            'nim.required' => 'NIM Harus Diisi',
            'password.required' => 'Password Harus Diisi',
            'password.min' => 'Password Minimal 5 Karakter'
        ]);

        $credentials = $request->only('nim', 'password');
        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            // Logika jika pengguna berhasil login sebagai mahasiswa guard
            $request->session()->regenerate();
            $mahasiswa = Auth::guard('mahasiswa')->user();

            session(['fotomhs' => $mahasiswa->foto_mhs]);
            session([ // Menggunakan kolom 'foto_mhs' sebagai contoh
                'nama_mhs' => $mahasiswa->nama_mhs,
                'fotomhs' => $mahasiswa->foto_mhs
            ]);

            return redirect('/index')->with('success', 'Anda Berhasil Login');
        }

        return back()->withErrors([ 'nim' => 'Nim atau password yang diberikan tidak cocok dengan data kami.']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
