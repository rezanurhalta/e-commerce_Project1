<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show() {
    return view('Auth.formRegister');
}

public function register(Request $request) {
    // Validasi Input
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Buat User Baru
    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect('/login')->with('status', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
}
}
