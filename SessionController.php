<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    public function index(){
        return view('sesi/index');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect('buku')->with('pesan', 'Berhasil Login');
        }else{
            return redirect('sesi')->withErrors('Username dan Password yang dimasukan tidak valid');
        }
    }

    public function register(){
        return view('sesi/register');
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|', // Menggunakan confirmed untuk memverifikasi ulang password
            'role' => 'required|in:Administrator,Petugas,Peminjam', // Validasi role
        ],
        [
            'name.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password harus minimal 8 karakter',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role yang dipilih tidak valid',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing password saat registrasi
            'role' => $request->role, // Simpan role yang dipilih
        ];

        User::create($data);

        return redirect('sesi')->with('pesan', 'Berhasil Register');
    }
}
