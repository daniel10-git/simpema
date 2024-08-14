<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil dosen yang sesuai dengan user yang sedang login
        $dosen = Dosen::where('id_user', $user->id)->first();

        // Pastikan $dosen ada sebelum melanjutkan
        if (!$dosen) {
            abort(404, 'Dosen tidak ditemukan.');
        }

        return view('dosen.index', compact('dosen'));
    }

    // Show a specific dosen with associated mahasiswa and edit requests
    public function show($id)
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();
        $mahasiswa = Mahasiswa::where('kelas_id', $dosen->kelas_id)->get();
        // $users = User::all();
        $mahasiswanull = Mahasiswa::whereNull('kelas_id')->get();
        return view('dosen.show', compact('dosen', 'mahasiswa',  'mahasiswanull'));
    }

    // Handle approval or rejection of edit requests
    public function viewEditRequests()
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'User not authenticated.');
        }

        $mahasiswa = Mahasiswa::where('kelas_id', $dosen->kelas_id)->get();
        $editRequests = RequestEdit::whereIn('mahasiswa_id', $mahasiswa->pluck('id'))
            ->with('mahasiswa', 'kelas')
            ->get();

        return view('dosen.show2', compact('editRequests'));
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
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();

        $request->validate([
            'id_user' => 'required',
            'nama' => 'required',
        ]);

        // Find a mahasiswa entry without kelas_id
        $mahasiswa = Mahasiswa::whereNull('kelas_id')
            ->where('id_user', $request->input('id_user'))
            ->first();

        // Check if the mahasiswa exists
        if (!$mahasiswa) {
            return redirect()->route('dosen.show', $dosen->id)->with('error', 'Mahasiswa not found or already assigned to a class.');
        }

        // Update the mahasiswa's kelas_id with the Dosen's kelas_id
        $mahasiswa->kelas_id = $dosen->kelas_id;
        $mahasiswa->nama = $request->input('nama');
        $mahasiswa->save();

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
        $search = $request->input('search'); // Get search query from request

        // Filter mahasiswa based on search query
        $mahasiswa = Mahasiswa::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%");
        })->get();

        return view('dosen.mahasiswa', compact('mahasiswa', 'search'));
        $mahasiswa = Mahasiswa::all();
        // return view('dosen.mahasiswa', compact('mahasiswa'));
    }
  
}
