<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa; // Pastikan ini di-import untuk menghubungkan ke Model

class ProfilController extends Controller
{
    public function index()
    {
        // Ambil semua data mahasiswa dari database SQLite, urutkan dari IPK tertinggi
        $mahasiswas = Mahasiswa::orderBy('ipk', 'desc')->get();

        return view('profil', compact('mahasiswas'));
    }

    // Method baru untuk menampilkan halaman detail satu orang mahasiswa
    public function show($id)
    {
        // Cari data berdasarkan ID, jika tidak ketemu otomatis memunculkan error 404
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('profil-detail', compact('mahasiswa'));
    }
}