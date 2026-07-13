@extends('layouts.app')

@section('title', 'Tentang Mata Kuliah')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
    <h1 style="color: #065A82; margin-bottom: 12px;">{{ $info['matakuliah'] }}</h1>
    <p style="margin-bottom: 6px;"><strong>Semester:</strong> {{ $info['semester'] }}</p>
    <p><strong>Dosen:</strong> {{ $info['dosen'] }}</p>
</div>
@endsection