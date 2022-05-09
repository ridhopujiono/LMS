<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaSespimmen;
use Log;
use Carbon\Carbon;

class DashboardAgendaSespimmen extends Controller
{
    public function agenda_sespimmen()
    {
        $data = AgendaSespimmen::first();

        if (empty($data)) {
            return view('dashboard.sespimmen.agenda.agenda', [
                'title' => "Halaman Agenda Kegiatan",
                'month_list' => []
            ]);
        } else {
            $plus_six = Carbon::parse($data->start)->addMonth(8)->format('Y-m-d');
            $six_month = AgendaSespimmen::whereBetween('start', [
                Carbon::parse($data->start)->format('Y-m-d'), $plus_six
            ])->get();

            // GET NAMA 8 BULAN
            $month_list = [];

            for ($i = 0; $i < 8; $i++) {
                $month_list[$i] = [Carbon::parse($data->start)->addMonth($i)->isoFormat('MMMM'), AgendaSespimmen::whereMonth('start', Carbon::parse($data->start)->addMonth($i)->format('m'))->get()];
            }

            // dd($month_list);
            return view('dashboard.sespimmen.agenda.agenda', [
                'title' => "Halaman Agenda Kegiatan",
                'month_list' => $month_list
            ]);
        }
    }
    public function getEvent()
    {
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = AgendaSespimmen::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($events);
        }
        return view('dashboard.sespimmen.agenda.agenda');
    }
    public function createEvent(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $events = AgendaSespimmen::insert([
            "title" => $request->judul_kegiatan,
            "deskripsi" => $request->deskripsi_kegiatan,
            "bagian" => $request->bagian_kegiatan,
            "start" => $request->start,
            "tahap" => $request->tahap,
            "end" => $request->end
        ]);
        return redirect()->back();
    }

    public function deleteEvent(Request $request)
    {
        $event = AgendaSespimmen::find($request->id);
        return $event->delete();
    }
}
