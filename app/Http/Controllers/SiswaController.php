<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    function index()
    {
        $data = array(
            'siswas' => SiswaModel::all()
        );
        return view('siswa.list', $data);
    }

    function insert(Request $request)
    {
        if ($request->isMethod('post')) {
            $siswa = new SiswaModel();
            $siswa->nama = $request->input('nama');
            $siswa->email = $request->input('email');
            $siswa->kelas = $request->input('kelas');
            $siswa->save();
            return redirect('/siswa')->with(['message' => 'Data siswa berhasil ditambahkan.']);
        }
        return view('siswa.form');
    }

    function update(Request $request)
    {
        $siswa = SiswaModel::find($request->id);
        $data = array(
            'siswa' => $siswa
        );

        if ($request->isMethod('post')) {
            $siswa->nama = $request->nama;
            $siswa->email = $request->email;
            $siswa->kelas = $request->kelas;
            $siswa->save();
            return redirect('/siswa')->with(['message' => 'Ubah data siswa berhasil.']);
        }
        return view('siswa.form', $data);
    }

    function delete(Request $request)
    {
        $siswa = SiswaModel::find($request->id);
        $siswa->delete();
        return redirect('/siswa')->with(['message' => 'Data siswa berhasil dihapus.']);
    }

    // One to one relationship function
    public function wali()
    {

        $siswa = SiswaModel::with('wali')->get();
        return view('siswa.wali', compact('siswa'));
    }

    public function formWali($id)
    {
        $siswa = SiswaModel::with('wali')->findOrFail($id);
        return view('siswa.form_wali', compact('siswa'));
    }

    public function storeWali(Request $request, $id)
    {
        $request->validate([
            'nama_wali' => 'required',
            'pekerjaan' => 'required'
        ]);

        $wali = \App\Models\Wali::updateOrCreate(
            ['id_siswa' => $id],
            ['nama_wali' => $request->nama_wali, 'pekerjaan' => $request->pekerjaan]
        );

        return redirect('/siswa/wali')->with('message', 'Data wali berhasil disimpan.');
    }   
}
