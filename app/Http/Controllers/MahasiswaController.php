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
        // Menampung hasil validasi ke dalam variabel $validated
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'nim'      => 'required|string|unique:mahasiswas,nim',
            'prodi'    => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:2030',
            'ipk'      => 'required|numeric|min:0|max:4',
            'email'    => 'nullable|email|max:100',
            'bio'      => 'nullable|string|max:500',
        ]);

        // Menambahkan user_id dari user yang sedang login
        $validated['user_id'] = auth()->id();

        Mahasiswa::create($validated);

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
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Hanya pemilik data yang boleh akses halaman edit
        if ($mahasiswa->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit data ini.');
        }

        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Menampung hasil validasi ke variabel $validatedData
        $validatedData = $request->validate([
            'nama'     => 'required|string|max:100',
            'nim'      => 'required|string|unique:mahasiswas,nim,' . $id,
            'prodi'    => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:2030',
            'ipk'      => 'required|numeric|min:0|max:4',
            'email'    => 'nullable|email|max:100',
            'bio'      => 'nullable|string|max:500',
        ]);

        // Simpan pembaruan data (Kode update milik Anda kemarin)
        $mahasiswa->update($validatedData);

        return redirect()->route('mahasiswas.index')
                         ->with('success', "Data {$mahasiswa->nama} berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $nama = $mahasiswa->nama; 
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index')
                         ->with('success', "Data $nama berhasil dihapus.");
    }
}