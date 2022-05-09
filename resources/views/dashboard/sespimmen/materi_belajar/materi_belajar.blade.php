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

    td {
        vertical-align: middle;
        text-align: center;
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
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="ibox-title">
                                            Data Mata Pelajaran
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

                                            <th width="5%" style="text-align: center">NO</th>

                                            <th style="text-align: center">Nama Mata Kuliah</th>
                                            <th style="text-align: center">Tambah Materi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $d)
                                        <tr>

                                            <td width="10%" style="text-align: center; vertical-align:middle;">{{$no++}}</td>

                                            <td style="text-align: center; vertical-align:middle;">{{$d->nama_mata_kuliah}}</td>

                                            <td>
                                                <a href="{{url('lihat_materi_sespimmen')}}/{{$d->id}}" class="btn btn-info text-white lihat_materi" data-id="{{$d->id}}"><span class="fa fa-eye"></span> lihat</a>
                                            </td>

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
                                            Data Materi Belajar
                                        </div>
                                    </div>
                                    <div class="col-6 text-right text-white">
                                        <div class="d-inline-block">
                                            @if(auth()->user()->level == "admin" || auth()->user()->level == "gadik")
                                            <a class="btn btn-danger" id="hapus_materi_belajar"><span class="fa fa-trash"></span> hapus</a>
                                            <a class="btn btn-info text-white" id="tambah_materi_belajar"><span class="fa fa-plus"></span> upload</a>
                                            @endif
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
                                            <th width="5%" style="text-align: center">#</th>

                                            <th style="text-align: center">Judul/Tema</th>
                                            <th style="text-align: center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-materi">

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
                <h5 class="modal-title" id="modaladdLabel">Upload Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="" class="p-3" method="POST" id="form-add" enctype="multipart/form-data" id="modal-add-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Judul Materi</label>
                        <input class="form-control" type="text" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Gadik</label>
                        <select class="form-control" name="nama_gadik" id="">
                            @foreach($gadik as $g)
                            <option value="{{$g->nama_gadik}}">{{$g->nama_gadik}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">File Materi</label>
                        <input class="form-control" type="file" name="file">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Upload</button>
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
    $("#tambah_materi_belajar").hide();
    $("#hapus_materi_belajar").hide();

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

    $('.lihat_materi').on('click', function(e) {
        e.preventDefault();
        $("#tambah_materi_belajar").show();
        $("#hapus_materi_belajar").show();
        const url_materi = $(this).attr('href');
        // console.log(id_materi);
        $.ajax({
            url: url_materi,
            method: "GET",
            success: (response) => {
                $.each(response[0], function(i, val) {
                    html += `
                            <tr >
                                <td width="10%" style="text-align: center;vertical-align:middle;"><input type="checkbox" name="" id="" value="${val.id}"></td>
                                
                                <td style="text-align: center; vertical-align:middle;">${val.judul}</td>
                                
                                <td>
                                <a href="${val.id}" class="btn btn-info text-white lihat_detail_materi"><span class="fa fa-eye"></span> lihat</a>
                                </td>
                                                
                            </tr>
                            `;
                });
                $("#form-add").attr("action", add_materi + "/" + response[1]);
                $("#tbody-materi").html(html);
                html = ``;
            },
            error: (err) => {
                console.log(err);
            }
        });
    });

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

    $("#tambah_materi_belajar").click(() => {
        $('#modalAdd').modal('show');
    });
</script>
@endsection