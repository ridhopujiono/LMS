<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.login', [
            "judul" => "LMS Sespim"
        ]);
    }
    public function tentang()
    {
        return view('dashboard.tentang', [
            "judul" => "LMS Sespim | Tentang"
        ]);
    }
    public function sop()
    {
        return view('dashboard.sop', [
            "judul" => "LMS Sespim | SOP"
        ]);
    }
    public function sespimmen()
    {
        return view('dashboard.sespimmen', [
            "judul" => "LMS Sespim | Sespimmen"
        ]);
    }
    public function sespimma()
    {
        return view('dashboard.sespimma', [
            "judul" => "LMS Sespim | Sespimma"
        ]);
    }
    public function sespimmti()
    {
        return view('dashboard.sespimmti', [
            "judul" => "LMS Sespim | Sespimmti"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $data = User::where(['id' => auth()->user()->id])->first();


            switch ($data->level) {
                case "admin":
                    switch ($data->bagian) {
                        case "sespimma":
                            return redirect('sespimma');
                            break;

                        case "sespimmen":
                            return redirect('sespimmen');
                            break;

                        case "sespimmti":
                            return redirect('sespimmti');
                            break;

                        default:
                            # code...
                            break;
                    }
                    break;
                case "gadik":
                    switch ($data->bagian) {
                        case "sespimma":
                            return "saya gadik sesmpimma";
                            break;

                        case "sespimmen":
                            return redirect('sespimmen');
                            break;

                        case "sespimmti":
                            return "saya gadik sesmpimmti";
                            break;

                        default:
                            # code...
                            break;
                    }
                    break;
                case "serdik":
                    switch ($data->bagian) {
                        case "sespimma":
                            return "saya serdik sesmpimma";
                            break;

                        case "sespimmen":
                            return redirect('sespimmen');
                            break;

                        case "sespimmti":
                            return "saya serdik sesmpimmti";
                            break;

                        default:
                            # code...
                            break;
                    }
                    break;

                default:
                    # code...
                    break;
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard_sespimmen()
    {
        if (auth()->user()->level == "admin") {

            $total_gadik = DB::table('gadik_sespimmen')->count();
            $total_serdik = DB::table('serdik_sespimmen')->count();
            $total_chat = DB::table('pesan_sespimmen')->where('from_level', 'admin')->count();
            return view('dashboard.index', [
                'title' => "Halaman Utama",
                'total_gadik' => $total_gadik,
                'total_chat' => $total_chat,
                'total_serdik' => $total_serdik
            ]);
        } else {
            $id_tugas_belajar = DB::table('tugas_belajar_sespimmen')->where('nama_gadik', auth()->user()->name)->pluck('id');
            $tugas = DB::table('tugas_belajar_sespimmen')->where('nama_gadik', auth()->user()->name)->count();
            $id_tugas_akhir = DB::table('tugas_akhir_sespimmen')->where('nama_gadik', auth()->user()->name)->pluck('id');
            $tugas = DB::table('tugas_belajar_sespimmen')->where('nama_gadik', auth()->user()->name)->count();

            $tugas_akhir = DB::table('tugas_akhir_sespimmen')->where('nama_gadik', auth()->user()->name)->count();
            $total_upload_tugas = DB::table('upload_tugas_belajar_sespimmen')->whereIn('id_tugas', $id_tugas_belajar)->count();
            $total_upload_tugas_akhir = DB::table('upload_tugas_akhir_sespimmen')->whereIn('id_tugas', $id_tugas_akhir)->count();
            return view('dashboard.index', [
                'title' => "Halaman Utama",
                'total_tugas' => $tugas,
                'total_tugas_akhir' => $tugas_akhir,
                'total_upload_tugas_akhir' => $total_upload_tugas_akhir,
                'total_upload_tugas' => $total_upload_tugas
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
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
