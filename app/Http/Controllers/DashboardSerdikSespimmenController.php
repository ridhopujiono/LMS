<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ImgCompress;
use File;

class DashboardSerdikSespimmenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pokjar = DB::table('pokjar_sespimmen')->get();
        $data = DB::table('serdik_sespimmen')->orderBy('nama_serdik')->get();
        $no = 1;
        return view('dashboard.sespimmen.serdik.serdik', [
            'title' => "Halaman Serdik",
            'data' => $data,
            'pokjar' => $pokjar,
            'no' => $no
        ]);
    }


    public function tambah_serdik_sespimmen()
    {
        $pokjar = DB::table('pokjar_sespimmen')->get();
        return view('dashboard.sespimmen.serdik.tambah_serdik', [
            'title' => "Halaman Gadik | Tambah Gadik",
            'pokjar' => $pokjar
        ]);
    }

    public function post_serdik_sespimmen(Request $request)
    {
        if ($request->file("foto") == NULL) {

            $insert = DB::table('serdik_sespimmen')->insert([
                "nama_serdik" => $request->nama_serdik,
                "username" => $request->username,
                "pangkat" => $request->pangkat,
                "kode" => $request->kode,
                "jabatan" => $request->jabatan,
                "lp" => $request->lp,
                "no_telp" => $request->no_telp,
                "no_serdik" => $request->no_serdik,
                "pokjar" => $request->pokjar,
                "foto" => "user_default.png",
            ]);
            if (!$insert) {
                return redirect('/serdik_sespimmen')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {
                DB::table('users')->insert([
                    "username" => $request->username,
                    "password" => password_hash($request->username, PASSWORD_DEFAULT),
                    "level" => "gadik",
                    "bagian" => "sespimmen",
                    "name" => $request->nama_serdik,
                ]);
                return redirect('/serdik_sespimmen')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        } else {
            // Kompress Image
            $originalImage = $request->file('foto');
            $thumbnailImage = ImgCompress::make($originalImage);
            $thumbnailPath = public_path('admin/sespimmen/foto_serdik/');
            $thumbnailImage->resize(512, 512);
            $thumbnailImageDestination = $thumbnailPath . time() . $originalImage->getClientOriginalName();
            $thumbnailImageName = time() . $originalImage->getClientOriginalName();
            $thumbnailImage->save($thumbnailImageDestination);

            $insert = DB::table('serdik_sespimmen')->insert([
                "nama_serdik" => $request->nama_serdik,
                "username" => $request->username,
                "pangkat" => $request->pangkat,
                "kode" => $request->kode,
                "jabatan" => $request->jabatan,
                "lp" => $request->lp,
                "no_telp" => $request->no_telp,
                "no_serdik" => $request->no_serdik,
                "pokjar" => $request->pokjar,
                "foto" => $thumbnailImageName,
            ]);
            if (!$insert) {
                return redirect('/serdik_sespimmen')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {
                DB::table('users')->insert([
                    "username" => $request->username,
                    "password" => password_hash($request->username, PASSWORD_DEFAULT),
                    "level" => "gadik",
                    "bagian" => "sespimmen",
                    "name" => $request->nama_serdik,
                ]);
                return redirect('/serdik_sespimmen')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        }
    }

    public function edit_serdik_sespimmen($id)
    {
        $pokjar = DB::table('pokjar_sespimmen')->get();
        return view('dashboard.sespimmen.serdik.edit_serdik', [
            'data' => DB::table('serdik_sespimmen')->where('id', $id)->get(),
            'pokjar' => $pokjar,
            'title' => "Halaman Serdik | Edit Serdik",
        ]);
    }

    public function detail_serdik_sespimmen(Request $request)
    {
        $data = DB::table('serdik_sespimmen')->whereIn('id', $request->id)->get();
        $pokjar = DB::table('pokjar_sespimmen')->get();

        return response([$data, $pokjar]);
    }

    public function update_serdik_sespimmen(Request $request)
    {
        if ($request->file("foto") == NULL) {
            $get_data = DB::table('serdik_sespimmen')->where('id', $request->id)->first();

            // dd($get_data);
            $update_user = DB::table('users')->where('username', $get_data->username)->update([
                "username" => $request->username,
                "password" => password_hash($request->username, PASSWORD_DEFAULT),
                "level" => "serdik",
                "bagian" => "sespimmen",
                "name" => $request->nama_serdik,
            ]);
            $update = DB::table('serdik_sespimmen')->where('id', $request->id)->update([
                "nama_serdik" => $request->nama_serdik,
                "username" => $request->username,
                "pangkat" => $request->pangkat,
                "kode" => $request->kode,
                "jabatan" => $request->jabatan,
                "lp" => $request->lp,
                "no_telp" => $request->no_telp,
                "no_serdik" => $request->no_serdik,
                "pokjar" => $request->pokjar,
                "foto" => "user_default.png",
            ]);
            if (!$update) {
                return redirect('/serdik_sespimmen')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {

                return redirect('/serdik_sespimmen')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        } else {
            // Kompress Image
            $originalImage = $request->file('foto');
            $thumbnailImage = ImgCompress::make($originalImage);
            $thumbnailPath = public_path('admin/sespimmen/foto_serdik/');
            $thumbnailImage->resize(512, 512);
            $thumbnailImageDestination = $thumbnailPath . time() . $originalImage->getClientOriginalName();
            $thumbnailImageName = time() . $originalImage->getClientOriginalName();
            $thumbnailImage->save($thumbnailImageDestination);

            $get_data = DB::table('serdik_sespimmen')->where('id', $request->id)->first();

            $update_user = DB::table('users')->where('username', $get_data->username)->update([
                "username" => $request->username,
                "password" => password_hash($request->username, PASSWORD_DEFAULT),
                "level" => "serdik",
                "bagian" => "sespimmen",
                "name" => $request->nama_serdik,
            ]);

            $update = DB::table('serdik_sespimmen')->where('id', $request->id)->update([
                "nama_serdik" => $request->nama_serdik,
                "username" => $request->username,
                "pangkat" => $request->pangkat,
                "kode" => $request->kode,
                "jabatan" => $request->jabatan,
                "lp" => $request->lp,
                "no_telp" => $request->no_telp,
                "no_serdik" => $request->no_serdik,
                "pokjar" => $request->pokjar,
                "foto" => $thumbnailImageName,
            ]);
            // dd($update);
            if (!$update) {
                return redirect('/serdik_sespimmen')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {
                return redirect('/serdik_sespimmen')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus_serdik_sespimmen(Request $request)
    {
        $data = DB::table('serdik_sespimmen')->whereIn('id', $request->id)->get();
        foreach ($data as $d) {
            DB::table('users')->where('username', $d->username)->delete();
        }
        $hapus = DB::table('serdik_sespimmen')->whereIn('id', $request->id)->delete();

        if ($hapus) {
            return response('benar');
        } else {
            return response('error');
        }
    }
}
