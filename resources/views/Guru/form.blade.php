@extends('layouts.app')
@section('title', 'Form Tambah Guru')
@section('content')

<h1>Form Tambah Guru</h1>
<form method="POST">
    @csrf
    <div>
        <label>Nama Guru:</label>
        <input type="text" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru ?? '') }}">
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $guru->email ?? '') }}">
    </div>

    <div>
        <label>Alamat:</label>
        <input type="text" name="alamat" value="{{ old('alamat', $guru->alamat ?? '') }}">
    </div>

    <div>
        <label>Mata Pelajaran:</label><br>
        @foreach($matpel as $matpel)
            <label>
                <input type="checkbox" name="matpels[]" value="{{ $matpel->id }}"
                    {{ isset($guru) && $guru->matpels->contains($matpel->id) ? 'checked' : '' }}>
                {{ $matpel->nama_matpel }}
            </label><br>
        @endforeach
    </div>

    <div>
        <button type="submit">Simpan</button>
        <a href="{{ url('/guru') }}">Kembali</a>
    </div>
</form>
@endsection