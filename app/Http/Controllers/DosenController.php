<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    // Show a specific dosen with associated mahasiswa and edit requests
    public function indexdosen(Request $request, $id)
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();

        // Ambil nilai pencarian dari input
        $search = $request->input('search');

        // Jika ada input pencarian, filter mahasiswa berdasarkan nama atau NIM
        $mahasiswa = Mahasiswa::where('kelas_id', $dosen->kelas_id)
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->paginate(10); // Adjust the number of items per page as needed


        $mahasiswanull = Mahasiswa::whereNull('kelas_id')->get();

        return view('dosen.show', compact('dosen', 'mahasiswa', 'mahasiswanull', 'search'));
    }

    // Menampilkan form edit
    public function editdosen($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::find($dosen->id);

        if (!$user) {
            dd('User tidak ditemukan untuk dosen ini', $dosen);
        }
        return view('dosen.editdosen', compact('dosen', 'user'));
    }

    // Menyimpan data yang telah diedit
    public function updatedosen(Request $request, $id)
    {
        // Debugging: Tampilkan semua data yang dikirimkan
        dd($request->all());
    
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:t_dosen,nip,' . $id,
            'kode_dosen' => 'required|string|max:10|unique:t_dosen,kode_dosen,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        // Temukan Dosen dan User terkait
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->id);
    
        // Update data di tabel users
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
    
        // Update data di tabel dosen
        $dosen->nama = $request->input('nama');
        $dosen->nip = $request->input('nip');
        $dosen->kode_dosen = $request->input('kode_dosen');
        $dosen->save();
    
    
        return redirect()->route('dosen.show')->with('success', 'Data dosen berhasil diupdate.');
    }
    


    // Handle approval or rejection of edit requests
    public function viewEditRequests()
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();

        // Check if dosen has a kelas_id
        if (!$dosen || !$dosen->kelas_id) {
            return redirect()->route('home')->with('error', 'You do not have access to this page.');
        }

        // Fetch edit requests for the dosen's class
        $editRequests = RequestEdit::where('kelas_id', $dosen->kelas_id)->get();

        return view('dosen.show2', compact('editRequests', 'dosen'));
    }

    public function updateEditRequest(Request $request, $id)
    {
        $requestEdit = RequestEdit::findOrFail($id);
        $requestEdit->status = $request->input('status');
        $requestEdit->save();

        return redirect()->route('dosen.viewEditRequests')->with('success', 'Request updated successfully.');
    }
    public function approveEditRequest($id)
    {
        $requestEdit = RequestEdit::findOrFail($id);
        $mahasiswa = $requestEdit->mahasiswa;

        // Set the student's `edit` status to true (or 1)
        $mahasiswa->edit = true;
        $mahasiswa->save();

        // Optionally, delete the request after approval
        $requestEdit->delete();

        return redirect()->back()->with('success', 'Request has been approved. The student can now edit their data.');
    }

    public function hapusrequest($id)
    {
        $request = RequestEdit::findOrFail($id);
        $request->delete();

        return redirect()->route('dosen.index')->with('success', 'Request has been rejected.');
    }

    public function create()
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();

        // Check if the dosen is associated with a class
        if ($dosen && $dosen->kelas_id) {
            $users = User::whereDoesntHave('mahasiswa')->get(); // Assuming you want to exclude users who already have mahasiswa
            return view('dosen.create', ['kelas_id' => $dosen->kelas_id, 'users' => $users]);
        }

        return redirect()->route('dosen.index')->with('error', 'You do not have permission to access this feature.');
    }

    public function store(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();

        // Validate the request
        $request->validate([
            'mahasiswanull' => 'required|array',
            'mahasiswanull.*' => 'exists:t_mahasiswa,id', // Validate each ID in the array
        ]);

        // Get the list of mahasiswa IDs from the request
        $mahasiswaIds = $request->input('mahasiswanull');

        // Update mahasiswa records
        foreach ($mahasiswaIds as $mahasiswaId) {
            $mahasiswanull = Mahasiswa::where('id', $mahasiswaId)
                ->whereNull('kelas_id')
                ->first();

            if ($mahasiswanull) {
                $mahasiswanull->kelas_id = $dosen->kelas_id;
                $mahasiswanull->save();
            }
        }

        return redirect()->route('dosen.show', $dosen->id)->with('success', 'Data mahasiswa berhasil diperbarui dan kelas telah ditetapkan.');
    }




    public function edit($id)
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Ensure only the dosen with the matching kelas_id can edit
        if ($dosen && $dosen->kelas_id === $mahasiswa->kelas_id) {
            return view('dosen.editmhs', compact('mahasiswa'));
        }

        return redirect()->route('dosen.index')->with('error', 'You do not have permission to edit this data.');
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Ensure only the dosen with the matching kelas_id can update
        if ($dosen && $dosen->kelas_id === $mahasiswa->kelas_id) {

            // Validate the input
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'nim' => 'required|string|max:20|unique:t_mahasiswa,nim,' . $mahasiswa->id,
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                // Add other fields as needed
            ]);

            // Update the Mahasiswa data
            $mahasiswa->update($validatedData);

            return redirect()->route('dosen.show', $dosen->id)->with('success', 'Mahasiswa data updated successfully.');
        }

        return redirect()->route('dosen.index')->with('error', 'You do not have permission to update this data.');
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Retrieve the Dosen associated with this Mahasiswa
        $dosen = Dosen::where('kelas_id', $mahasiswa->kelas_id)->first();

        // If no Dosen is found, you might want to handle this case
        if (!$dosen) {
            return redirect()->route('dosen.index')->with('error', 'Dosen not found.');
        }

        // Set kelas_id to NULL instead of deleting the record
        $mahasiswa->kelas_id = null;
        $mahasiswa->save();

        // Redirect to the show route of the found Dosen
        return redirect()->route('dosen.show', $dosen->id)->with('success', 'Kelas mahasiswa berhasil dihapus.');
    }



    public function mahasiswaindex(Request $request)
    {
        $search = $request->input('search'); // Mendapatkan query pencarian dari request

        // Ambil semua mahasiswa jika tidak ada pencarian
        $mahasiswa = Mahasiswa::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%");
        })->get();

        // Mengembalikan view dengan data mahasiswa
        return view('dosen.mahasiswa', compact('mahasiswa', 'search'));
    }
}
