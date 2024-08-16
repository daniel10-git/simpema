<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id_user,
            'password' => 'nullable|string|min:8',
            'nama' => 'required',
            'string',
            'nim' => 'required',
            'string',
            'tempat_lahir' => 'required',
            'string',
            'tanggal_lahir' => 'required',
            'date'
        ]);

        $user = User::findOrFail($request->id_user);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $mahasiswa = Mahasiswa::where('id', $request->id)->first();
        $mahasiswa->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'edit' => '0'
        ]);
        return redirect()->route('tampil.mahasiswa');
    }

    //request mahasiswa
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
