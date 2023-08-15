<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;

class KaprodiController extends Controller
{
    public function profile(AuthService $authService)
    {
        return view('admins.kaprodi.profile', ['user' => $authService->currentUserGuardInstance()->user() ]);
    }
}
