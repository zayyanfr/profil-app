@extends('layouts.master')

@section('title', 'Daftar Mahasiswa')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; margin-top: 20px;">
    <h1 style="color:#0B1F3A; margin: 0;">Daftar Mahasiswa</h1>
    <a href="{{ route('mahasiswas.create') }}" style="background:#065A82; color:white; padding:10px 20px; border-radius:6px; text-decoration:none; font-weight: bold;">
        + Tambah Mahasiswa
    </a>
</div>

@foreach($mahasiswas as $mhs)
    <div style="background:white; border-radius:8px; padding:18px; margin-bottom:12px; border-left:4px solid #065A82; display:flex; justify-content:space-between; align-items:center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        
        {{-- INI KODE INFORMASI MAHASISWA (Harus di luar @if agar selalu muncul) --}}
        <div>
            <strong style="color: #333;">{{ $mhs->nama }}</strong>
            <span style="color:#666; margin-left:8px;">{{ $mhs->nim }}</span>
            <span style="color:#065A82; margin-left:8px; font-weight:bold;">IPK: {{ $mhs->ipk }}</span>
        </div>

        {{-- INI KODE TOMBOL AKSI YANG DI-PROTEKSI PENGONDISIAN --}}
        <div style="display:flex; gap:8px;">
            @if($mhs->user_id === auth()->id())
                <a href="{{ route('mahasiswas.edit', $mhs->id) }}" style="background:#6D28D9; color:white; padding:6px 14px; border-radius:5px; text-decoration:none; font-size:13px;">
                    Edit
                </a>

                <form method="POST" action="{{ route('mahasiswas.destroy', $mhs->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus {{ $mhs->nama }}?')" style="background:#DC2626; color:white; padding:6px 14px; border:none; border-radius:5px; cursor:pointer; font-size:13px;">
                        Hapus
                    </button>
                </form>
            @else
                <span style="color:#999; font-size:13px; padding:6px;">
                    (Data orang lain)
                </span>
            @endif
        </div>

    </div>
@endforeach

@if($mahasiswas->isEmpty())
    <p style="color:#888; text-align:center; padding:40px;">
        Belum ada data. <a href="{{ route('mahasiswas.create') }}">Tambah sekarang</a>
    </p>
@endif

@endsection