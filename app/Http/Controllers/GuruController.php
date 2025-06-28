<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Matpel;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::with('matpels')->get();
        return view('guru.index', compact('gurus'));
    }

    public function insert(Request $request)
    {
        if ($request->isMethod('post')) {
            $guru = Guru::create([
                'nama_guru' => $request->nama_guru,
                'email' => $request->email,
                'alamat' => $request->alamat
            ]);

            $guru->matpels()->attach($request->matpels);

            return redirect('/guru')->with('message', 'Data guru berhasil ditambahkan.');
        }

        $matpel = Matpel::all();
        return view('guru.form', compact('matpel'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        if ($request->isMethod('post')) {
            $guru = Guru::findOrFail($id);

            // update data guru
            $guru->update([
                'nama_guru' => $request->nama_guru,
                'email' => $request->email,
                'alamat' => $request->alamat
            ]);

            $guru->matpels()->sync($request->matpels);

            return redirect('/guru')->with('message', 'Data guru berhasil diperbarui.');
        }

        $matpel = Matpel::all();
        return view('guru.form', compact('guru', 'matpel'));
    }

    public function delete($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->matpels()->detach();
        $guru->delete();
        return redirect('/guru')->with('message', 'Data guru berhasil dihapus.');
    }
}
