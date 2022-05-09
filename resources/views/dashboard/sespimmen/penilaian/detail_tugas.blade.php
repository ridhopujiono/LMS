@extends('dashboard/template/main')
@section('content')
<link href="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
<style>
    .modal-open .modal {
        background: #333333ad;
    }

    td {
        vertical-align: middle;
    }

    @media only screen and (max-width: 768px) {


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
                <a href=""><i class="la la-home font-20"></i></a>
            </li>

        </ol>
    </div>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                @if(session('error'))
                <div class="alert alert-danger">Kesalahan menyimpan data !</div>
                @elseif(session('success'))
                <div class="alert alert-success">Berhasil menyimpan data !</div>
                @endif
            </div>

        </div>
    </div>
    <div class="page-content fade-in-up">
        <button id="btn-input-nilai" class="btn btn-primary" style="position: fixed; bottom: 20px; right: 10px; z-index: 9999"><span class="fa fa-pencil mr-2"></span>Masukan Nilai Akhir</button>
        <div class="ibox">
            <div class="ibox-head">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="ibox-title">
                                [ {{$matkul->kode_mata_kuliah}} ] {{$matkul->nama_mata_kuliah}}
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <div class="ibox-title ">
                                {{$serdik->nama_serdik}} [ {{$serdik->no_serdik }}]
                                [
                                @foreach($pokjar as $p)
                                @if($serdik->pokjar == $p->id)
                                {{$p->nama_pokjar}}
                                @endif
                                @endforeach
                                ]

                            </div>
                        </div>

                    </div>



                </div>
            </div>
            <div class="container">

                <div class="row">

                    <div class="col-md-6">
                        <div class="ibox" style="border: 1px solid #eee; margin-top: 10px">
                            <div class="ibox-head">
                                <h5>Tugas Belajar</h5><br>
                                <span>
                                    Rata- rata : <b>
                                        {{$rata_rata}}
                                    </b>

                                </span>
                            </div>
                            <div class="ibox-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center">NO</th>
                                                <th style="text-align: center">Nama Tugas</th>

                                                <th style="text-align: center">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>

                                                <td width="10%" style="text-align: center; vertical-align:middle;">{{$no++}}</td>
                                                <td style="text-align: center; vertical-align:middle;">{{$d->nama_tugas}}</td>
                                                <td style="text-align: center; vertical-align:middle;">{{$d->nilai}}</td>



                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $no = 1; @endphp
                    <div class="col-md-6">
                        <div class="ibox" style="border: 1px solid #eee; margin-top: 10px">
                            <div class="ibox-head">
                                <h5>Tugas Akhir</h5><br>
                                <span>
                                    Rata- rata : <b>
                                        {{$rata_rata2}}
                                    </b>

                                </span>
                            </div>
                            <div class="ibox-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="example-table2" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center">NO</th>
                                                <th style="text-align: center">Nama Tugas</th>

                                                <th style="text-align: center">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data2 as $d)
                                            <tr>

                                                <td width="10%" style="text-align: center; vertical-align:middle;">{{$no++}}</td>
                                                <td style="text-align: center; vertical-align:middle;">{{$d->nama_tugas}}</td>
                                                <td style="text-align: center; vertical-align:middle;">{{$d->nilai}}</td>



                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Berikan Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('input_penilaian')}}/{{$id_matkul}}/{{$id_serdik}}" name="form-nilai" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama_pokjar">Nilai</label>
                        <input type="text" name="nilai" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="ui-checkbox">
                            <input type="checkbox">
                            <span class="input-span" id="pilihan"></span>Nilai otomatis (SISTEM)</label>
                    </div>
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
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    let nilai = "{{$rata_rata3}}";
    $(function() {
        $('#example-table').DataTable({
            pageLength: 10,
        });
        $('#example-table2').DataTable({
            pageLength: 10,
        });
    });
    $("#btn-input-nilai").on("click", function() {
        $("#modalAdd").modal('show');
    });
    let init = true;
    $("#pilihan").on("click", function() {
        if (init) {
            $("input[name='nilai']").val(nilai);
            init = false;
        } else {
            $("input[name='nilai']").val('');
            init = true;
        }
    });
</script>
@endsection