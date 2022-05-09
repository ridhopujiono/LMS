<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPokjarSespimmenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = DB::table('pokjar_sespimmen')->get();
        $no = 1;
        return view('dashboard.sespimmen.pokjar.pokjar', [
            'title' => "Halaman Pokjar",
            'data' => $data,
            'no' => $no
        ]);
    }


    public function post_pokjar_sespimmen(Request $request)
    {
        $insert = DB::table('pokjar_sespimmen')->insert([
            "nama_pokjar" => $request->nama_pokjar
        ]);
        if (!$insert) {
            return redirect('/pokjar_sespimmen')->with([
                'error' => "Kesalahan saat menyimpan data!"
            ]);
        } else {
            return redirect('/pokjar_sespimmen')->with([
                'success' => 'Data tersimpan!'
            ]);
        }
    }


    public function edit_pokjar_sespimmen(Request $request)
    {
        $data = DB::table('pokjar_sespimmen')->whereIn('id', $request->id)->get();

        return response($data);
    }


    public function update_pokjar_sespimmen(Request $request)
    {
        $nama_pokjar = $request->nama_pokjar;
        $link_kelas = $request->link_kelas;
        $meeting_id = $request->meeting_id;
        $passcode = $request->passcode;
        $id = $request->id;
        for ($i = 0; $i < count($nama_pokjar); $i++) {
            DB::table('pokjar_sespimmen')->where('id', $id[$i])->update([
                "nama_pokjar" => $nama_pokjar[$i],
                "link_kelas" => $link_kelas[$i],
                "meeting_id" => $meeting_id[$i],
                "passcode" => $passcode[$i]
            ]);
        }
        return redirect('/pokjar_sespimmen')->with([
            'success' => 'Data tersimpan!'
        ]);
    }


    public function hapus_pokjar_sespimmen(Request $request)
    {
        $hapus = DB::table('pokjar_sespimmen')->whereIn('id', $request->id)->delete();

        if ($hapus) {
            return response('benar');
        } else {
            return response('error');
        }
    }

    public function list_serdik_pokjar_sespimmen($id)
    {
        $data = DB::table('serdik_sespimmen')->orderBy('nama_serdik')->where('pokjar', $id)->get();
        if ($data->isEmpty()) {
            return response(["empty", $data]);
        } else {
            return response(["success", $data]);
        }
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
