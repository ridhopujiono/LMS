<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SopSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('sop_sespimmen')->get();
        $no = 1;
        return view('dashboard.sespimmen.sop.sop', [
            'title' => "Halaman Tugas Belajar",
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
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
        $tujuan_upload = public_path("admin/sespimmen/file_sop");
        $nama_file = time() . $file->getClientOriginalName();
        // upload file
        $file->move($tujuan_upload, $nama_file);
        $insert = DB::table('sop_sespimmen')->insert([
            "judul" => $request->judul,
            "file" => $nama_file,
        ]);

        if (!$insert) {
            return redirect('/sop_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/sop_sespimmen')->with([
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
        $data = DB::table('sop_sespimmen')->where('id', $request->id)->get();

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
        // dd($request->all());
        if ($request->file('file') == NULL) {
            $update = DB::table('sop_sespimmen')->where('id', $request->id)->update([
                "judul" => $request->judul,
            ]);
        } else {
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');
            $tujuan_upload = public_path("admin/sespimmen/file_sop");
            $nama_file = time() . $file->getClientOriginalName();
            // upload file
            $file->move($tujuan_upload, $nama_file);
            $update = DB::table('sop_sespimmen')->where('id', $request->id)->update([
                "judul" => $request->judul,
                "file" => $nama_file,
            ]);
        }


        if (!$update) {
            return redirect('/sop_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/sop_sespimmen')->with([
                'success' => 'Data tersimpan!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $hapus = DB::table('sop_sespimmen')->where('id', $request->id)->delete();

        if ($hapus) {
            return response('benar');
        } else {
            return response('error');
        }
    }
}
