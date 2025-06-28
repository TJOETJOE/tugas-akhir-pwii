@extends('layouts.app')
@section('title', 'Form Wali')
@section('content')

<h1>Form Wali untuk {{ $siswa->nama }}</h1>

<form action="{{ route('siswa.wali.update', $siswa->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama_wali">Nama Wali</label>
        <input type="text" name="nama_wali" value="{{ old('nama_wali', $siswa->wali->nama_wali ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $siswa->wali->pekerjaan ?? '') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ url('/siswa/wali') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
