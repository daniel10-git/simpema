<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    public function Request()
    {
        $requestEdit = RequestEdit::with('mahasiswa', 'kelas')->get();
        return view('tabelrequest', ['requestEdit' => $requestEdit]);
    }

    public function UpdateEdit(Request $request)
    {
        $mahasiswa = Mahasiswa::where('id', $request->id)->first();
        $mahasiswa->update([
            'edit' => $request->edit
        ]);
        $requestEdit = RequestEdit::where('mahasiswa_id', $request->id)->first();
        if ($requestEdit) {
            $requestEdit->delete();
        }
        return redirect()->route('acc.request');
    }
}
