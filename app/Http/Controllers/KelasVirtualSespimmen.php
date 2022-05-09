<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasVirtualSespimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('kelas_virtual_sespimmen')->get();
        $no = 1;
        return view('dashboard.sespimmen.kelas_virtual.kelas_virtual', [
            'title' => "Halaman Kelas Virtual",
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
        $insert = DB::table('kelas_virtual_sespimmen')->insert([
            "judul" => $request->judul,
            "deskripsi" => $request->deskripsi,
            "link" => $request->link,
            "meeting_id" => $request->meeting_id,
            "passcode" => $request->passcode,
            "schedule" => $request->schedule
        ]);
        if (!$insert) {
            return redirect('/kelas_virtual_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/kelas_virtual_sespimmen')->with([
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
        $data = DB::table('kelas_virtual_sespimmen')->whereIn('id', $request->id)->get();

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
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;
        $link = $request->link;
        $meeting_id = $request->meeting_id;
        $passcode = $request->passcode;
        $schedule = $request->schedule;
        $id = $request->id;
        for ($i = 0; $i < count($judul); $i++) {
            DB::table('kelas_virtual_sespimmen')->where('id', $id[$i])->update([
                "judul" => $judul[$i],
                "deskripsi" => $deskripsi[$i],
                "link" => $link[$i],
                "meeting_id" => $meeting_id[$i],
                "passcode" => $passcode[$i],
                "schedule" => $schedule[$i]
            ]);
        }
        return redirect('/kelas_virtual_sespimmen')->with([
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
        $hapus = DB::table('kelas_virtual_sespimmen')->whereIn('id', $request->id)->delete();

        if ($hapus) {
            return response('benar');
        } else {
            return response('error');
        }
    }
}
