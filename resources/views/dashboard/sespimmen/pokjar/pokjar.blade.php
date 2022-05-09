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
        <h1 class="page-title">Administrasi</h1>
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

    <style>

    </style>
    <div class="page-content fade-in-up">
        <div class="ibox list-serdik-ibox d-none">
            <div class="ibox-head">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="ibox-title">
                                List Serdik
                            </div>
                        </div>

                    </div>



                </div>
            </div>
            <div class="ibox-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="example-table3" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align: center">No. Serdik</th>
                                <th style="text-align: center">Nama Serdik</th>
                                <th style="text-align: center">Username</th>
                                <th style="text-align: center">Pangkat</th>
                                <th style="text-align: center">Jabatan</th>
                                <th style="text-align: center">No. Telp</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-list-serdik">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="ibox">
            <div class="ibox-head">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="ibox-title">
                                Data Pokjar
                            </div>
                        </div>
                        <div class="col-6 text-right text-white">
                            <div class="d-inline-block">
                                @if(auth()->user()->level == "admin")
                                <a class="btn btn-primary" href="#" id="tambah_pokjar"><span class="fa fa-plus"></span> tambah</a>
                                <a class="btn btn-info" id="edit_pokjar"><span class="fa fa-pencil"></span> edit</a>
                                <a class="btn btn-danger" id="hapus_pokjar"><span class="fa fa-trash"></span> hapus</a>
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
                                <th style="text-align: center">Nama Pokjar</th>
                                <th style="text-align: center">Link Kelas</th>
                                <th style="text-align: center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                @if(auth()->user()->level == "admin")
                                <td width="10%" style="text-align: center;vertical-align:middle;"><input type="checkbox" name="" id="" value="{{$d->id}}"></td>
                                @endif
                                <td width="10%" style="text-align: center; vertical-align:middle;">{{$no++}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->nama_pokjar}}</td>
                                <td style="text-align: center; vertical-align:middle;">
                                    <a target="_blank" href="{{$d->link_kelas}}">
                                        {{Str::limit($d->link_kelas, 35, '.......')}}
                                    </a>
                                    <div style="
                                            font-size: 12px;
                                            font-weight: 300;">Meeting ID : {{$d->meeting_id}} | Passcode: {{$d->passcode}}</div>
                                </td>
                                <td style="text-align: center;vertical-align:middle;">
                                    <button class="btn btn-danger text-white list-serdik" data-id="{{$d->id}}"><span class="fa fa-eye"></span> list serdik</button>
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
                <h5 class="modal-title" id="modalDetailLabel">Edit Data Pokjar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{url('update_pokjar_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data" id="modal-detail-body">

                </form>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Tambah Data Pokjar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('post_pokjar_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama_pokjar">Nama Pokjar</label>
                        <input type="text" name="nama_pokjar" class="form-control">
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
        });


    })

    let id_pokjar = [];
    $('input[type="checkbox"]').click(function() {
        if ($(this).prop("checked") == true) {
            id_pokjar.push($(this).val());
        } else if ($(this).prop("checked") == false) {
            for (var i = 0; i < id_pokjar.length; i++) {

                if (id_pokjar[i] === $(this).val()) {

                    id_pokjar.splice(i, 1);
                }

            }
        }
    });
    let token = $('meta[name="csrf_token"]').attr("content");
    let url_hapus = "{{url('hapus_pokjar_sespimmen')}}";
    let edit_pokjar = "{{url('edit_pokjar_sespimmen')}}";
    let list_serdik_pokjar = "{{url('list_serdik_pokjar_sespimmen')}}";
    let url_img = "{{asset('admin/sespimmen/foto_serdik')}}";
    let _token = "{{csrf_token()}}";
    let html = ``;
    $('#edit_pokjar').click(() => {
        $.ajax({
            url: edit_pokjar,
            method: "POST",
            data: {
                _token: token,
                id: id_pokjar
            },
            success: (response) => {
                $.each(response, function(i, val) {
                    html += `
                            
                                <div class="card mb-3 p-4" style="box-shadow: 1px 2px #eee">
                                
                                    <div class="form-group">
                                        <label for=""><b>Nama Pokjar</b></label>
                                        <input type="hidden" name="id[]" class="form-control" value="${val.id}" />
                                        <input type="text" name="nama_pokjar[]" class="form-control" value="${val.nama_pokjar}" />
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Link Kelas</b></label>
                                        <input type="text" name="link_kelas[]" class="form-control" value="${val.link_kelas}" />
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Meeting ID</b></label>
                                        <input type="text" name="meeting_id[]" class="form-control" value="${val.meeting_id}" />
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Passcode</b></label>
                                        <input type="text" name="passcode[]" class="form-control" value="${val.passcode}" />
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

    $('#hapus_pokjar').click(function() {
        if (confirm("Apa anda yakin?")) {
            $.ajax({
                url: url_hapus,
                method: "POST",
                data: {
                    _token: token,
                    id: id_pokjar
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

    $("#tambah_pokjar").click(() => {
        $('#modalAdd').modal('show');
    });
</script>

<script>
    $(".list-serdik").on("click", function(e) {
        var id_pokjar_serdik = $(this).data('id');
        $.ajax({
            url: list_serdik_pokjar + "/" + id_pokjar_serdik,
            method: "GET",
            success: (response) => {
                if (response[0] == "success") {
                    $.each(response[1], function(i, val) {
                        html += `
                        <tr >
                            
                                
                                <td style="text-align: center; vertical-align:middle;">${val.no_serdik}</td>                                                
                                <td style="text-align: center; vertical-align:middle;">${val.nama_serdik}</td>                                                
                                <td style="text-align: center; vertical-align:middle;">${val.username}</td>                                                
                                <td style="text-align: center; vertical-align:middle;">${val.pangkat}</td>                                                
                                <td style="text-align: center; vertical-align:middle;">${val.jabatan}</td>                                                
                                <td style="text-align: center; vertical-align:middle;">${val.no_telp}</td>                                                
                            </tr>
                        `;
                    });
                } else {
                    html += `<tr></tr>`;
                }


                $('#tbody-list-serdik').html(html);
                // $('#example-table3').DataTable({
                //     pageLength: 10,
                // });
                $('.list-serdik-ibox').removeClass('d-none');
                $('.list-serdik-ibox').addClass('show-up');
                html = ``;
            },
            error: (err) => {
                console.log(err);
            }
        });
    });
</script>
@endsection