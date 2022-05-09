<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MateriBelajarSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('mata_kuliah_sespimmen')->get();
        $gadik= DB::table('gadik_sespimmen')->get();
        $no = 1;
        return view('dashboard.sespimmen.materi_belajar.materi_belajar', [
            'title' => "Halaman Materi Belajar",
            'data' => $data,
            'gadik' => $gadik,
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
    public function store(Request $request, $id)
    {
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
        $tujuan_upload = public_path("admin/sespimmen/file_materi");
        $nama_file = time().$file->getClientOriginalName();
        // upload file
        $file->move($tujuan_upload, $nama_file);
        $insert = DB::table('materi_belajar_sespimmen')->insert([
            "judul" => $request->judul,
            "nama_gadik" => $request->nama_gadik,
            "id_mata_kuliah" => intval($id),
            "file" => $nama_file
        ]);
        if (!$insert) {
            return redirect('/materi_belajar_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/materi_belajar_sespimmen')->with([
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
        $data = DB::table('materi_belajar_sespimmen')->where('id_mata_kuliah', $id)->get();

        return response([$data, $id]);
    }

    public function lihat_detail($id)
    {
        $data = DB::table('materi_belajar_sespimmen')->where('id', $id)->get();

        return response($data);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $hapus = DB::table('materi_belajar_sespimmen')->whereIn('id', $request->id)->delete();

        if ($hapus) {
            return response('benar');
        } else {
            return response('error');
        }
    }
}
