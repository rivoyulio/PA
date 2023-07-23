<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\DB;
// use Method Illuminate\Auth\SessionGuard;

class UserController extends Controller
{
    public function index()
    {
        if(session('success_message')){
            Alert::toast( session('success_message'),'success');
        }
        
        return view('admins.user.index',[
            'users' => User::paginate(5)
        ]);
    }

    // public function profile()
    // {
    //     return view('admins.user.profile',[
    //         'users' => User::all()
    //     ]);
    // }
    
    public function create()
    {   
        $title = 'User';
        return view('admins.user.create')->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'foto_user' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama_user.required' => 'Nama User Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'password.required' => 'Password Harus Diisi',
            'level.required' => 'Level User Harus Diisi',
            'foto_user.required' => 'Foto User Harus Diisi',
            'foto_user.image' => 'Foto User Harus Gambar',
            'foto_user.mimes' => 'Foto User Harus Berformat jpeg,png,jpg,gif,svg',
            'foto_user.max' => 'Foto User Maksimal 2MB',
        ]);

        $foto_file = $request->file('foto_user');
        $foto_ekstensi = $foto_file->getClientOriginalExtension();
        $nama_foto = time() . '.' . $foto_ekstensi;
        $foto_file->move(public_path('images'), $nama_foto);

        $data = [
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'foto_user' => $nama_foto    
        ];

        $title = 'Tambah User';

        User::create($data);
        return redirect()->route('user.index')->withSuccessMessage('Data User Berhasil Ditambahkan', compact('title'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $users = $user;
        $breadcrum = 'Details User';
        return view('admins.user.details')->with('user', $users,compact('breadcrum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
            $data = User::where('id_user', $user->id_user)->first();
            return view('admins.user.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama_user' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'foto_user' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama_user.required' => 'Nama User Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'password.required' => 'Password Harus Diisi',
            'level.required' => 'Level User Harus Diisi',
            'foto_user.required' => 'Foto User Harus Diisi',
            'foto_user.image' => 'Foto User Harus Gambar',
            'foto_user.mimes' => 'Foto User Harus Berformat jpeg,png,jpg,gif,svg',
            'foto_user.max' => 'Foto User Maksimal 2MB',
        ]);

        $data = [
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            // 'foto_user' => $nama_foto   
        ];

        if ($request->hasFile('foto_user')) {
            $foto_file = $request->file('foto_user');
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $nama_foto = time() . '.' . $foto_ekstensi;
            $foto_file->move(public_path('images'), $nama_foto);
            $data_foto = User::where('id_user', $user->id_user)->first();
            File::delete(public_path('images/' . $data_foto->foto_user));
        }

        $data['foto_user'] = $nama_foto;
        $title = 'Edit User';


        User::where('id_user', $user->id_user)->update($data);
        return redirect()->route('user.index')->withSuccessMessage('Data User Berhasil Diubah', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $data = User::where('id_user', $user->id_user)->first();
        File::delete(public_path('images/' . $data->foto_user));
        User::where('id_user', $user->id_user)->delete();
        return redirect()->route('user.index')->withSuccessMessage('Data User Berhasil Dihapus');
    }
   
}
