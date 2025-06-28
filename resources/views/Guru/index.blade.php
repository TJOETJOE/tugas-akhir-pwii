@extends('layouts.app')
@section('title', 'Data Guru')
@section('content')

<h1>Data Guru dan Mata Pelajaran</h1>

@if(session('message'))
    <div style="background:green; color:white; padding:5px;">
        {{ session('message') }}
    </div>
@endif

<a href="{{ url('/guru/insert') }}" class="btn btn-info mb-3">Tambah Data</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Guru</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Mata Pelajaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($gurus as $guru)
        <tr>
            <td>{{ $guru->nama_guru }}</td>
            <td>{{ $guru->email }}</td>
            <td>{{ $guru->alamat }}</td>
            <td>
                @foreach($guru->matpels as $matpel)
                    {{ $matpel->nama_matpel }}<br>
                @endforeach
            </td>
            <td>
                <a href="{{ url('/guru/update/'.$guru->id) }}" class="btn btn-light btn-sm">Ubah</a>
                <a href="{{ url('/guru/delete/'.$guru->id) }}" class="btn btn-light btn-sm">Hapus</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
