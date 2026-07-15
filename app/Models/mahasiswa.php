<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Kolom yang boleh diisi secara massal via create() atau update()
    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'angkatan',
        'ipk',
        'email',
        'github',
        'bio',
    ];

    // Konversi tipe data secara otomatis saat diakses oleh Laravel
    protected $casts = [
        'ipk'      => 'decimal:2',
        'angkatan' => 'integer',
    ];
}