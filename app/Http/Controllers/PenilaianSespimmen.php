<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        return view('dashboard.sespimmen.penilaian.index', [
            'title' => "Halaman Penilaian"
        ]);
    }

    public function penilaian()
    {
        $pokjar = DB::table('pokjar_sespimmen')->get();
        $data = DB::table('serdik_sespimmen')->orderBy('nama_serdik')->get();
        $no = 1;
        return view('dashboard.sespimmen.penilaian.penilaian', [
            'title' => "Halaman Penilaian",
            'data' => $data,
            'pokjar' => $pokjar,
            'pokjar_aktif' => [],
            'no' => $no
        ]);
    }
    public function lihat_penilaian()
    {
        $pokjar = DB::table('pokjar_sespimmen')->get();
        $data = DB::table('rekap_penilaian_sespimmen')->get();
        // dd($data);
        foreach ($data as $d) {
            $d->rata_rata = $d->nilai / $d->total_matkul;
        }

        $data = collect($data)->sortByDesc('rata_rata')->toArray();

        // dd($data);
        $no = 1;
        return view('dashboard.sespimmen.penilaian.lihat_penilaian', [
            'title' => "Halaman Penilaian",
            'data' => $data,
            'pokjar' => $pokjar,
            'pokjar_aktif' => [],
            'no' => $no
        ]);
    }


    public function penilaian_sespimmen(Request $request)
    {
        $pokjar = DB::table('pokjar_sespimmen')->get();
        if (!empty($request->pokjar)) {
            if ($request->pokjar == "0") {
                $data = DB::table('serdik_sespimmen')->orderBy('nama_serdik', "asc")->get();
            } else {
                $data = DB::table('serdik_sespimmen')->where('pokjar', $request->pokjar)->orderBy('nama_serdik', "asc")->get();
            }
        } else {
            $data = DB::table('serdik_sespimmen')->orderBy('nama_serdik', "asc")->get();
        }

        if (!empty($request->pokjar)) {
            $no = 1;
            return view('dashboard.sespimmen.penilaian.penilaian', [
                'title' => "Halaman Penilaian",
                'data' => $data,
                'pokjar' => $pokjar,
                'pokjar_aktif' => $request->pokjar,
                'no' => $no
            ]);
        } else {
            $no = 1;
            return view('dashboard.sespimmen.penilaian.penilaian', [
                'title' => "Halaman Penilaian",
                'data' => $data,
                'pokjar' => $pokjar,
                'pokjar_aktif' => [],
                'no' => $no
            ]);
        }
    }

    public function list_matkul_serdik($id)
    {
        $no = 1;
        $data = DB::table('mata_kuliah_sespimmen')->get();
        return view('dashboard.sespimmen.penilaian.mata_kuliah', [
            'title' => "Halaman Penilaian",
            'data' => $data,
            'id_serdik' => $id,
            'no' => $no
        ]);
    }


    public function detail_tugas_serdik($id_matkul, $id_serdik)
    {
        $no = 1;
        $list_id_tugas = [];
        $list_id_tugas_akhir = [];

        $matkul = DB::table('mata_kuliah_sespimmen')->where('id', $id_matkul)->first();

        $tugas_belajar = DB::table('tugas_belajar_sespimmen')->where('id_matkul', $id_matkul)->get();

        $tugas_akhir = DB::table('tugas_akhir_sespimmen')->where('id_matkul', $id_matkul)->get();

        // dd($tugas_akhir);

        foreach ($tugas_belajar as $tb) {
            $list_id_tugas[] = $tb->id;
        }
        foreach ($tugas_akhir as $ta) {
            $list_id_tugas_akhir[] = $ta->id;
        }
        $upload_tugas_belajar_serdik = DB::table('upload_tugas_belajar_sespimmen')->whereIn('id_tugas', $list_id_tugas)->where('id_serdik', $id_serdik)->get();
        $upload_tugas_akhir_serdik = DB::table('upload_tugas_akhir_sespimmen')->whereIn('id_tugas', $list_id_tugas_akhir)->where('id_serdik', $id_serdik)->get();

        $total_nilai_tugas_belajar = 0;
        for ($i = 0; $i < count($tugas_belajar); $i++) {
            if (empty($upload_tugas_belajar_serdik[$i]->nilai)) {
                $tugas_belajar[$i]->nilai = 0;
            } else {
                $tugas_belajar[$i]->nilai = $upload_tugas_belajar_serdik[$i]->nilai;
            }
        }
        // Rata rata 1
        for ($i = 0; $i < count($tugas_belajar); $i++) {
            $total_nilai_tugas_belajar += $tugas_belajar[$i]->nilai;
        }

        if (count($tugas_belajar) == 0) {
            $rata_rata_tugas_belajar = $total_nilai_tugas_belajar / 1;
        } else {
            $rata_rata_tugas_belajar = $total_nilai_tugas_belajar / count($tugas_belajar);
        }

        //

        $total_nilai_tugas_akhir = 0;
        for ($i = 0; $i < count($tugas_akhir); $i++) {
            if (empty($upload_tugas_akhir_serdik[$i]->nilai)) {
                $tugas_akhir[$i]->nilai = 0;
            } else {
                $tugas_akhir[$i]->nilai = $upload_tugas_akhir_serdik[$i]->nilai;
            }
        }

        // Rata rata 2
        for ($i = 0; $i < count($tugas_akhir); $i++) {
            $total_nilai_tugas_akhir += $tugas_akhir[$i]->nilai;
        }
        if (count($tugas_akhir) == 0) {
            $rata_rata_tugas_akhir = $total_nilai_tugas_akhir / 1;
        } else {
            $rata_rata_tugas_akhir = $total_nilai_tugas_akhir / count($tugas_akhir);
        }
        //

        $init_count =  count($tugas_akhir) + count($tugas_belajar);
        $init_nilai = $total_nilai_tugas_akhir + $total_nilai_tugas_belajar;

        if ($init_count == 0) {
            $rata_rata3 = $init_nilai / 1;
        } else {
            $rata_rata3 = $init_nilai / $init_count;
        }


        $serdik = DB::table('serdik_sespimmen')->where('id', $id_serdik)->first();

        $pokjar = DB::table('pokjar_sespimmen')->get();

        return view('dashboard.sespimmen.penilaian.detail_tugas', [
            'title' => "Halaman Penilaian",
            'id_serdik' => $id_serdik,
            'id_matkul' => $id_matkul,
            'data' => $tugas_belajar,
            'data2' => $tugas_akhir,
            'matkul' => $matkul,
            'serdik' => $serdik,
            'pokjar' => $pokjar,
            'id_serdik' => $id_serdik,
            'no' => $no,
            'rata_rata' => $rata_rata_tugas_belajar,
            'rata_rata2' => $rata_rata_tugas_akhir,
            'rata_rata3' => round($rata_rata3, 2),
        ]);
    }


    public function input_penilaian(Request $request, $id_matkul, $id_serdik)
    {
        $serdik = DB::table('serdik_sespimmen')->where('id', $id_serdik)->first();
        $matkul = DB::table('mata_kuliah_sespimmen')->where('id', $id_matkul)->first();
        $insert = DB::table('penilaian_sespimmen')->insert([
            "id_serdik" => $id_serdik,
            "nama_serdik" => $serdik->nama_serdik,
            "id_pokjar" => $serdik->pokjar,
            "id_matkul" => $id_matkul,
            "nama_matkul" => $matkul->nama_mata_kuliah,
            "nilai" => $request->nilai
        ]);
        if (!$insert) {
            return redirect('/penilaian_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            $check_rekap = DB::table('rekap_penilaian_sespimmen')->where('id_serdik', $id_serdik)->first();

            if (empty($check_rekap)) {
                $insert_to_rekap = DB::table('rekap_penilaian_sespimmen')->insert([
                    "id_serdik" => $id_serdik,
                    "nama_serdik" => $serdik->nama_serdik,
                    "id_pokjar" => $serdik->pokjar,
                    "total_matkul" => 1,
                    "nilai" => $request->nilai
                ]);
                if ($insert_to_rekap) {
                    return redirect('/penilaian_sespimmen')->with([
                        'success' => 'Data tersimpan!'
                    ]);
                } else {
                    return redirect('/penilaian_sespimmen')->with([
                        'error' => 'Data tidak tersimpan!'
                    ]);
                }
            } else {
                $total_matkul = $check_rekap->total_matkul;
                $total_nilai = $check_rekap->nilai;
                $update_rekap = DB::table('rekap_penilaian_sespimmen')->where('id_serdik', $id_serdik)->update([
                    "total_matkul" => $total_matkul + 1,
                    "nilai" => $total_nilai + round($request->nilai, 2)
                ]);
                if ($update_rekap) {
                    return redirect('/penilaian_sespimmen')->with([
                        'success' => 'Data tersimpan!'
                    ]);
                } else {
                    return redirect('/penilaian_sespimmen')->with([
                        'error' => 'Data tidak tersimpan!'
                    ]);
                }
            }
        }
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
