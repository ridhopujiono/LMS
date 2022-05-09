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
        <div class="ibox">
            <div class="ibox-head">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="ibox-title">
                                Data Mata Kuliah
                            </div>
                        </div>
                        <div class="col-6 text-right text-white">
                            <div class="d-inline-block">
                                @if(auth()->user()->level == "admin")
                                <a class="btn btn-primary" href="#" id="tambah_mata_kuliah"><span class="fa fa-plus"></span> tambah</a>
                                <a class="btn btn-info" id="edit_mata_kuliah"><span class="fa fa-pencil"></span> edit</a>
                                <a class="btn btn-danger" id="hapus_mata_kuliah"><span class="fa fa-trash"></span> hapus</a>
                                @endif
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
                                @if(auth()->user()->level == "admin")
                                <th width="5%" style="text-align: center">#</th>
                                @endif
                                <th width="5%" style="text-align: center">NO</th>
                                <th style="text-align: center">Kode Mata Kuliah</th>
                                <th style="text-align: center">Nama Mata Kuliah</th>
                                <th style="text-align: center">Jam Kuliah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                @if(auth()->user()->level == "admin")
                                <td width="10%" style="text-align: center;vertical-align:middle;"><input type="checkbox" name="" id="" value="{{$d->id}}"></td>
                                @endif
                                <td width="10%" style="text-align: center; vertical-align:middle;">{{$no++}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->kode_mata_kuliah}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->nama_mata_kuliah}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->jp}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Edit Data Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{url('update_mata_kuliah_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data" id="modal-detail-body">

                </form>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Tambah Data Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('post_mata_kuliah_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="kode_mata_kuliah">Kode Mata Kuliah</label>
                        <input type="text" name="kode_mata_kuliah" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_mata_kuliah">Nama Mata Kuliah</label>
                        <textarea type="text" name="nama_mata_kuliah" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jp">Jam Kuliah</label>
                        <input type="text" name="jp" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Simpan</button>
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



<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 10,
            //"ajax": './assets/demo/data/table_data.json',
            /*"columns": [
                { "data": "name" },
                { "data": "office" },
                { "data": "extn" },
                { "data": "start_date" },
                { "data": "salary" }
            ]*/
        });
    })

    let id_mata_kuliah = [];
    $('input[type="checkbox"]').click(function() {
        if ($(this).prop("checked") == true) {
            id_mata_kuliah.push($(this).val());
        } else if ($(this).prop("checked") == false) {
            for (var i = 0; i < id_mata_kuliah.length; i++) {

                if (id_mata_kuliah[i] === $(this).val()) {

                    id_mata_kuliah.splice(i, 1);
                }

            }
        }
    });
    let token = $('meta[name="csrf_token"]').attr("content");
    let url_hapus = "{{url('hapus_mata_kuliah_sespimmen')}}";
    let edit_mata_kuliah = "{{url('edit_mata_kuliah_sespimmen')}}";
    let list_serdik_mata_kuliah = "{{url('list_serdik_mata_kuliah_sespimmen')}}";
    let url_img = "{{asset('admin/sespimmen/foto_serdik')}}";
    let _token = "{{csrf_token()}}";
    let html = ``;
    $('#edit_mata_kuliah').click(() => {
        $.ajax({
            url: edit_mata_kuliah,
            method: "POST",
            data: {
                _token: token,
                id: id_mata_kuliah
            },
            success: (response) => {
                $.each(response, function(i, val) {
                    html += `
                            
                                <div class="card mb-3 p-4" style="box-shadow: 1px 2px #eee">
                                
                                    <div class="form-group">
                                        <input type="hidden" name="id[]" class="form-control" value="${val.id}" />
                                        
                                    </div>
                                    <div class="form-group">
                                    <label for="kode_mata_kuliah">Kode Mata Kuliah</label>
                                    <input type="text" name="kode_mata_kuliah[]" class="form-control" value="${val.kode_mata_kuliah}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_mata_kuliah">Nama Mata Kuliah</label>
                                    <textarea type="text" name="nama_mata_kuliah[]" class="form-control" value="${val.nama_mata_kuliah}">${val.nama_mata_kuliah}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jp">Jam Kuliah</label>
                                    <input type="text" name="jp[]" class="form-control" value="${val.jp}" >
                                </div>
                                </div> 
                            `;
                });

                html += `
                        <input type="hidden" name="_token" class="form-control" value="${_token}" />
                        <div class="form-group">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                </div>`;


                $('#modal-detail-body').html(html);
                $('#modalDetail').modal('show');
                html = ``;
            },
            error: (err) => {
                console.log(err);
            }
        });
    });

    $('#hapus_mata_kuliah').click(function() {
        if (confirm("Apa anda yakin?")) {
            $.ajax({
                url: url_hapus,
                method: "POST",
                data: {
                    _token: token,
                    id: id_mata_kuliah
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

    $("#tambah_mata_kuliah").click(() => {
        $('#modalAdd').modal('show');
    });
</script>

<script>
    $(".list-serdik").on("click", function(e) {
        var id_mata_kuliah_serdik = $(this).data('id');
        $.ajax({
            url: list_serdik_mata_kuliah + "/" + id_mata_kuliah_serdik,
            method: "GET",
            success: (response) => {
                if (response[0] == "success") {
                    $.each(response[1], function(i, val) {
                        html += `<div class="card mb-3 p-3">
                                    <form action="" class="p-3" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for=""><b>Nama serdik</b></label>
                                            <p>${val.nama_serdik}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Username</b></label>
                                            <p>${val.username}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Pangkat</b></label>
                                            <p>${val.pangkat}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Kode</b></label>
                                            <p>${val.kode}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Jabatan</b></label>
                                            <p>${val.jabatan}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Jenis Kelamin</b></label>
                                            <p>${val.lp}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>No. Serdik</b></label>
                                            <p>${val.no_serdik}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>No. Telp</b></label>
                                            <p>${val.no_telp}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b>Foto</b></label>
                                            <br>
                                            <img width="150px" src="${url_img}/${val.foto}">
                                        </div>
                                        
                                    </form>
                                </div>`;
                    });
                } else {
                    html += `<div class="row align-items-center" style="height: 100%;">
                                    <div class="col" style="text-align:center">
                                        <p>Data tidak ditemukan</p>
                                    </div>
                                </div>`;
                }


                $('#modal-list-body').html(html);
                $('#modalList').modal('show');
                html = ``;
            },
            error: (err) => {
                console.log(err);
            }
        });
    });
</script>
@endsection