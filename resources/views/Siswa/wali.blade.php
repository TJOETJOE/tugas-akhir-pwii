@extends('layouts.app')
@section('title', 'Data Wali')
@section('content')

<h1>Data Wali</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Email</th>
            <th>Kelas</th>
            <th>Nama Wali</th>
            <th>Pekerjaan Wali</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $siswa)
        <tr>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->email }}</td>
            <td>{{ $siswa->kelas }}</td>
            <td>{{ $siswa->wali->nama_wali ?? '-' }}</td>
            <td>{{ $siswa->wali->pekerjaan ?? '-' }}</td>
            <td>
                <a href="{{ route('siswa.wali.edit', $siswa->id) }}" class="btn btn-light btn-sm">Edit Wali</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ url('/siswa') }}" class="btn btn-info">Kembali</a>

@endsection