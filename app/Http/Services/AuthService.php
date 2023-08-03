<?php

namespace App\Http\Services;

class AuthService
{
    public function currentUserGuard()
    {
        if (auth()->guard('web')->check()) return 'web';
        if (auth()->guard('mahasiswa')->check()) return 'mahasiswa';
        return null;
    }

    public function currentUserGuardInstance()
    {
        if ($guard = $this->currentUserGuard()) {
            return auth()->guard($guard);
        }

        return null;
    }

    public function currentUserIsAdmin()
    {
        return $this->currentUserGuard() == 'web' && auth()->user()->level === 'admin';
    }

    public function currentUserIsDosen()
    {
        return $this->currentUserGuard() == 'web' && auth()->user()->level === 'dosen';
    }

    public function currentUserIsKaprodi()
    {
        return $this->currentUserGuard() == 'web' && auth()->user()->level === 'kaprodi';
    }

    public function currentUserIsMahasiswa()
    {
        return $this->currentUserGuard() == 'mahasiswa';
    }
}
