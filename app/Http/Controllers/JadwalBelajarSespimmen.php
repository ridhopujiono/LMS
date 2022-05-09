<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalBelajarSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == "admin" || auth()->user()->level == "gadik") {

            $data = DB::table('jadwal_belajar_sespimmen')->get();
        } else {
            $serdik = DB::table('serdik_sespimmen')->where('username',  auth()->user()->username)->where('nama_serdik', auth()->user()->name)->first();
            $data = DB::table('jadwal_belajar_sespimmen')->where('id_pokjar', $serdik->pokjar)->get();
        }
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]->tanggal = Carbon::parse($data[$i]->tanggal)->format('d-m-Y');
            $data[$i]->start = Carbon::parse($data[$i]->start)->format('H:i');
            $data[$i]->end = Carbon::parse($data[$i]->end)->format('H:i');
        }
        $pokjar = DB::table('pokjar_sespimmen')->get();
        $gadik = DB::table('gadik_sespimmen')->get();
        $matkul = DB::table('mata_kuliah_sespimmen')->get();
        $metode = DB::table('metode_belajar_sespimmen')->get();
        $no = 1;
        return view('dashboard.sespimmen.jadwal.jadwal', [
            'title' => "Halaman Jadwal Belajar",
            'data' => $data,
            'pokjar' => $pokjar,
            'gadik' => $gadik,
            'matkul' => $matkul,
            'metode' => $metode,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hari = $request->hari;
        $tanggal = $request->tanggal;
        $mulai = $request->start;
        $akhir = $request->end;
        $id_metode = $request->id_metode;
        $id_mata_kuliah = $request->id_mata_kuliah;
        $tempat = $request->tempat;
        $deskripsi = $request->deskripsi;
        $pengampu = [
            "dosen_1" => intval($request->dosen_1),
            "dosen_2" => intval($request->dosen_2),
            "pawas_1" => intval($request->pawas_1),
            "pawas_2" => intval($request->pawas_2),
        ];
        $id_pokjar = $request->id_pokjar;

        $insert = DB::table('jadwal_belajar_sespimmen')->insert([
            "hari" => $hari,
            "tanggal" => $tanggal,
            "start" => $mulai,
            "end" => $akhir,
            "mata_kuliah" => $id_mata_kuliah,
            "metode" => $id_metode,
            "tempat" => $tempat,
            "deskripsi" => $deskripsi,
            "pengampu_sespimmen" => json_encode($pengampu),
            "id_pokjar" => $id_pokjar
        ]);
        if (!$insert) {
            return redirect('/jadwal_belajar_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/jadwal_belajar_sespimmen')->with([
                'success' => 'Data tersimpan!'
            ]);
        }
        // dd($request->all());
        // dd(json_decode(json_encode($pengampu)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $no = 1;
        $data = DB::table('jadwal_belajar_sespimmen')->where('id', $id)->first();
        $id_dosen = [];
        $key_dosen = [];
        for ($i = 0; $i < 1; $i++) {
            $id_dosen[$i] = array_values(json_decode($data->pengampu_sespimmen, true));
            $key_dosen[$i] = array_keys(json_decode($data->pengampu_sespimmen, true));
            $data->tanggal = Carbon::parse($data->tanggal)->format('d-m-Y');
            $data->start = Carbon::parse($data->start)->format('H:i');
            $data->end = Carbon::parse($data->end)->format('H:i');
        }


        $new_id_dosen = [];
        $new_key_dosen = [];

        for ($i = 0; $i < count(json_decode($data->pengampu_sespimmen, true)); $i++) {
            $new_id_dosen[$i] = $id_dosen[0][$i];
        }
        for ($i = 0; $i < count(json_decode($data->pengampu_sespimmen, true)); $i++) {
            $new_key_dosen[$i] = $key_dosen[0][$i];
        }

        $gadik = DB::table('gadik_sespimmen')->whereIn('id', $new_id_dosen)->get();
        // dd($new_id_dosen);

        for ($i = 0; $i < count($gadik); $i++) {
            $gadik[$i]->bagian = $new_key_dosen[$i];
        }

        // LIST SERDIK
        $serdik = DB::table('serdik_sespimmen')->where('pokjar', $data->id_pokjar)->get();

        // LIST POKJAR
        $pokjar = DB::table('pokjar_sespimmen')->where('id', $data->id_pokjar)->first();

        // LIST MATA KULIAH
        $matkul = DB::table('mata_kuliah_sespimmen')->where('id', $data->mata_kuliah)->first();

        // LIST MATA KULIAH
        $metode = DB::table('metode_belajar_sespimmen')->where('id', $data->metode)->first();

        // LIST ALL GADIK
        $list_all_gadik = DB::table('gadik_sespimmen')->get();

        // dd($gadik);

        return view('dashboard.sespimmen.jadwal.detail', [
            'title' => "Halaman Jadwal Belajar",
            'data' => $data,
            'pokjar' => $pokjar,
            'serdik' => $serdik,
            'gadik' => $gadik,
            'list_all_gadik' => $list_all_gadik,
            'matkul' => $matkul,
            'metode' => $metode,
            'no' => $no
        ]);
    }

    public function tambah_pengampu_sespimmen(Request $request, $id)
    {
        $data = DB::table('jadwal_belajar_sespimmen')->where('id', $id)->first();
        $array_key_pengampu = $request->status;
        $pengampu = json_decode($data->pengampu_sespimmen, true);
        // foreach ($pengampu as $p) {
        //     $p[$array_key_pengampu] = $request->nama_gadik;
        // }
        for ($i = 0; $i < count($pengampu); $i++) {
            $pengampu[$array_key_pengampu] = intval($request->nama_gadik);
        }

        $update = DB::table('jadwal_belajar_sespimmen')->where('id', $id)->update([
            "pengampu_sespimmen" => json_encode($pengampu)
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
