<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ImgCompress;
use File;

class DashboardSespimmenController extends Controller
{

    public function gadik()
    {
        $data = DB::table('gadik_sespimmen')->orderBy('nama_gadik')->get();
        $no = 1;
        return view('dashboard.sespimmen.gadik.gadik', [
            'title' => "Halaman Gadik",
            'data' => $data,
            'no' => $no
        ]);
    }

    public function tambah_gadik_sespimmen()
    {
        return view('dashboard.sespimmen.gadik.tambah_gadik', [
            'title' => "Halaman Gadik | Tambah Gadik",
        ]);
    }

    public function post_gadik_sespimmen(Request $request)
    {
        if ($request->file("foto") == NULL) {

            $insert = DB::table('gadik_sespimmen')->insert([
                "nama_gadik" => $request->nama_gadik,
                "username" => $request->username,
                "pangkat" => $request->pangkat,
                "kode" => $request->kode,
                "jabatan" => $request->jabatan,
                "lp" => $request->lp,
                "no_telp" => $request->no_telp,
                "jenis_gadik" => $request->jenis_gadik,
                "foto" => "user_default.png",
            ]);
            if (!$insert) {
                return redirect('/gadik')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {
                DB::table('users')->insert([
                    "username" => $request->username,
                    "password" => password_hash($request->username, PASSWORD_DEFAULT),
                    "level" => "gadik",
                    "bagian" => "sespimmen",
                    "name" => $request->nama_gadik,
                ]);
                return redirect('/gadik')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        } else {
            // Kompress Image
            $originalImage = $request->file('foto');
            $thumbnailImage = ImgCompress::make($originalImage);
            $thumbnailPath = public_path('admin/sespimmen/foto_gadik/');
            $thumbnailImage->resize(512, 512);
            $thumbnailImageDestination = $thumbnailPath . time() . $originalImage->getClientOriginalName();
            $thumbnailImageName = time() . $originalImage->getClientOriginalName();
            $thumbnailImage->save($thumbnailImageDestination);

            $insert = DB::table('gadik_sespimmen')->insert([
                "nama_gadik" => $request->nama_gadik,
                "username" => $request->username,
                "pangkat" => $request->pangkat,
                "kode" => $request->kode,
                "jabatan" => $request->jabatan,
                "lp" => $request->lp,
                "no_telp" => $request->no_telp,
                "jenis_gadik" => $request->jenis_gadik,
                "foto" => $thumbnailImageName,
            ]);
            if (!$insert) {
                return redirect('/gadik')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {
                DB::table('users')->insert([
                    "username" => $request->username,
                    "password" => password_hash($request->username, PASSWORD_DEFAULT),
                    "level" => "gadik",
                    "bagian" => "sespimmen",
                    "name" => $request->nama_gadik,
                ]);
                return redirect('/gadik')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        }
    }

    public function edit_gadik_sespimmen($id)
    {
        return view('dashboard.sespimmen.gadik.edit_gadik', [
            'data' => DB::table('gadik_sespimmen')->where('id', $id)->get(),
            'title' => "Halaman Gadik | Edit Gadik",
        ]);
    }


    public function detail_gadik_sespimmen(Request $request)
    {
        $data = DB::table('gadik_sespimmen')->whereIn('id', $request->id)->get();

        return response($data);
    }

    public function update_gadik_sespimmen(Request $request)
    {
        if ($request->file("foto") == NULL) {
            $get_data = DB::table('gadik_sespimmen')->where('id', $request->id)->first();
            $update_user = DB::table('users')->where('username', $get_data->username)->update([
                "username" => $request->username,
                "password" => password_hash($request->username, PASSWORD_DEFAULT),
                "level" => "gadik",
                "bagian" => "sespimmen",
                "name" => $request->nama_gadik,
            ]);
            $update = DB::table('gadik_sespimmen')->where('id', $request->id)->update([
                "nama_gadik" => $request->nama_gadik,
                "username" => $request->username,
                "pangkat" => $request->pangkat,
                "kode" => $request->kode,
                "jabatan" => $request->jabatan,
                "lp" => $request->lp,
                "no_telp" => $request->no_telp,
                "jenis_gadik" => $request->jenis_gadik,
                "foto" => "user_default.png",
            ]);
            if (!$update) {
                return redirect('/gadik')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {

                return redirect('/gadik')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        } else {
            // Kompress Image
            $originalImage = $request->file('foto');
            $thumbnailImage = ImgCompress::make($originalImage);
            $thumbnailPath = public_path('admin/sespimmen/foto_gadik/');
            $thumbnailImage->resize(512, 512);
            $thumbnailImageDestination = $thumbnailPath . time() . $originalImage->getClientOriginalName();
            $thumbnailImageName = time() . $originalImage->getClientOriginalName();
            $thumbnailImage->save($thumbnailImageDestination);

            $get_data = DB::table('gadik_sespimmen')->where('id', $request->id)->first();
            $update_user = DB::table('users')->where('username', $get_data->username)->update([
                "username" => $request->username,
                "password" => password_hash($request->username, PASSWORD_DEFAULT),
                "level" => "gadik",
                "bagian" => "sespimmen",
                "name" => $request->nama_gadik,
            ]);
            $update = DB::table('gadik_sespimmen')->where('id', $request->id)->update([
                "nama_gadik" => $request->nama_gadik,
                "username" => $request->username,
                "pangkat" => $request->pangkat,
                "kode" => $request->kode,
                "jabatan" => $request->jabatan,
                "lp" => $request->lp,
                "no_telp" => $request->no_telp,
                "jenis_gadik" => $request->jenis_gadik,
                "foto" => $thumbnailImageName,
            ]);
            if (!$update) {
                return redirect('/gadik')->with([
                    'error' => "Kesalahan saat menyimpan data!"
                ]);
            } else {
                return redirect('/gadik')->with([
                    'success' => 'Data tersimpan!'
                ]);
            }
        }
    }

    public function hapus_gadik_sespimmen(Request $request)
    {
        $data = DB::table('gadik_sespimmen')->whereIn('id', $request->id)->get();
        foreach ($data as $d) {
            DB::table('users')->where('username', $d->username)->delete();
        }
        $hapus = DB::table('gadik_sespimmen')->whereIn('id', $request->id)->delete();

        if ($hapus) {
            return response('benar');
        } else {
            return response('error');
        }
    }
}
