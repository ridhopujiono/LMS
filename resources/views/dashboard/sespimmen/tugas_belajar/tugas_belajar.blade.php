@extends('dashboard/template/main')
@section('content')
<link href="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
<style>
    .modal-open .modal {
        background: #333333ad;
    }

    .btn {
        padding: .2rem .75rem;
        font-size: 13px;
    }

    @media only screen and (max-width: 768px) {
        .btn {
            padding: .05rem .05rem;
            display: inline-block;
            line-height: 1.25rem;
            font-size: 11px !important;
        }

        .ibox .ibox-head .ibox-title {
            font-size: 11px;
            font-weight: 600;
        }
    }
</style>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Perkuliahan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Tugas Belajar</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        @if(auth()->user()->level == "admin" || auth()->user()->level == "gadik")
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Daftar Materi</div>

                <div class="col-6 text-right text-white">
                    <div class="d-inline-block">
                        <a class="btn btn-xs btn-primary" href="{{url('tambah_tugas_sespimmen')}}">
                            <span class="fa fa-plus"></span> Tambah</a>

                    </div>
                </div>

            </div>
            <div class="ibox-body">
                <table class="
              table
              table-responsive
              table-striped
              table-bordered
              table-hover
            " id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Matkul</th>
                            <th>Penerima</th>
                            <th>Batas Waktu</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <td><input type="checkbox" name="" id="" value=""></td>

                            <td>{{$d->nama_tugas}}</td>
                            <td>
                                @for($i = 0; $i < count($matkul); $i++) @if($d->id_matkul == $matkul[$i]->id)
                                    {{$matkul[$i]->nama_mata_kuliah}}
                                    @endif
                                    @endfor
                            </td>
                            <td>
                                @if($d->pokjar == 0)
                                SEMUA POKJAR
                                @else
                                @for($i = 0; $i < count($pokjar); $i++) @if($d->pokjar == $pokjar[$i]->id)
                                    {{$pokjar[$i]->nama_pokjar}}
                                    @endif
                                    @endfor
                                    @endif
                            </td>
                            <td>
                                {{$d->deadline}} | {{$d->end}}</ </td>
                            <td>
                                <a class="btn btn-xs btn-info text-white" href="{{url('detail_tugas_sespimmen')}}/{{$d->id}}">
                                    <i class="fa fa-eye"></i>
                                    <small><b>Detail</b></small>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        @foreach($data as $d)
        <a href="{{url('upload_tugas_sespimmen')}}/{{$d->id}}">
            <div class="ibox mb-3">
                <div class="ibox-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h6 style="color: #000000b8;">@for($i = 0; $i < count($matkul); $i++) @if($d->id_matkul == $matkul[$i]->id)
                                    {{$matkul[$i]->nama_mata_kuliah}}
                                    @endif
                                    @endfor
                            </h6>
                            <div class="text-info" style="font-size: 13px">
                                {{$d->nama_tugas}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        @endif
    </div>
    <!-- END PAGE CONTENT-->
</div>


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 10,
        });
    });
</script>
@endsection