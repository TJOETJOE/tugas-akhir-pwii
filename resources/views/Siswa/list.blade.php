@extends('layouts.app')
@section('title', 'List Siswa')
@section('content')
<h1>Data Siswa</h1>

@if ($message = Session::get('message'))
<div style="background: green; color: white; padding: 5px;">
    {{ session::get('message') }}
</div>
@endif

<a href="{{ url('/siswa/insert') }}" class="btn btn-info mb-3">Tambah Data</a>

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>
    @foreach($siswas as $siswa)
    <tr>
        <td>{{ $siswa->nama }}</td>
        <td>{{ $siswa->email }}</td>
        <td>{{ $siswa->kelas }}</td>
        <td>
            <a href="{{ url('/siswa/update', $siswa->id) }}" class="btn btn-light btn-sm">Ubah</a>
            <a href="{{ url('/siswa/delete', $siswa->id) }}" class="btn btn-light btn-sm"
                onclick="return confirm('Yakin hapus?')">Hapus</a>

        </td>
    </tr>
    @endforeach
</table>
<a href="{{url('/siswa/wali')}}">Data Wali</a>
@endsection