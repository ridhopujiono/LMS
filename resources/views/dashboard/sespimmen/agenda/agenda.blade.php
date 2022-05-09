@extends('dashboard/template/main')
@section('content')
<!-- PLUGINS STYLES-->
<link href="{{asset('dashboard/dist/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />

<link href="{{asset('dashboard/dist/assets/vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet" />
<link href="{{asset('dashboard/dist/assets/vendors/fullcalendar/dist/fullcalendar.print.min.css')}}" rel="stylesheet" media="print" />


<style>
    .modal-open .modal {
        background: #333333ad;
    }

    .bg-info {
        background-color: #d1ecf1 !important;
    }
</style>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Administrasi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Jadwal Pendidikan </li>
        </ol>
    </div>
    <style>
        .ibox {
            margin-bottom: 10px;
        }
    </style>
    <div class="alert alert-info mt-3">Klik kalender untuk menambah dan menghapus kegiatan</div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-3">
                <div id="external-events">
                    <h5 class="m-b-10">List Agenda</h5>

                    @for($i = 0; $i < count($month_list); $i++) <div class="ibox collapsed-mode">
                        <div class="ibox-head">
                            <div class="ibox-title">{{$month_list[$i][0]}}</div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="ibox-body" style="display: none;">
                            <ul>
                                @for($j = 0; $j < count($month_list[$i][1]); $j++) <li class="font-weight-bold" style="text-transform: capitalize;">
                                    {{$month_list[$i][1][$j]->title}} <br>
                                    <span class="font-weight-normal" style="color: green; font-size: 12px">
                                        {{\Carbon\Carbon::parse($month_list[$i][1][$j]->start)->format('d-m-Y')}}

                                    </span>
                                    <br>
                                    <span style="font-weight: normal; white-space: pre-line">Deskripsi:
                                        {{$month_list[$i][1][$j]->deskripsi}}
                                    </span>


                                    </li>
                                    @endfor
                            </ul>
                        </div>
                </div>
                @endfor
            </div>
        </div>
        <div class="col-md-9">
            <div class="ibox">
                <div class="ibox-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END PAGE CONTENT-->
</div>

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Tambah Agenda Kalender Pendidikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('createeventsespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama_pokjar">Judul Kegiatan</label>
                        <input type="text" name="judul_kegiatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_pokjar">Deskripsi Kegiatan</label>
                        <textarea class="form-control" name="deskripsi_kegiatan" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nama_pokjar">Bagian</label>
                        <input type="text" name="bagian_kegiatan" class="form-control" placeholder="KABAG BINDIK">
                    </div>
                    <div class="form-group">
                        <label for="tahap">Tahap / Pengantar</label>
                        <input type="text" name="tahap" class="form-control" placeholder="TAHAP I atau PENGANTAR">
                    </div>
                    <input type="text" name="start" class="d-none">
                    <input type="text" name="end" class="d-none">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/fullcalendar/dist/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>

@if(auth()->user()->level == "admin")
<script>
    $(document).ready(function() {
        var mytoken = "{{ csrf_token()}}";
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            navLinks: true,
            editable: true,
            events: "{{url('geteventsespimmen')}}",
            displayEventTime: false,
            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                //  memanggil modal

                // var title = prompt('Judul agenda:');
                // if (title) {
                var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');

                $("input[name='start']").val(start);
                $("input[name='end']").val(end);
                $("#modalAdd").modal('show');
                // $.ajax({
                //     url: "{{url('createeventsespimmen')}}",
                //     data: {
                //         title: title,
                //         start: start,
                //         end: end,
                //         _token: mytoken
                //     },
                //     type: "post",
                //     success: function(data) {
                //         alert("Added Successfully");
                //     }
                // });
                // calendar.fullCalendar('renderEvent', {
                //         title: title,
                //         start: start,
                //         end: end,
                //         allDay: allDay
                //     },
                //     true
                // );
                // }
                // calendar.fullCalendar('unselect');
            },
            eventClick: function(event) {

                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: "{{url('deleteeventsespimmen')}}",
                        data: {
                            id: event.id,
                            _token: mytoken
                        },
                        success: function(response) {
                            if (parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                alert("Deleted Successfully");
                            }
                        }
                    });
                }
            }
        });
    });
</script>
@else
<script>
    $(document).ready(function() {
        var mytoken = "{{ csrf_token()}}";
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            navLinks: true,
            editable: true,
            events: "{{url('geteventsespimmen')}}",
            displayEventTime: false,
            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
        });
    });
</script>
@endif
@endsection