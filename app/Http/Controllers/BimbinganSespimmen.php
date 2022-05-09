<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BimbinganSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!empty($request->pokjar)) {
            if ($request->pokjar == "0") {
                $data = DB::table('bimbingan_sespimmen')->orderBy('created_at', "desc")->paginate(2);
            } else {
                $data = DB::table('bimbingan_sespimmen')->where('id_pokjar', $request->pokjar)->orderBy('created_at', "desc")->paginate(2);
            }
        } else {
            $data = DB::table('bimbingan_sespimmen')->orderBy('created_at', "desc")->paginate(2);
        }

        if (auth()->user()->level != "gadik") {

            $gadik = DB::table('gadik_sespimmen')->orderBy('created_at', "desc")->whereNotNull('no_telp')->limit(10)->get();
        } else {
            $gadik = DB::table('gadik_sespimmen')->where('username', auth()->user()->username)->first();
        }

        foreach ($data as $d) {
            $d->created_at = Carbon::parse($d->created_at)->format('d-m-Y H:i');
        }
        $pokjar = DB::table('pokjar_sespimmen')->get();

        if (!empty($request->pokjar)) {
            return view('dashboard.sespimmen.bimbingan.bimbingan', [
                'title' => "Halaman Bimbingan",
                "pj" => $pokjar,
                "data" => $data,
                "gadik" => $gadik,
                "pokjar_aktif" => $request->pokjar,
            ]);
        } else {
            return view('dashboard.sespimmen.bimbingan.bimbingan', [
                'title' => "Halaman Bimbingan",
                "pj" => $pokjar,
                "data" => $data,
                "gadik" => $gadik,
                "pokjar_aktif" => [],
            ]);
        }
    }

    public function list_lengkap_gadik()
    {
        $gadik = DB::table('gadik_sespimmen')->orderBy('created_at', "desc")->get();

        return view('dashboard.sespimmen.bimbingan.list_no_bimbingan', [
            'title' => "Halaman Bimbingan",
            "gadik" => $gadik
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
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
        $tujuan_upload = public_path("admin/sespimmen/file_bimbingan");
        $nama_file = time() . $file->getClientOriginalName();
        // upload file
        $file->move($tujuan_upload, $nama_file);

        $serdik = DB::table('serdik_sespimmen')->where('username', auth()->user()->username)->first();
        // dd($serdik);
        $insert = DB::table('bimbingan_sespimmen')->insert([
            "judul_kegiatan" => $request->judul,
            "deskripsi_kegiatan" => $request->deskripsi,
            "id_serdik" => intval($serdik->id),
            "id_pokjar" => intval($serdik->pokjar),
            "nama_serdik" => $serdik->nama_serdik,
            "created_at" => Carbon::now(),
            "file" => $nama_file
        ]);
        if (!$insert) {
            return redirect('/bimbingan_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/bimbingan_sespimmen')->with([
                'success' => 'Data tersimpan!'
            ]);
        }
    }

    public function post_edit_no_telp(Request $request, $id)
    {
        $update = DB::table('gadik_sespimmen')->where('id', $id)->update([
            "no_telp" => $request->no_telp
        ]);

        if ($update) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
