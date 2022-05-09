@extends('dashboard/template/main')
@section('content')
<link href="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
<style>
    .btn {
        padding: .2rem .75rem;
        font-size: 13px;
    }

    .modal-open .modal {
        background: #333333ad;
    }

    td {
        vertical-align: middle;
    }

    @media only screen and (max-width: 768px) {
        .btn {
            padding: .05rem .05rem;
            display: inline-block;
            line-height: 1.25rem;
            font-size: 6px !important;
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
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="ibox-title">
                                Data Serdik
                            </div>
                        </div>
                        <div class="col-6 text-right text-white">
                            <div class="d-inline-block">
                                @if(auth()->user()->level == "admin")
                                <a class="btn btn-primary" href="{{url('tambah_serdik_sespimmen')}}"><span class="fa fa-plus"></span> tambah</a>
                                <a class="btn btn-info" id="detail_serdik"><span class="fa fa-eye"></span> detail</a>
                                <a class="btn btn-danger" id="hapus_serdik"><span class="fa fa-trash"></span> hapus</a>
                                @else
                                <a class="btn btn-info" id="detail_serdik"><span class="fa fa-eye"></span> detail</a>
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
                                <th>#</th>
                                <th>NO</th>
                                <th>Nama serdik</th>
                                <th>Username</th>
                                <th>Pangkat</th>
                                <th>NRP/KODE</th>
                                <th>Jabatan</th>
                                <th>Pokjar</th>
                                @if(auth()->user()->level == "admin")
                                <th>Ubah</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td><input type="checkbox" name="" id="" value="{{$d->id}}"></td>
                                <td>{{$no++}}</td>
                                <td>{{$d->nama_serdik}}</td>
                                <td>{{$d->username}}</td>
                                <td>{{$d->pangkat}}</td>
                                <td>{{$d->kode}}</td>
                                <td>{{$d->jabatan}}</td>
                                <td>
                                    @foreach($pokjar as $p)
                                    @if($d->pokjar == $p->id)
                                    {{$p->nama_pokjar}}
                                    @endif
                                    @endforeach
                                </td>
                                @if(auth()->user()->level == "admin")
                                <td><a class="btn btn-danger text-white" href="{{url('edit_serdik_sespimmen')}}/{{$d->id}}"><span class="fa fa-pencil"></span> edit</a></td>
                                @endif
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
    .modal-content {
        height: 90vh;
        overflow-y: auto;
        background-color: rgb(235, 235, 235);
    }

    .modal-header {
        background-color: #fff;
        box-shadow: 3px 3px 3px #eaeaea;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Data Serdik</h5>
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

    let id_serdik = [];
    $('input[type="checkbox"]').click(function() {
        if ($(this).prop("checked") == true) {
            id_serdik.push($(this).val());
        } else if ($(this).prop("checked") == false) {
            for (var i = 0; i < id_serdik.length; i++) {

                if (id_serdik[i] === $(this).val()) {

                    id_serdik.splice(i, 1);
                }

            }
        }
    });
    let token = $('meta[name="csrf_token"]').attr("content");
    let url_hapus = "{{url('hapus_serdik_sespimmen')}}";
    let url_detail = "{{url('detail_serdik_sespimmen')}}";
    let url_img = "{{asset('admin/sespimmen/foto_serdik')}}";
    let html = ``;
    $('#detail_serdik').click(() => {
        $.ajax({
            url: url_detail,
            method: "POST",
            data: {
                _token: token,
                id: id_serdik
            },
            success: (response) => {
                $.each(response[0], function(i, val) {
                    html += `<div class="card mb-3">
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
                                        <label for=""><b>Pokjar</b></label>`;
                    $.each(response[1], function(j, val2) {
                        if (val2.id == val.pokjar) {
                            html += `<p>${val2.nama_pokjar}</p>`;
                        }
                    })

                    html += `</div>
                                    <div class="form-group">
                                        <label for=""><b>Foto</b></label>
                                        <br>
                                        <img width="150px" src="${url_img}/${val.foto}">
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

    $('#hapus_serdik').click(function() {
        if (confirm("Apa anda yakin?")) {
            $.ajax({
                url: url_hapus,
                method: "POST",
                data: {
                    _token: token,
                    id: id_serdik
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
</script>
@endsection