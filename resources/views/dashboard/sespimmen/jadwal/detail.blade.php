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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Mata Kuliah</b>
                                        <div class="mb-2">
                                            {{$matkul->nama_mata_kuliah}}
                                        </div>
                                        <b>Metode</b>
                                        <div class="mb-2">
                                            {{$metode->nama_metode}}
                                        </div>
                                        <b>Waktu</b>
                                        <div class="mb-2" style="text-transform: capitalize;">
                                            {{$data->hari}}, {{$data->tanggal}} {{$data->start}} s/d {{$data->end}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Dosen / Narasumber</b>
                                        <div class="mb-2">
                                            |
                                            @foreach($gadik as $g)
                                            @if($g->bagian == "dosen_1" || $g->bagian == "dosen_2")
                                            {{$g->nama_gadik}}
                                            @if(count($gadik) > 1)

                                            |
                                            @endif
                                            @endif
                                            @endforeach
                                        </div>
                                        <b>Pawas / Bindik</b>
                                        <div class="mb-2">
                                            |
                                            @foreach($gadik as $g)
                                            @if($g->bagian == "pawas_1" || $g->bagian == "pawas_2")
                                            {{$g->nama_gadik}}
                                            @if(count($gadik) > 1)

                                            |
                                            @endif
                                            @endif
                                            @endforeach
                                        </div>
                                        <b>Deskripsi</b>
                                        <div class="mb-2">
                                            {{$data->deskripsi}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="ibox-title">
                                            List Serdik
                                        </div>
                                    </div>
                                    <div class="col-6 text-right text-white">
                                        <div class="d-inline-block">
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>

                                            <th width="5%" style="text-align: center">NO SERDIK</th>

                                            <th style="text-align: center">Nama Serdik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($serdik as $s)
                                        <tr>

                                            <td width="10%" style=" ">{{$s->no_serdik}}</td>

                                            <td style="">{{$s->nama_serdik}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="ibox-title">
                                            Data Pengampu
                                        </div>
                                    </div>
                                    <div class="col-6 text-right text-white">
                                        <div class="d-inline-block">
                                            <!-- <a class="btn btn-danger" id="hapus_materi_belajar"><span class="fa fa-trash"></span> hapus</a> -->
                                            <a class="btn btn-info text-white" id="tambah_pengampu"><span class="fa fa-plus"></span> tambah</a>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="example-table2" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%" style="text-align: center">NO</th>

                                            <th style="text-align: center">Nama Pengampu</th>
                                            <th style="text-align: center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($gadik as $g)
                                        <tr>

                                            <td width="10%" style="">{{$no++}}</td>

                                            <td style="">{{$g->nama_gadik}}</td>
                                            <td style="">
                                                @switch($g->bagian)
                                                @case("dosen_1")
                                                Dosen 1
                                                @break
                                                @case("dosen_2")
                                                Dosen 2
                                                @break
                                                @case("pawas_1")
                                                Pawas 1
                                                @break
                                                @case("pawas_2")
                                                Pawas 2
                                                @break
                                                @case("asisten_dosen")
                                                Asisten Dosen
                                                @break
                                                @case("korsis")
                                                Korsis
                                                @break
                                                @case("bindik")
                                                Bindik
                                                @break
                                                @endswitch
                                            </td>

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
<style>
    .form-group .btn {
        padding: .5rem .75rem;
    }

    @media only screen and (max-width: 768px) {
        .form-group .btn {
            padding: .5rem .75rem;
            display: inline-block;
            line-height: 1.25rem;
            font-size: 13px !important;
        }

        .ibox .ibox-head .ibox-title {
            font-size: 12px;
            font-weight: 600;
        }
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modaladdLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaladdLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{url('tambah_pengampu_sespimmen')}}/{{$data->id}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Gadik</label>
                        <select class="form-control" name="nama_gadik" id="">
                            <option value="">-- Silahkan pilih --</option>
                            @foreach($list_all_gadik as $lg)
                            <option value="{{$lg->id}}">{{$lg->nama_gadik}}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" name="status" id="">
                                <option value="">-- Silahkan pilih --</option>
                                <option value="dosen_1">Dosen 1</option>
                                <option value="dosen_2">Dosen 2</option>
                                <option value="asisten_dosen">Asisten Dosen</option>
                                <option value="pawas_1">Pawas 1</option>
                                <option value="pawas_2">Pawas 2</option>
                                <option value="korsis">Korsis</option>
                                <option value="bindik">Bindik</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>

                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
<style>
    #modalList .modal-content {
        height: 90vh;

    }

    .modal-content {
        overflow-y: auto;
        background-color: rgb(235, 235, 235);
    }

    .modal-header {
        background-color: #fff;
        box-shadow: 3px 3px 3px #eaeaea;
    }

    .form-group {
        margin-bottom: 0.3rem;
    }
</style>

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Data Gadik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " id="modal-detail-body">

            </div>
        </div>
    </div>
</div>


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    function loadTable() {
        $('#example-table').DataTable({
            pageLength: 10,
        });
        $('#example-table2').DataTable({
            paging: false,
            "bInfo": false
        });

    }

    loadTable();

    let id_materi_belajar = [];
    $(document).delegate('input[type="checkbox"]', 'click', function() {
        if ($(this).prop("checked") == true) {
            id_materi_belajar.push($(this).val());
        } else if ($(this).prop("checked") == false) {
            for (var i = 0; i < id_materi_belajar.length; i++) {

                if (id_materi_belajar[i] === $(this).val()) {

                    id_materi_belajar.splice(i, 1);
                }

            }
        }
    });
    let token = $('meta[name="csrf_token"]').attr("content");
    let url_hapus = "{{url('hapus_materi_belajar_sespimmen')}}";
    let lihat_materi = "{{url('lihat_materi_sespimmen')}}";
    let add_materi = "{{url('add_materi_sespimmen')}}";
    let list_serdik_materi_belajar = "{{url('list_serdik_materi_belajar_sespimmen')}}";
    let url_img = "{{asset('admin/sespimmen/foto_serdik')}}";
    let _token = "{{csrf_token()}}";
    let html = ``;

    $(document).delegate(".lihat_detail_materi", "click", function(e) {
        let lihat_detail_materi = "{{url('lihat_detail_materi')}}";
        let url_foto_lihat_detail_materi = "{{url('admin/sespimmen/file_materi')}}";
        e.preventDefault();
        const id_detail_materi = $(this).attr('href');
        $.ajax({
            url: lihat_detail_materi + "/" + id_detail_materi,
            method: "POST",
            data: {
                _token: token,
            },
            success: (response) => {
                $.each(response, function(i, val) {
                    html += `<div class="card mb-3">
                                <form action="" class="p-3" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for=""><b>Judul </b></label>
                                        <p>${val.judul}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Nama Gadik</b></label>
                                        <p>${val.nama_gadik}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>File</b></label><br>
                                        <a href="${url_foto_lihat_detail_materi}/${val.file}" download>Download file</a>
                                    </div>
                                    
                                </form>
                            </div>`;
                });


                $('#modal-detail-body').html(html);
                $('#modalDetail').modal('show');
                html = ``;
            },
            error: (err) => {
                console.log(err);
            }
        });

    });

    $('#hapus_materi_belajar').click(function() {
        if (confirm("Apa anda yakin?")) {
            $.ajax({
                url: url_hapus,
                method: "POST",
                data: {
                    _token: token,
                    id: id_materi_belajar
                },
                success: (response) => {
                    if (response == "benar") {
                        location.reload();
                    } else {
                        console.log("error");
                    }
                },
                error: (err) => {
                    console.log(err);
                }

            });
        }
        return false;

    });

    $("#tambah_pengampu").click(() => {
        $('#modalAdd').modal('show');
    });
</script>
@endsection