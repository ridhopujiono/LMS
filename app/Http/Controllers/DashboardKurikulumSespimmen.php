<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardKurikulumSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('kurikulum_sespimmen')->get();
        $no = 1;
        return view('dashboard.sespimmen.kurikulum.kurikulum', [
            'title' => "Halaman Kurikulum",
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
        return view('dashboard.sespimmen.kurikulum.tambah_kurikulum', [
            'title' => "Halaman Kurikulum | Tambah Kurikulum",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
        $tujuan_upload = public_path("admin/sespimmen/file_kurikulum");
        $nama_file = time().$file->getClientOriginalName();
        // upload file
        $file->move($tujuan_upload, $nama_file);
        $insert = DB::table('kurikulum_sespimmen')->insert([
            "judul"=>$request->judul,
            "keterangan"=>$request->keterangan,
            "file"=>$nama_file,
        ]);

        if (!$insert) {
            return redirect('/kurikulum_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/kurikulum_sespimmen')->with([
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
    public function edit($id)
    {
        return view('dashboard.sespimmen.kurikulum.edit_kurikulum', [
            'data' => DB::table('kurikulum_sespimmen')->where('id', $id)->get(),
            'title' => "Halaman Kurikulum | Edit Kurikulum",
        ]);
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
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
        $tujuan_upload = public_path("admin/sespimmen/file_kurikulum");
        $nama_file = time().$file->getClientOriginalName();
        // upload file
        $file->move($tujuan_upload, $nama_file);
        $update = DB::table('kurikulum_sespimmen')->where('id', $request->id)->update([
            "judul"=>$request->judul,
            "keterangan"=>$request->keterangan,
            "file"=>$nama_file,
        ]);

        if (!$update) {
            return redirect('/kurikulum_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/kurikulum_sespimmen')->with([
                'success' => 'Data tersimpan!'
            ]);
        }
    }

    
    public function destroy(Request $request)
    {
        $hapus = DB::table('kurikulum_sespimmen')->whereIn('id', $request->id)->delete();

        if ($hapus) {
            return response('benar');
        } else {
            return response('error');
        }
    }
}
