<?php
date_default_timezone_set('Asia/Jakarta');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardSespimmenController;
use App\Http\Controllers\DashboardSerdikSespimmenController;
use App\Http\Controllers\DashboardPokjarSespimmenController;
use App\Http\Controllers\DashboardAgendaSespimmen;
use App\Http\Controllers\DashboardKurikulumSespimmen;
use App\Http\Controllers\PesanSesmpimmen;
use App\Http\Controllers\MataKuliahSespimmen;
use App\Http\Controllers\MateriBelajarSespimmen;
use App\Http\Controllers\JadwalBelajarSespimmen;
use App\Http\Controllers\TugasBelajarSespimmen;
use App\Http\Controllers\TugasAkhirSespimmen;
use App\Http\Controllers\KelasVirtualSespimmen;
use App\Http\Controllers\SopSespimmen;
use App\Http\Controllers\BimbinganSespimmen;
use App\Http\Controllers\PenilaianSespimmen;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/tentang', [AuthController::class, 'tentang']);
Route::get('/bagian/sespimmen', [AuthController::class, 'sespimmen']);
Route::get('/bagian/sespimma', [AuthController::class, 'sespimma']);
Route::get('/bagian/sespimmti', [AuthController::class, 'sespimmti']);
Route::get('/sop', [AuthController::class, 'sop']);
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/sespimmen', [AuthController::class, 'dashboard_sespimmen'])->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Dashboard
//  -Sespimmen
//    -Gadik
Route::get('/gadik', [DashboardSespimmenController::class, 'gadik'])->middleware('auth');
Route::get('/tambah_gadik_sespimmen', [DashboardSespimmenController::class, 'tambah_gadik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::get('/edit_gadik_sespimmen/{id}', [DashboardSespimmenController::class, 'edit_gadik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('/post_gadik_sespimmen', [DashboardSespimmenController::class, 'post_gadik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('/update_gadik_sespimmen', [DashboardSespimmenController::class, 'update_gadik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('/hapus_gadik_sespimmen', [DashboardSespimmenController::class, 'hapus_gadik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('/detail_gadik_sespimmen', [DashboardSespimmenController::class, 'detail_gadik_sespimmen'])->middleware('auth');

// Serdik
Route::get('serdik_sespimmen', [DashboardSerdikSespimmenController::class, 'index'])->middleware('auth');
Route::get('tambah_serdik_sespimmen', [DashboardSerdikSespimmenController::class, 'tambah_serdik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('post_serdik_sespimmen', [DashboardSerdikSespimmenController::class, 'post_serdik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::get('/edit_serdik_sespimmen/{id}', [DashboardSerdikSespimmenController::class, 'edit_serdik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('/update_serdik_sespimmen', [DashboardSerdikSespimmenController::class, 'update_serdik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('/hapus_serdik_sespimmen', [DashboardSerdikSespimmenController::class, 'hapus_serdik_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('/detail_serdik_sespimmen', [DashboardSerdikSespimmenController::class, 'detail_serdik_sespimmen'])->middleware('auth');

//Pokjar
Route::get('pokjar_sespimmen', [DashboardPokjarSespimmenController::class, 'index'])->middleware('auth');
Route::get('list_serdik_pokjar_sespimmen/{id}', [DashboardPokjarSespimmenController::class, 'list_serdik_pokjar_sespimmen'])->middleware('auth');
Route::post('post_pokjar_sespimmen', [DashboardPokjarSespimmenController::class, 'post_pokjar_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('edit_pokjar_sespimmen', [DashboardPokjarSespimmenController::class, 'edit_pokjar_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('update_pokjar_sespimmen', [DashboardPokjarSespimmenController::class, 'update_pokjar_sespimmen'])->middleware(['auth', 'is_admin']);
Route::post('hapus_pokjar_sespimmen', [DashboardPokjarSespimmenController::class, 'hapus_pokjar_sespimmen'])->middleware(['auth', 'is_admin']);

//Agenda
Route::get('/agenda_sespimmen', [DashboardAgendaSespimmen::class, 'agenda_sespimmen'])->middleware('auth');
Route::get('/geteventsespimmen', [DashboardAgendaSespimmen::class, 'getEvent'])->middleware('auth');
Route::post('/createeventsespimmen', [DashboardAgendaSespimmen::class, 'createEvent'])->middleware(['auth', 'is_admin']);
Route::post('/deleteeventsespimmen', [DashboardAgendaSespimmen::class, 'deleteEvent'])->middleware(['auth', 'is_admin']);

//Kurikulum
Route::get('/kurikulum_sespimmen', [DashboardKurikulumSespimmen::class, 'index'])->middleware('auth');
Route::get('/tambah_kurikulum_sespimmen', [DashboardKurikulumSespimmen::class, 'create'])->middleware(['auth', 'is_admin']);
Route::get('/edit_kurikulum_sespimmen/{id}', [DashboardKurikulumSespimmen::class, 'edit'])->middleware(['auth', 'is_admin']);
Route::post('/post_kurikulum_sespimmen', [DashboardKurikulumSespimmen::class, 'post'])->middleware(['auth', 'is_admin']);
Route::post('/update_kurikulum_sespimmen', [DashboardKurikulumSespimmen::class, 'update'])->middleware(['auth', 'is_admin']);
Route::post('/hapus_kurikulum_sespimmen', [DashboardKurikulumSespimmen::class, 'destroy'])->middleware(['auth', 'is_admin']);


//Pesan
Route::get('/lihat_pesan_sespimmen', [PesanSesmpimmen::class, 'index'])->middleware('auth');
Route::get('/detail_pesan_sespimmen/{id}', [PesanSesmpimmen::class, 'detail_pesan_sespimmen'])->middleware('auth');
Route::post('/post_pesan_sespimmen', [PesanSesmpimmen::class, 'post_pesan_sespimmen'])->middleware('auth');
Route::get('/kirim_pesan_sespimmen', [PesanSesmpimmen::class, 'kirim_pesan_sespimmen'])->middleware('auth');
Route::get('/get_gadik_from_pesan_sespimmen', [PesanSesmpimmen::class, 'get_gadik_from_pesan_sespimmen'])->middleware('auth');
Route::get('/get_serdik_from_pesan_sespimmen', [PesanSesmpimmen::class, 'get_serdik_from_pesan_sespimmen'])->middleware('auth');


//Mata Kuliah Sespimmen
Route::get('/mata_kuliah_sespimmen', [MataKuliahSespimmen::class, 'index'])->middleware('auth');
Route::post('/post_mata_kuliah_sespimmen', [MataKuliahSespimmen::class, 'store'])->middleware(['auth', 'is_admin']);
Route::post('/edit_mata_kuliah_sespimmen', [MataKuliahSespimmen::class, 'edit'])->middleware(['auth', 'is_admin']);
Route::post('/update_mata_kuliah_sespimmen', [MataKuliahSespimmen::class, 'update'])->middleware(['auth', 'is_admin']);
Route::post('/hapus_mata_kuliah_sespimmen', [MataKuliahSespimmen::class, 'destroy'])->middleware(['auth', 'is_admin']);

//Materi Belajar
Route::get('/materi_belajar_sespimmen', [MateriBelajarSespimmen::class, 'index'])->middleware('auth');
Route::get('/lihat_materi_sespimmen/{id}', [MateriBelajarSespimmen::class, 'show'])->middleware('auth');
Route::post('/add_materi_sespimmen/{id}', [MateriBelajarSespimmen::class, 'store'])->middleware('auth');
Route::post('/lihat_detail_materi/{id}', [MateriBelajarSespimmen::class, 'lihat_detail'])->middleware('auth');
Route::post('/hapus_materi_belajar_sespimmen', [MateriBelajarSespimmen::class, 'destroy'])->middleware('auth');

//  Jadwal Kuliah Sespimmen
Route::get('/jadwal_belajar_sespimmen', [JadwalBelajarSespimmen::class, 'index'])->middleware('auth');
Route::get('/detail_jadwal_belajar_sespimmen/{id}', [JadwalBelajarSespimmen::class, 'show'])->middleware('auth');
Route::post('/post_jadwal_belajar_sespimmen', [JadwalBelajarSespimmen::class, 'store'])->middleware(['auth', 'is_admin']);
Route::post('/tambah_pengampu_sespimmen/{id}', [JadwalBelajarSespimmen::class, 'tambah_pengampu_sespimmen'])->middleware(['auth', 'is_admin']);

// Tugas Belajar
Route::get('/tugas_belajar_sespimmen', [TugasBelajarSespimmen::class, 'index'])->middleware('auth');
Route::get('/tambah_tugas_sespimmen', [TugasBelajarSespimmen::class, 'create'])->middleware(['auth', 'is_admin_is_gadik']);
Route::get('/detail_tugas_sespimmen/{id}', [TugasBelajarSespimmen::class, 'detail_tugas_sespimmen'])->middleware('auth');
//serdik
Route::get('/upload_tugas_sespimmen/{id}', [TugasBelajarSespimmen::class, 'upload_tugas_sespimmen'])->middleware('auth');
Route::post('/upload_tugas_belajar_sespimmen/{id}', [TugasBelajarSespimmen::class, 'upload_tugas_belajar_sespimmen'])->middleware('auth');
//end serdik
Route::post('/post_tugas_belajar_sespimmen', [TugasBelajarSespimmen::class, 'store'])->middleware('auth');
Route::post('/post_nilai_tugas_belajar/{id}', [TugasBelajarSespimmen::class, 'post_nilai_tugas_belajar'])->middleware(['auth', 'is_admin_is_gadik']);


//Tugas akhir
Route::get('/tugas_akhir_sespimmen', [TugasAkhirSespimmen::class, 'index'])->middleware('auth');
Route::get('/tambah_tugas_akhir_sespimmen', [TugasAkhirSespimmen::class, 'create'])->middleware(['auth', 'is_admin_is_gadik']);
Route::get('/detail_tugas_akhir_sespimmen/{id}', [TugasAkhirSespimmen::class, 'detail_tugas_sespimmen'])->middleware('auth');
//serdik
Route::get('/upload_tugas_akhir_sespimmen/{id}', [TugasAkhirSespimmen::class, 'upload_tugas_sespimmen'])->middleware('auth');
Route::post('/upload_tugas_akhir_sespimmen/{id}', [TugasAkhirSespimmen::class, 'upload_tugas_akhir_sespimmen'])->middleware('auth');
//end serdik
Route::post('/post_tugas_akhir_sespimmen', [TugasAkhirSespimmen::class, 'store'])->middleware('auth');
Route::post('/post_nilai_tugas_akhir/{id}', [TugasAkhirSespimmen::class, 'post_nilai_tugas_akhir'])->middleware(['auth', 'is_admin_is_gadik']);



// Kelas Virtual
Route::get('/kelas_virtual_sespimmen', [KelasVirtualSespimmen::class, 'index'])->middleware('auth');
Route::post('/post_kelas_virtual_sespimmen', [KelasVirtualSespimmen::class, 'store'])->middleware(['auth', 'is_admin']);
Route::post('/edit_kelas_virtual_sespimmen', [KelasVirtualSespimmen::class, 'edit'])->middleware(['auth', 'is_admin']);
Route::post('/update_kelas_virtual_sespimmen', [KelasVirtualSespimmen::class, 'update'])->middleware(['auth', 'is_admin']);
Route::post('/hapus_kelas_virtual_sespimmen', [KelasVirtualSespimmen::class, 'destroy'])->middleware(['auth', 'is_admin']);

// SOP
Route::get('/sop_sespimmen', [SopSespimmen::class, 'index'])->middleware('auth');
Route::post('/post_sop_sespimmen', [SopSespimmen::class, 'store'])->middleware(['auth', 'is_admin']);
Route::post('/edit_sop_sespimmen', [SopSespimmen::class, 'edit'])->middleware(['auth', 'is_admin']);
Route::post('/update_sop_sespimmen', [SopSespimmen::class, 'update'])->middleware(['auth', 'is_admin']);
Route::post('/hapus_sop_sespimmen', [SopSespimmen::class, 'destroy'])->middleware(['auth', 'is_admin']);

// Bimbingan
Route::get('/bimbingan_sespimmen', [BimbinganSespimmen::class, 'index'])->middleware('auth');
Route::post('/bimbingan_sespimmen', [BimbinganSespimmen::class, 'index'])->middleware('auth');
Route::get('/list_lengkap_gadik', [BimbinganSespimmen::class, 'list_lengkap_gadik'])->middleware('auth');
Route::post('/post_bimbingan_sespimmen', [BimbinganSespimmen::class, 'store'])->middleware('auth');
Route::post('/post_edit_no_telp/{id}', [BimbinganSespimmen::class, 'post_edit_no_telp'])->middleware('auth');

// Penilaian
Route::get('/index_penilaian_sespimmen', [PenilaianSespimmen::class, 'index'])->middleware('auth');
Route::get('/penilaian_sespimmen', [PenilaianSespimmen::class, 'penilaian'])->middleware('auth');
Route::get('/lihat_penilaian_sespimmen', [PenilaianSespimmen::class, 'lihat_penilaian'])->middleware('auth');
Route::get('/list_matkul_serdik/{id}', [PenilaianSespimmen::class, 'list_matkul_serdik'])->middleware('auth');
Route::get('/detail_tugas_serdik/{id_matkul}/{id_serdik}', [PenilaianSespimmen::class, 'detail_tugas_serdik'])->middleware('auth');
Route::post('/penilaian_sespimmen', [PenilaianSespimmen::class, 'penilaian_sespimmen'])->middleware('auth');
Route::post('/input_penilaian/{id_matkul}/{id_serdik}', [PenilaianSespimmen::class, 'input_penilaian'])->middleware('auth');
