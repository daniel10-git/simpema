<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Middleware\MahasiswaMiddleware;
use App\Models\Kaprodi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'mahasiswa'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'indexMahasiswa'])->name('tampil.mahasiswa');
    Route::get('/mahasiswa/mintaAkses', [MahasiswaController::class, 'AksesEdit'])->name('minta.akses');
    Route::get('/mahasiswa/editData', [MahasiswaController::class, 'EditDataMhs'])->name('edit.data');
    Route::post('/mahasiswa/kirimAkses', [MahasiswaController::class, 'requestEdit'])->name('kirim.akses');
    Route::post('/mahasiswa/updateData', [MahasiswaController::class, 'updateMahasiswa'])->name('update.data');
});



Route::middleware(['auth', 'kaprodi'])->group(function () {
    Route::get('/dashboard', function () {
        return view('/layouts.dashboard');
    })->name('layouts.dashboard');
    Route::get('/logout', function () {
        return view('/layouts.logout');
    })->name('welcome');
    Route::get('/kaprodi', [KaprodiController::class, 'indexKaprodi'])->name('kaprodiindex');
    // Route::get('/kaprodiindex', [KaprodiController::class, 'indexKaprodi'])->name('layouts.kaprodi');
    Route::get('/dosen', [KaprodiController::class, 'indexDosen'])->name('layouts.dosen');
    Route::post('/store-dosen', [KaprodiController::class, 'storeDosen'])->name('storedosen');
    Route::put('update-dosen/{d_id}', [KaprodiController::class, 'updateDosen'])->name('updatedosen');
    Route::delete('delete-dosen/{d_id}', [KaprodiController::class, 'destroyDosen'])->name('destroydosen');
    Route::get('/dosen-cari', [KaprodiController::class, 'cariNamaDosen'])->name('caridosen');
    // Route::post('/dosen/reset-password/{id}', [KaprodiController::class, 'resetPasswordDosen'])->name('reset-password-dosen');
    Route::put('/updateakun-dosen/{id_user}', [KaprodiController::class, 'updateAkun'])->name('updateakundosen');


    Route::get('/kelas', [KaprodiController::class, 'indexKelas'])->name('layouts.kelas');
    Route::post('/store-kelas', [KaprodiController::class, 'storeKelas'])->name('storekelas');
    Route::put('update-kelas/{id}', [KaprodiController::class, 'updateKelas'])->name('updatekelas');
    Route::delete('delete-kelas/{id}', [KaprodiController::class, 'destroyKelas'])->name('destroykelas');
    Route::get('/kelas-cari', [KaprodiController::class, 'cariNamaKelas'])->name('carikelas');

    // Rute untuk halaman plotting
    Route::get('/plotting', [KaprodiController::class, 'indexPlot'])->name('layouts.plotting');
    Route::get('/plotting-dosen', [KaprodiController::class, 'plotDosen'])->name('plottingdosen');
    Route::post('/plotting-updatedosen', [KaprodiController::class, 'updateKelasDosen'])->name('plottingupdatedosen');
    Route::delete('/plotting-destroydosen/{id}', [KaprodiController::class, 'destroyKelasDosen'])->name('plottingdestroydosen');
    Route::post('/plotting-updatemahasiswa', [KaprodiController::class, 'updateKelasMahasiswa'])->name('plottingupdatemahasiswa');
    Route::delete('/plotting-destroymahasiswa/{id}', [KaprodiController::class, 'destroyKelasMahasiswa'])->name('plottingdestroymahasiswa');

    //Mahasiswa
    Route::get('/mahasiswa-kaprodi', [KaprodiController::class, 'indexMahasiswa'])->name('index.mahasiswa');
    Route::post('/store-mahasiswa', [KaprodiController::class, 'storeMahasiswa'])->name('store.mahasiswa');
    Route::put('update-mahasiswa/{id}', [KaprodiController::class, 'updateMahasiswa'])->name('update.mahasiswa');
    Route::delete('delete-mahasiswa/{id}', [KaprodiController::class, 'destroyMahasiswa'])->name('destroy.mahasiswa');
    Route::get('/mahasiswa-cari', [KaprodiController::class, 'cariNamaMahasiswa'])->name('cari.mahasiswa');
    Route::put('/updateakun-mahasiswa/{id_user}', [KaprodiController::class, 'updateAkun'])->name('updateakunmahasiswa');
});

//dosen
Route::middleware(['auth', 'dosen'])->group(function () {
    Route::get('/dosen/{id}', [DosenController::class, 'indexdosen'])->name('dosen.show');
    Route::get('/vieweditrequests', [DosenController::class, 'viewEditrequests'])->name('dosen.show2');
    Route::post('/dosen/edit-request/{id}', [DosenController::class, 'updateEditRequest'])->name('dosen.updateEditRequest');
    Route::get('/mahasiswa/edit/{id}', [DosenController::class, 'edit'])->name('dosen.editmhs');
    Route::put('/mahasiswa/update/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/mahasiswa/destory/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
    Route::delete('/request/edit/{id}', [DosenController::class, 'hapusrequest'])->name('request.edit.destroy');
    Route::get('dosen/mahasiswa/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('mahasiswa/store/', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosenmahasiswa', [DosenController::class, 'mahasiswaindex'])->name('dosen.mahasiswa');
    Route::post('/dosen/approve/{id}', [DosenController::class, 'approveEditRequest'])->name('dosen.approveEditRequest');
    Route::get('dosen/edit/{id}', [DosenController::class, 'editdosen'])->name('dosen.editdosen');
    Route::put('dosen/update/{id}', [DosenController::class, 'updatedosen'])->name('dosen.updatedosen');
});
