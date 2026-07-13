<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $mahasiswa = [
            'nama'     => 'Zayyan Fadhlur Rahman', // Ganti dengan nama lengkap Anda
            'nim'      => '3337250010',
            'prodi'    => 'Informatika',
            'angkatan' => 2025,
            'ipk'      => 4.00, 
            'email'    => 'fadhlurrahmanzayyan@gmail.com', // Ganti dengan email Anda
            'github'   => 'github.com/zayyanfr', // Ganti dengan GitHub Anda
            'skill'    => ['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'Git', 'C++', 'Python'],
            'bio'      => 'Mahasiswa Informatika UNTIRTA yang semangat belajar.',
        ];

        return view('profil', compact('mahasiswa'));
    }
}