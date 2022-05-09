<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataKuliahSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('mata_kuliah_sespimmen')->get();
        $no = 1;
        return view('dashboard.sespimmen.mata_kuliah.mata_kuliah', [
            'title' => "Halaman Mata Kuliah",
            'data' => $data,
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
        $insert = DB::table('mata_kuliah_sespimmen')->insert([
            "kode_mata_kuliah" => $request->kode_mata_kuliah,
            "nama_mata_kuliah" => $request->nama_mata_kuliah,
            "jp" => $request->jp,
        ]);

        if (!$insert) {
            return redirect('/mata_kuliah_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/mata_kuliah_sespimmen')->with([
                'success' => 'Data tersimpan!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = DB::table('mata_kuliah_sespimmen')->whereIn('id', $request->id)->get();

        return response($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $kode_mata_kuliah = $request->kode_mata_kuliah;
        $nama_mata_kuliah = $request->nama_mata_kuliah;
        $jp = $request->jp;
        $id = $request->id;
        for ($i = 0; $i < count($kode_mata_kuliah); $i++) {
            DB::table('mata_kuliah_sespimmen')->where('id', $id[$i])->update([
                "kode_mata_kuliah" => $kode_mata_kuliah[$i],
                "nama_mata_kuliah" => $nama_mata_kuliah[$i],
                "jp" => $jp[$i]
            ]);
        }
        return redirect('/mata_kuliah_sespimmen')->with([
            'success' => 'Data tersimpan!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $hapus = DB::table('mata_kuliah_sespimmen')->whereIn('id', $request->id)->delete();

        if ($hapus) {
            return response('benar');
        } else {
            return response('error');
        }
    }
}
