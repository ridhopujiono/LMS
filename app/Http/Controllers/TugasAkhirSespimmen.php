<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TugasAkhirSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == "serdik") {
            $pokjar_saya = DB::table('serdik_sespimmen')->where('username', auth()->user()->username)->first();

            // dd($pokjar_saya);
            $data = DB::table('tugas_akhir_sespimmen')->where('pokjar', $pokjar_saya->pokjar)->orWhere('pokjar', 0)->orderBy("created_at", "desc")->get();
        } else {
            $data = DB::table('tugas_akhir_sespimmen')->where('nama_gadik', auth()->user()->name)->orderBy("created_at", "desc")->get();
        }

        $no = 1;
        $matkul = DB::table('mata_kuliah_sespimmen')->get();
        $pokjar = DB::table('pokjar_sespimmen')->get();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]->deadline = Carbon::parse($data[$i]->deadline)->format('d-m-Y');
            $data[$i]->end = Carbon::parse($data[$i]->end)->format('H:i');
        }
        return view('dashboard.sespimmen.tugas_akhir.tugas_akhir', [
            'title' => "Halaman Tugas Akhir",
            'data' => $data,
            'pokjar' => $pokjar,
            'matkul' => $matkul,
            'no' => $no
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matkul = DB::table('mata_kuliah_sespimmen')->get();
        $pokjar = DB::table('pokjar_sespimmen')->get();
        return view('dashboard.sespimmen.tugas_akhir.tambah_tugas_akhir', [
            'title' => "Halaman Tugas Akhir",
            'matkul' => $matkul,
            'pokjar' => $pokjar,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if (auth()->user()->level == "gadik") {
            $id_matkul = $request->id_mata_kuliah;
            $id_gadik = auth()->user()->level;
            $data_gadik = DB::table('gadik_sespimmen')->where('username', auth()->user()->username)->first();
            $sifat_tujuan = $request->sifat_tujuan;
            $deadline = $request->deadline;
            $end = $request->end;
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');
            $tujuan_upload = public_path("admin/sespimmen/file_tugas_akhir");
            $nama_file = time() . $file->getClientOriginalName();
            // upload file
            $file->move($tujuan_upload, $nama_file);
            if ($sifat_tujuan == "all") {
                $insert = DB::table('tugas_akhir_sespimmen')->insert([
                    "id_matkul" => $id_matkul,
                    "id_gadik" => $data_gadik->id,
                    "nama_tugas" => $request->nama_tugas,
                    "nama_gadik" => $data_gadik->nama_gadik,
                    "file" => $nama_file,
                    "pokjar" => 0,
                    "deadline" => $deadline,
                    "end" => $end,
                    "created_at" => Carbon::now()
                ]);
                if (!$insert) {
                    return redirect('/tugas_akhir_sespimmen')->with([
                        'error' => "Kesalahan saat menyimpan data!"
                    ]);
                } else {
                    return redirect('/tugas_akhir_sespimmen')->with([
                        'success' => 'Data tersimpan!'
                    ]);
                }
            } else {
                return "bukan all";
            }
        }
    }


    public function detail_tugas_sespimmen($id)
    {
        $data = DB::table('tugas_akhir_sespimmen')->where('id', $id)->first();
        if ($data->pokjar == 0) {
            $pengupload = DB::table('upload_tugas_akhir_sespimmen')->where('id_tugas', $id)->get();

            $matkul = DB::table('mata_kuliah_sespimmen')->get();
            for ($i = 0; $i < 1; $i++) {
                $data->deadline = Carbon::parse($data->deadline)->format('d-m-Y');
                $data->end = Carbon::parse($data->end)->format('H:i');
            }

            for ($i = 0; $i < count($pengupload); $i++) {
                $pengupload[$i]->created_at = Carbon::parse($pengupload[$i]->created_at)->format('d-m-Y H:i');
            }
            // dd($pengupload);
            return view('dashboard.sespimmen.tugas_akhir.detail_tugas_akhir', [
                'title' => "Halaman Detail Tugas Belajar",
                "data" => $data,
                "pokjar" => [],
                "data_pokjar" => DB::table('pokjar_sespimmen')->get(),
                "data_serdik" => DB::table('serdik_sespimmen')->get(),
                "pengupload" => $pengupload
            ]);
        } else {
            $pengupload = DB::table('upload_tugas_akhir_sespimmen')->where('id_tugas', $id)->orderBy("id", "desc")->get();

            for ($i = 0; $i < count($pengupload); $i++) {
                $pengupload[$i]->created_at = Carbon::parse($pengupload[$i]->created_at)->format('d-m-Y H:i');
            }
            $matkul = DB::table('mata_kuliah_sespimmen')->get();
            $pokjar = DB::table('pokjar_sespimmen')->get();
            for ($i = 0; $i < 1; $i++) {
                $data->deadline = Carbon::parse($data->deadline)->format('d-m-Y');
                $data->end = Carbon::parse($data->end)->format('H:i');
            }
            return view('dashboard.sespimmen.tugas_akhir.detail_tugas_akhir', [
                'title' => "Halaman Detail Tugas Belajar",
                "data" => $data,
                "pokjar" => $pokjar,
                "data_pokjar" => DB::table('pokjar_sespimmen')->get(),
                "data_serdik" => DB::table('serdik_sespimmen')->get(),
                "pengupload" => $pengupload
            ]);
        }
    }


    public function upload_tugas_sespimmen($id)
    {
        $cek_serdik = DB::table('serdik_sespimmen')->where('username', auth()->user()->username)->first();
        $upload = DB::table('upload_tugas_akhir_sespimmen')->where('id_tugas', $id)->where('id_serdik', $cek_serdik->id)->first();
        if (empty($upload)) {
            $data = DB::table('tugas_akhir_sespimmen')->where('id', $id)->first();
            $matkul = DB::table('mata_kuliah_sespimmen')->get();
            $pokjar = DB::table('pokjar_sespimmen')->get();
            $gadik = DB::table('gadik_sespimmen')->get();
            for ($i = 0; $i < 1; $i++) {
                $data->deadline = Carbon::parse($data->deadline)->format('d-m-Y');
                $data->created_at = Carbon::parse($data->created_at)->format('d-m-Y');
                $data->end = Carbon::parse($data->end)->format('H:i');
            }
            // dd($data);
            return view('dashboard.sespimmen.tugas_akhir.upload_tugas_akhir', [
                'title' => "Halaman upload Tugas Akhir",
                "data" => $data,
                "pokjar" => $pokjar,
                "matkul" => $matkul,
                "gadik" => $gadik,
                "status_upload" => 0
            ]);
        } else {
            $data = DB::table('tugas_akhir_sespimmen')->where('id', $id)->first();
            $matkul = DB::table('mata_kuliah_sespimmen')->get();
            $pokjar = DB::table('pokjar_sespimmen')->get();
            $gadik = DB::table('gadik_sespimmen')->get();
            for ($i = 0; $i < 1; $i++) {
                $data->deadline = Carbon::parse($data->deadline)->format('d-m-Y');
                $data->created_at = Carbon::parse($data->created_at)->format('d-m-Y');
                $data->end = Carbon::parse($data->end)->format('H:i');
            }
            // dd($data);
            return view('dashboard.sespimmen.tugas_akhir.upload_tugas_akhir', [
                'title' => "Halaman upload Tugas Akhir",
                "data" => $data,
                "pokjar" => $pokjar,
                "matkul" => $matkul,
                "gadik" => $gadik,
                "status_upload" => 1
            ]);
        }
    }


    public function upload_tugas_akhir_sespimmen(Request $request, $id)
    {
        if (auth()->user()->level == "serdik") {
            // menyimpan data file yang diupload ke variabel $file
            // dd($request->all());
            $file = $request->file('file_upload');
            $tujuan_upload = public_path("admin/sespimmen/file_upload_tugas_akhir");
            $nama_file = time() . $file->getClientOriginalName();
            // upload file
            $file->move($tujuan_upload, $nama_file);

            $data_serdik = DB::table('serdik_sespimmen')->where('username', auth()->user()->username)->first();
            $id_pokjar = intval($data_serdik->pokjar);
            $id_serdik = $data_serdik->id;
            $nama_serdik = $data_serdik->nama_serdik;
            $no_serdik = $data_serdik->no_serdik;

            $insert = DB::table('upload_tugas_akhir_sespimmen')->insert([
                "id_tugas" => $id,
                "id_serdik" => $id_serdik,
                "nama_serdik" => $nama_serdik,
                "no_serdik" => $no_serdik,
                "pokjar" => $id_pokjar,
                "file" => $nama_file,
                "nilai" => 0,
                "created_at" => Carbon::now()
            ]);
            if (!$insert) {
                return redirect('/tugas_akhir_sespimmen')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {
                return redirect('/tugas_akhir_sespimmen')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        }
    }

    public function post_nilai_tugas_akhir(Request $request, $id)
    {
        $update = DB::table('upload_tugas_akhir_sespimmen')->where('id', $id)->update([
            "nilai" => intval($request->nilai)
        ]);

        return redirect()->back();
    }
}
