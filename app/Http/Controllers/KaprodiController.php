<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    public function data($id)
    {
        $kaprodi = Kaprodi::findOrFail($id);

        return view('profile/infoakun', compact('kaprodi'));
    }

    public function dashboard($id)
    {
        

        return view('layouts/dashboard');
    }
    
    public function indexKaprodi()
    {
        $user = Auth::user();
        $kaprodi = Kaprodi::where('id_user', $user->id)->get();

        return view('layouts.kaprodi', compact('kaprodi'));
    }
    

    public function indexDosen()
    {
        $dosen = dosen::get();
        $user = User::select('id')->where('role', 'dosen')->get();

        return view('layouts/dosen', compact('dosen', 'user'));
    }

    public function storeDosen(Request $request)
    {
        Dosen::create([
            'id_user' => $request->input('id_user'),
            'kode_dosen' => $request->input('kode_dosen'),
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
        ]);
        return redirect()->route('layouts.dosen')->with('success', 'Dosen berhasil ditambah.');
    }

    public function updateDosen(Request $request, $id)
    {
        $request->validate([
            'kode_dosen' => 'required|integer',
            'nip' => 'required|integer',
            'nama' => 'required|string|max:100',
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());

        return redirect()->route('layouts.dosen')->with('success', 'Dosen berhasil diperbarui.');
    }
    public function destroyDosen($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('layouts.dosen')->with('success', 'Dosen berhasil dihapus.');
    }




    public function cariNamaDosen(Request $request)
    {
        $user = User::select('id')->where('role', 'dosen')->get();
        $query = Dosen::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $dosen = $query->get();

        return view('layouts.dosen', compact('dosen', 'user'));
    }




    public function indexKelas()
    {
        $kelas = Kelas::all();
        $user = User::select('id')->where('role', 'dosen')->get();
        return view('layouts.kelas', compact('kelas', 'user'));
    }
    public function cariNamaKelas(Request $request)
    {
        $query = Kelas::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $kelas = $query->get();

        return view('layouts.kelas', compact('kelas'));
    }

    public function createKelas()
    {
        return view('kaprodikelascreate');
    }

    public function storeKelas(Request $request)
    {
        Kelas::create([
            'nama' => $request->input('nama'),
            'kapasitas' => $request->input('kapasitas'),

        ]);

        return redirect()->route('layouts.kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }


    public function updateKelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $kelas->update($request->only(['nama', 'kapasitas']));

        return redirect()->route('layouts.kelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroyKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('layouts.kelas')->with('success', 'Kelas berhasil dihapus.');
    }



    public function indexPlot(Request $request)
    {
        // Mengambil data kelas
        $kelas = Kelas::paginate(1);
        $dkelas = Kelas::all();

        $dosen = Dosen::whereNull('kelas_id')->get();
        $mahasiswa = Mahasiswa::whereNull('kelas_id')->get();;

        // Mengambil ID kelas dari request atau parameter
        // Mengambil dosen yang sesuai dengan ID kelas
        $dosenByKelas = [];
        foreach ($kelas as $kelasItem) {
            $dosenByKelas[$kelasItem->id] = Dosen::where('kelas_id', $kelasItem->id)->get();
        }
        $mahasiswaByKelas = [];
        foreach ($kelas as $kelasItem) {
            $mahasiswaByKelas[$kelasItem->id] = Mahasiswa::where('kelas_id', $kelasItem->id)->get();
        }

        return view('layouts/plotting', compact('kelas', 'dosen', 'mahasiswa', 'dosenByKelas', 'mahasiswaByKelas','dkelas'));
    }

    public function updateKelasDosen(Request $request)
    {
        $request->validate([
            'dosen_ids' => 'required|array',
            'dosen_ids.*' => 'exists:t_dosen,id',
            'id_kelas' => 'required|exists:t_kelas,id',
        ]);

        $idKelas = $request->input('id_kelas');
        $dosenIds = $request->input('dosen_ids');

        // Cek jika kelas yang dipilih sudah memiliki dosen
        $kelasDenganDosen = Dosen::where('kelas_id', $idKelas)->first();

        if ($kelasDenganDosen) {
            // Jika kelas sudah memiliki dosen, batalkan pembaruan
            return redirect()->back()->withErrors([
                'id_kelas' => 'Kelas yang dipilih sudah memiliki dosen.'
            ]);
        }

        // Update kelas dosen
        Dosen::whereIn('id', $dosenIds)->update(['kelas_id' => $idKelas]);

        return redirect()->back()->with('success', 'Kelas dosen berhasil diperbarui.');
    }
    public function destroyKelasDosen($id)
    {
        // Temukan dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Set `id_kelas` menjadi null
        $dosen->update(['kelas_id' => null]);

        // Redirect atau berikan feedback
        return redirect()->back()->with('success', 'Kelas dosen berhasil dihapus.');
    }



    public function updateKelasMahasiswa(Request $request)
    {
        $request->validate([
            'mahasiswa_ids' => 'required|array',
            'mahasiswa_ids.*' => 'exists:t_mahasiswa,id',
            'id_kelas' => 'required|exists:t_kelas,id',
        ]);

        $idKelas = $request->input('id_kelas');
        $mahasiswaIds = $request->input('mahasiswa_ids');

        // Hitung jumlah mahasiswa yang sudah terdaftar di kelas yang dipilih
        $kelas = Kelas::findOrFail($idKelas);
        $jumlahMahasiswaDiKelas = Mahasiswa::where('kelas_id', $idKelas)->count();

        // Hitung jumlah mahasiswa yang akan ditambahkan
        $jumlahMahasiswaAkanDiperbarui = count($mahasiswaIds);

        // Periksa jika jumlah mahasiswa yang akan ditambahkan melebihi kapasitas kelas
        if (($jumlahMahasiswaDiKelas + $jumlahMahasiswaAkanDiperbarui) > $kelas->kapasitas) {
            return redirect()->back()->withErrors([
                'id_kelas' => 'Kapasitas kelas tidak mencukupi untuk jumlah mahasiswa yang dipilih.'
            ]);
        }

        // Perbarui kelas mahasiswa
        Mahasiswa::whereIn('id', $mahasiswaIds)->update(['kelas_id' => $idKelas]);

        return redirect()->back()->with('success', 'Kelas mahasiswa berhasil diperbarui.');
    }

    public function destroyKelasMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update(['kelas_id' => null]);

        return redirect()->back()->with('success', 'Kelas dosen berhasil dihapus.');
    }
}
