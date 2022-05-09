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

    .ibox .ibox-body {
        padding: 15px 20px 10px 20px;
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
        <h1 class="page-title">SOP</h1>
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
        @if(auth()->user()->level == "admin")
        <div class="container-fluid">
            <div class="row">
                <button id="tambah_sop" class="btn btn-warning mb-3"><span class="fa fa-plus mr-1 "></span>tambah</button>
            </div>
        </div>
        @endif
        @foreach($data as $d)
        <div class="ibox mb-2">
            <div class="ibox-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h6>{{$d->judul}}
                        </h6>
                    </div>
                    <div class="col-4 text-right">
                        <div class="d-inle-block">
                            <a href="{{url('admin/sespimmen/file_sop')}}/{{$d->file}}" download="{{$d->judul}}" class="fa fa-download text-success mr-4"></a>
                            @if(auth()->user()->level == "admin")
                            <a href="{{$d->id}}" class="fa fa-pencil mr-4 edit_sop"></a>
                            <a href="{{$d->id}}" class="fa fa-trash text-danger hapus_sop"></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
                <h5 class="modal-title" id="modalDetailLabel">Edit Data SOP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{url('update_sop_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data" id="modal-detail-body">

                </form>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Tambah Data SOP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('post_sop_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-content {
        height: 90vh;
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
<!-- Modal -->
<div class="modal fade" id="modalList" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">List Data Serdik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " id="modal-list-body">

            </div>
        </div>
    </div>
</div>



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


    let token = $('meta[name="csrf_token"]').attr("content");
    let url_hapus = "{{url('hapus_sop_sespimmen')}}";
    let edit_sop = "{{url('edit_sop_sespimmen')}}";

    let _token = "{{csrf_token()}}";
    let html = ``;
    $('.edit_sop').on("click", function(e) {

        e.preventDefault();
        var id_sop = $(this).attr("href");
        // console.log(id_sop);
        $.ajax({
            url: edit_sop,
            method: "POST",
            data: {
                _token: token,
                id: id_sop
            },
            success: (response) => {
                $.each(response, function(i, val) {
                    html += `

                                <div class="card mb-3 p-4" style="box-shadow: 1px 2px #eee">

                                    <div class="form-group">
                                        <label for=""><b>Judul SOP</b></label>
                                        <input type="hidden" name="id" class="form-control" value="${val.id}" />
                                        <input type="text" name="judul" class="form-control" value="${val.judul}" />

                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>File</b></label>
                                        <input type="file" name="file" class="form-control" />
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

    $('.hapus_sop').on("click", function(e) {

        e.preventDefault();
        var id_sop = $(this).attr("href");
        if (confirm("Apa anda yakin?")) {
            $.ajax({
                url: url_hapus,
                method: "POST",
                data: {
                    _token: token,
                    id: id_sop
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

    $("#tambah_sop").click(() => {
        $('#modalAdd').modal('show');
    });
</script>

<script>
    $(".list-serdik").on("click", function(e) {
        var id_sop_serdik = $(this).data('id');
        $.ajax({
            url: list_serdik_sop + "/" + id_sop_serdik,
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