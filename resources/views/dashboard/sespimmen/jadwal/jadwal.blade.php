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
                                Data Jadwal Belajar
                            </div>
                        </div>
                        <div class="col-6 text-right text-white">
                            <div class="d-inline-block">
                                @if(auth()->user()->level == "admin")
                                <a class="btn btn-primary" href="#" id="tambah_jadwal_belajar"><span class="fa fa-plus"></span> tambah</a>
                                <!-- <a class="btn btn-info" id="edit_jadwal_belajar"><span class="fa fa-pencil"></span> edit</a> -->
                                <a class="btn btn-danger" id="hapus_jadwal_belajar"><span class="fa fa-trash"></span> hapus</a>
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
                                <th width="5%" style="text-align: center">#</th>
                                <th width="5%" style="text-align: center">NO</th>
                                <th style="text-align: center">Hari</th>
                                <th style="text-align: center">Tanggal</th>
                                <th style="text-align: center">Waktu</th>
                                <th style="text-align: center">Mata Kuliah</th>
                                <th style="text-align: center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td width="10%" style="text-align: center;vertical-align:middle;"><input type="checkbox" name="" id="" value="{{$d->id}}"></td>
                                <td width="10%" style="text-align: center; vertical-align:middle;">{{$no++}}</td>
                                <td style="text-align: center; text-transform: capitalize;vertical-align:middle;">{{$d->hari}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->tanggal}}</td>
                                <td style="text-align: center; vertical-align:middle;">
                                    {{$d->start}} s/d {{$d->end}}
                                </td>
                                <td style="text-align: center; vertical-align:middle;">
                                    @foreach($matkul as $m)
                                    @if($m->id == $d->mata_kuliah)
                                    {{$m->nama_mata_kuliah}}
                                    @endif
                                    @endforeach
                                </td>

                                <td style="text-align: center;vertical-align:middle;">
                                    <a class="btn btn-danger text-white list-detail" href="{{url('detail_jadwal_belajar_sespimmen')}}/{{$d->id}}"><span class="fa fa-eye"></span> detail</a>
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
                <h5 class="modal-title" id="modalDetailLabel">Edit Data Jadwal Belajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{url('update_jadwal_belajar_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data" id="modal-detail-body">

                </form>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Tambah Data Jadwal Belajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('post_jadwal_belajar_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" class="form-control">
                            <option value="">-- Silakan pilih hari --</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input class="form-control" type="date" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <div class="row">
                            <div class="col-5">
                                <input class="form-control" type="time" name="start">
                            </div>
                            <div class="d-flex align-items-center text-center offset-1">
                                s/d
                            </div>
                            <div class="col-5">
                                <input class="form-control" type="time" name="end">

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Mata Kuliah</label>
                        <select class="form-control" name="id_mata_kuliah" id="">
                            <option value="">-- Silahkan pilih mata_kuliah --</option>
                            @foreach($matkul as $mk)
                            <option value="{{$mk->id}}">{{$mk->nama_mata_kuliah}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Metode</label>
                                <select class="form-control" name="id_metode" id="">
                                    <option value="">-- Silahkan pilih metode --</option>
                                    @foreach($metode as $m)
                                    <option value="{{$m->id}}">{{$m->nama_metode}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-6">
                                <label for="">Tempat</label>
                                <input class="form-control" type="text" name="tempat">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="" cols="30" rows="5" placeholder="contoh. (link kelas, meeting id, passcode)"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Dosen 1</label>
                        <select class="form-control" name="dosen_1" id="">
                            <option value="">-- Silahkan pilih --</option>
                            @foreach($gadik as $g)
                            <option value="{{$g->id}}">{{$g->nama_gadik}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Dosen 2</label>
                        <select class="form-control" name="dosen_2" id="">
                            <option value="">-- Silahkan pilih --</option>
                            @foreach($gadik as $g)
                            <option value="{{$g->id}}">{{$g->nama_gadik}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pawas 1</label>
                        <select class="form-control" name="pawas_1" id="">
                            <option value="">-- Silahkan pilih --</option>
                            @foreach($gadik as $g)
                            <option value="{{$g->id}}">{{$g->nama_gadik}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pawas 2</label>
                        <select class="form-control" name="pawas_2" id="">
                            <option value="">-- Silahkan pilih --</option>
                            @foreach($gadik as $g)
                            <option value="{{$g->id}}">{{$g->nama_gadik}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pokjar</label>
                        <select class="form-control" name="id_pokjar" id="">
                            <option value="">-- Silahkan pilih --</option>
                            @foreach($pokjar as $p)
                            <option value="{{$p->id}}">{{$p->nama_pokjar}}</option>
                            @endforeach
                        </select>
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

    let id_jadwal_belajar = [];
    $('input[type="checkbox"]').click(function() {
        if ($(this).prop("checked") == true) {
            id_jadwal_belajar.push($(this).val());
        } else if ($(this).prop("checked") == false) {
            for (var i = 0; i < id_jadwal_belajar.length; i++) {

                if (id_jadwal_belajar[i] === $(this).val()) {

                    id_jadwal_belajar.splice(i, 1);
                }

            }
        }
    });
    let token = $('meta[name="csrf_token"]').attr("content");
    let url_hapus = "{{url('hapus_jadwal_belajar_sespimmen')}}";
    let _token = "{{csrf_token()}}";
    $('#hapus_jadwal_belajar').click(function() {
        if (confirm("Apa anda yakin?")) {
            $.ajax({
                url: url_hapus,
                method: "POST",
                data: {
                    _token: token,
                    id: id_jadwal_belajar
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

    $("#tambah_jadwal_belajar").click(() => {
        $('#modalAdd').modal('show');
    });
</script>


@endsection