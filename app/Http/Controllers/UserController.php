<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\AuthService;


class UserController extends Controller
{
    public function index()
    {
        return view('admins.user.index', ['users' => User::all()]);
    }

    public function create()
    {
        return view('admins.user.create');
    }

    public function store(Request $request, AuthService $authService)
    {
        $this->validate_user($request, false);
        $this->save_user($request, new User());

        return redirect('/admin/data/user')->withSuccess('Data User Berhasil Ditambahkan');
    }

    public function show(User $user)
    {
        return view('admins.user.details', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admins.user.edit')->with('data', $user);
    }

    public function update(Request $request, User $user, AuthService $authService)
    {
        $this->validate_user($request, true);
        $this->save_user($request, $user);

        return $this->redirect_to_index($authService, 'Data User Berhasil Diubah');
    }

    public function destroy(User $user, AuthService $authService)
    {
        $user->delete();
        if ($user->foto_user != '') {
            File::delete(public_path('images/' . $user->foto_user));
        }

        return $this->redirect_to_index($authService, 'Data User Berhasil Dihapus');
    }

    private function validate_user(Request $request, $is_edit)
    {
        $rules = [
            'nama_user' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'foto_user' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        if ($is_edit) {
            $rules = [
                'nama_user' => 'required',
            ];
        }

        $message = [
            'nama_user.required' => 'Nama User Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'password.required' => 'Password Harus Diisi',
            'level.required' => 'Level User Harus Diisi',
            'foto_user.required' => 'Foto User Harus Diisi',
            'foto_user.image' => 'Foto User Harus Gambar',
            'foto_user.mimes' => 'Foto User Harus Berformat jpeg,png,jpg,gif,svg',
            'foto_user.max' => 'Foto User Maksimal 2MB',
        ];

        $request->validate($rules, $message);
    }

    private function save_user(Request $request, User $user)
    {
        $user->nama_user = $request->nama_user;
        if ($request->email)  $user->email = $request->email;
        if ($request->level)  $user->level = $request->level;
        if ($request->password)  $user->password = Hash::make($request->password);

        if ($request->foto_user) {
            $foto_file = $request->file('foto_user');
            $foto_name = time() . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('images'), $foto_name);

            $user->foto_user = $foto_name;
        }

        $user->save();
    }

    private function redirect_to_index(AuthService $authService, $message)
    {
        if ($authService->currentUserIsKaprodi()) {
            return redirect('/kaprodi')->withSuccess($message);
        }

        return redirect('/admin/data/user')->withSuccess($message);
    }
}
