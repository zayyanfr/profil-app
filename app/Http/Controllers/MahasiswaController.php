<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'nim'      => 'required|string|unique:mahasiswas,nim',
            'prodi'    => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:2030',
            'ipk'      => 'required|numeric|min:0|max:4',
            'email'    => 'nullable|email|max:100',
            'bio'      => 'nullable|string|max:500',
        ]);

        Mahasiswa::create($request->validated());

        return redirect()->route('mahasiswas.index')
                         ->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Kosongkan dulu sesuai modul nanti
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Cari data mahasiswa berdasarkan ID, jika tidak ketemu otomatis tampilkan error 404
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // PASTIKAN ada tulisan "$validatedData =" di awal baris ini!
        $validatedData = $request->validate([
            'nama'     => 'required|string|max:100',
            'nim'      => 'required|string|unique:mahasiswas,nim,' . $id,
            'prodi'    => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:2030',
            'ipk'      => 'required|numeric|min:0|max:4',
            'email'    => 'nullable|email|max:100',
            'bio'      => 'nullable|string|max:500',
        ]);

        // Simpan pembaruan data
        $mahasiswa->update($validatedData);

        // Redirect ke daftar mahasiswa dengan flash message sukses
        return redirect()->route('mahasiswas.index')
                         ->with('success', "Data {$mahasiswa->nama} berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Simpan nama terlebih dahulu sebelum data dihapus dari database
        $nama = $mahasiswa->nama; 
        
        // Proses hapus dari database SQLite
        $mahasiswa->delete();

        // Redirect kembali ke halaman utama dengan flash message sukses
        return redirect()->route('mahasiswas.index')
                         ->with('success', "Data $nama berhasil dihapus.");
    }
}