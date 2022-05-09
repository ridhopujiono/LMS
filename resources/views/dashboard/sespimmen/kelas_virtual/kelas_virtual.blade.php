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
                                Data Kelas Virtual
                            </div>
                        </div>
                        <div class="col-6 text-right text-white">
                            <div class="d-inline-block">
                                @if(auth()->user()->level == "admin")
                                <a class="btn btn-primary" href="#" id="tambah_kelas_virtual"><span class="fa fa-plus"></span> tambah</a>
                                <a class="btn btn-info" id="edit_kelas_virtual"><span class="fa fa-pencil"></span> edit</a>
                                <a class="btn btn-danger" id="hapus_kelas_virtual"><span class="fa fa-trash"></span> hapus</a>
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
                                <th style="text-align: center">Judul</th>
                                <th style="text-align: center">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                @if(auth()->user()->level == "admin")
                                <td width="10%" style="text-align: center;vertical-align:middle;"><input type="checkbox" name="" id="" value="{{$d->id}}"></td>
                                @endif
                                <td width="10%" style="text-align: center; vertical-align:middle;">{{$no++}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->judul}}</td>
                                <td style="text-align: center; vertical-align:middle;">
                                    <a target="_blank" href="{{$d->link}}">
                                        {{Str::limit($d->link, 35, '.......')}}
                                    </a>
                                    <div style="
                                            font-size: 12px;
                                            font-weight: 300;">Meeting ID : {{$d->meeting_id}} | Passcode: {{$d->passcode}}</div>
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
                <h5 class="modal-title" id="modalDetailLabel">Edit Data Kelas Virtual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{url('update_kelas_virtual_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data" id="modal-detail-body">

                </form>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Tambah Data Kelas Virtual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('post_kelas_virtual_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="" cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" name="link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="meeting_id">Meeting ID</label>
                        <input type="text" name="meeting_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="passcode">Passcode</label>
                        <input type="text" name="passcode" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="schedule">Schedule</label>
                        <input type="text" name="schedule" class="form-control">
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



<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 10,
        });
    })

    let id_kelas_virtual = [];
    $('input[type="checkbox"]').click(function() {
        if ($(this).prop("checked") == true) {
            id_kelas_virtual.push($(this).val());
        } else if ($(this).prop("checked") == false) {
            for (var i = 0; i < id_kelas_virtual.length; i++) {

                if (id_kelas_virtual[i] === $(this).val()) {

                    id_kelas_virtual.splice(i, 1);
                }

            }
        }
    });
    let token = $('meta[name="csrf_token"]').attr("content");
    let url_hapus = "{{url('hapus_kelas_virtual_sespimmen')}}";
    let edit_kelas_virtual = "{{url('edit_kelas_virtual_sespimmen')}}";
    let list_serdik_kelas_virtual = "{{url('list_serdik_kelas_virtual_sespimmen')}}";
    let url_img = "{{asset('admin/sespimmen/foto_serdik')}}";
    let _token = "{{csrf_token()}}";
    let html = ``;
    $('#edit_kelas_virtual').click(() => {
        $.ajax({
            url: edit_kelas_virtual,
            method: "POST",
            data: {
                _token: token,
                id: id_kelas_virtual
            },
            success: (response) => {
                $.each(response, function(i, val) {
                    html += `
                            
                                <div class="card mb-3 p-4" style="box-shadow: 1px 2px #eee">
                                
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="hidden" name="id[]" class="form-control" value="${val.id}" />
                                    <input type="text" name="judul[]" class="form-control" value="${val.judul}">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi[]" id="" cols="30" rows="3" value="${val.deskripsi}">${val.deskripsi}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" name="link[]" value="${val.link}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="meeting_id">Meeting ID</label>
                                    <input type="text" name="meeting_id[]" class="form-control" value="${val.meeting_id}">
                                </div>
                                <div class="form-group">
                                    <label for="passcode">Passcode</label>
                                    <input type="text" name="passcode[]" class="form-control" value="${val.passcode}">
                                </div>
                                <div class="form-group">
                                    <label for="schedule">Schedule</label>
                                    <input type="text" name="schedule[]" value="${val.schedule}" class="form-control">
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

    $('#hapus_kelas_virtual').click(function() {
        if (confirm("Apa anda yakin?")) {
            $.ajax({
                url: url_hapus,
                method: "POST",
                data: {
                    _token: token,
                    id: id_kelas_virtual
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

    $("#tambah_kelas_virtual").click(() => {
        $('#modalAdd').modal('show');
    });
</script>
@endsection