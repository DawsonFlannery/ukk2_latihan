<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function home()
    {
        return view('index');
    }

    public function tableIndex()
    {
        $siswa = Siswa::all();

        return view('siswa.index', compact('siswa'));
    }

    public function formDaftar()
    {
        return view('siswa.daftar');
    }

    public function daftarSiswa(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'asal_sekolah' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $siswa = Siswa::create($request->all());

        return redirect()->route('siswa.print', $siswa->id);
    }

    public function printData($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.print', compact('siswa'));
    }

    public function editSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function siswaUpdate(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'email' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'temp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'asal_sekolah' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data Telah Diperbarui');
    }

    public function siswaDestroy($siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data Telah Terhapus');
    }
}
