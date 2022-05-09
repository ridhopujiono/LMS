<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesanSesmpimmen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('pesan_sespimmen')->get();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]->created_at = Carbon::parse($data[$i]->created_at)->format(' d-m-Y H:i');
            $data[$i]->name_from = DB::table('users')->where('id', $data[$i]->from)->first();
        }
        return view('dashboard.sespimmen.pesan.pesan', [
            'title' => "Halaman Pesan",
            'data' => $data
        ]);
    }


    public function detail_pesan_sespimmen($id)
    {
        $data = DB::table('pesan_sespimmen')->where('id', $id)->first();
        return view('dashboard.sespimmen.pesan.detail_pesan', [
            'title' => "Halaman Detail Pesan",
            'data' => $data
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
        //
    }

    public function kirim_pesan_sespimmen()
    {

        return view('dashboard.sespimmen.pesan.kirim_pesan', [
            'title' => "Halaman Kirim Pesan"
        ]);
    }

    public function get_gadik_from_pesan_sespimmen()
    {
        $data = DB::table('users')->where(['level' => "gadik", 'bagian' => "sespimmen"])->get();
        return response($data);
    }
    public function get_serdik_from_pesan_sespimmen()
    {
        $data = DB::table('users')->where(['level' => "serdik", 'bagian' => "sespimmen"])->get();
        return response($data);
    }


    public function post_pesan_sespimmen(Request $request)
    {
        if (auth()->user()->level == "admin") {
            if ($request->sifat_pesan == "private") {
                DB::table('pesan_sespimmen')->insert([
                    "from" => auth()->user()->id,
                    "from_level" => "admin",
                    "nama" => $request->nama,
                    "to" => intval($request->atas_nama_tujuan),
                    "to_level" => $request->tujuan,
                    "judul" => $request->judul,
                    "pesan" => $request->pesan
                ]);
            } else if ($request->sifat_pesan == "broadcast") {
                DB::table('pesan_sespimmen')->insert([
                    "from" => auth()->user()->id,
                    "from_level" => "admin",
                    "to_level" => $request->tujuan,
                    "pesan" => $request->pesan,
                    "judul" => $request->judul
                ]);
            }

            return redirect('kirim_pesan_sespimmen')->with([
                "success" => "Berhasil mengirim pesan"
            ]);
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
