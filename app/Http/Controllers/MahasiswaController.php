<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function indexMahasiswa()
    {
        $mahasiswa = Mahasiswa::where('id_user', auth()->user()->id)->get();
        $mahasiswa_id = $mahasiswa->pluck('id');
        $requestEditExists = RequestEdit::where('mahasiswa_id', $mahasiswa_id)->exists();
        return view('vmahasiswa.mahasiswa1', ['mahasiswa' => $mahasiswa, 'requestEditExists' => $requestEditExists]);
    }

    public function EditDataMhs(Request $request)
    {
        $mahasiswa = Mahasiswa::where('id', $request->id)->first();
        return view('vmahasiswa.editMahasiswa', ['mahasiswa' => $mahasiswa]);
    }

    public function updateMahasiswa(Request $request)
    {
        $mahasiswa = Mahasiswa::where('id', $request->id)->first();
        $mahasiswa->update([
            'id_user' => $request->id_user,
            'kelas_id' => $request->kelas_id,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'edit' => $request->edit
        ]);
        return redirect()->route('tampil.mahasiswa');
    }

    //request
    public function AksesEdit(Request $request)
    {
        $mahasiswa = Mahasiswa::where('id', $request->id)->first();
        return view('vmahasiswa.requestedit', ['mahasiswa' => $mahasiswa]);
    }

    public function requestEdit(Request $request)
    {
        $data = [
            'id' => $request->id,
            'mahasiswa_id' => $request->mahasiswa_id,
            'kelas_id' => $request->kelas_id,
            'keterangan' => $request->keterangan,
        ];

        RequestEdit::create($data);
        return redirect()->route('tampil.mahasiswa');
    }
}
