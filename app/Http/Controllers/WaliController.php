<?php

namespace App\Http\Controllers;

use App\Models\Wali;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class WaliController extends Controller
{
    function index()
    {
        $data = [
            'wali' => Wali::all()
        ];
        return view('wali.list', $data);
    }

    function insert(Request $request)
    {
        if ($request->isMethod('post')) {
            $wali = new Wali();
            $wali->nama_wali = $request->input('nama wali');
            $wali->pekerjan_wali = $request->input('pekerjaan');
            $wali->id_siswa = $request->input('Id Siswa');

            $wali->save();
            return redirect('/wali')->with(['message' => 'Data wali berhasil ditambahkan.']);
        }
        return view('wali.form');
    }

    function update(Request $request)
    {
        $wali = Wali::find($request->id);
        $data = [
            'wali' => $wali
        ];
        if ($request->isMethod('post')) {
            $wali->nama_wali = $request->nama_wali;
            $wali->pekerjaan = $request->pekerjaan;
            $wali->id_siswa = $request->id_siswa;
            $wali->save();
            return redirect('/wali')->with(['message' => 'Ubah data wali berhasil.']);
        }
        return view('wali.form', $data);
    }

    function delete(Request $request)
    {
        $wali = Wali::find($request->id);
        $wali->delete();
        return redirect('/wali')->with(['message' => 'Data wali berhasil dihapus.']);
    }

    // One to one relationship function
    public function wali()
    {
        $wali = Wali::all();
        return view('siswa.wali', ['wali' => $wali]);
    }
}
