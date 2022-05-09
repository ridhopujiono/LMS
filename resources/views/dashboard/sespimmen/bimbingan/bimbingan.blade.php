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
        <h1 class="page-title">Perkuliahan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href=""><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Bimbingan</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row">

            <!-- TAMBAH KEGIATAN SERDIK -->
            <div class="col-12 text-white" style="margin-bottom: 5px;">
                <div class="d-inline-block">
                    <a class="btn btn-xs btn-primary" id="btn-add">
                        <!-- @note: Lari ke halaman Bimbingan_Tambah_NEW -->
                        <span class="fa fa-plus"></span> Tambah
                    </a>
                </div>
            </div>

            <!-- KEGIATAN SERDIK -->
            <div class="col-md-8">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Kegiatan Serdik</div>
                        <form action="{{url('bimbingan_sespimmen')}}" method="POST" class="col-md-8">
                            @csrf
                            <select onchange="this.form.submit()" class="form-control " name="pokjar">
                                <option value="0">SEMUA</option>
                                @foreach($pj as $p)
                                @if($pokjar_aktif == $p->id)
                                <option selected value="{{$p->id}}">{{$p->nama_pokjar}}</option>
                                @else

                                <option value="{{$p->id}}">{{$p->nama_pokjar}}</option>

                                @endif
                                @endforeach
                            </select>

                        </form>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>

                    <div class="ibox-body">
                        @foreach($data as $d)
                        <div class="card" style="width: 100%">
                            <img class="card-img-top" src="{{url('admin/sespimmen/file_bimbingan')}}/{{$d->file}}" height="500px" />
                            <div class="card-body">
                                <h5 class="card-text font-bold">{{$d->nama_serdik}}</h5><br>
                                <h4 class="card-title font-bold">{{$d->judul_kegiatan}}</h4>



                                <div class="card-subtitle">{{$d->deskripsi_kegiatan}}</div>
                                <div class="text-success">{{$d->created_at}}</div>
                            </div>
                        </div><br>
                        @endforeach

                        {{$data->links()}}

                    </div>

                </div>
            </div>
            @if(auth()->user()->level == "serdik" || auth()->user()->level == "admin")
            <!-- KONTAK GADIK -->
            <div class="col-md-4">
                <div class="ibox">
                    <!-- JUDUL -->
                    <div class="ibox-head">
                        <div class="ibox-title">Konsultasi Privat</div>
                    </div>

                    <!-- NOMER WA GADIK -->
                    <div class="ibox-body">
                        <!-- NOMER WA -->
                        @foreach($gadik as $g)
                        <div class="ibox-body" style="background-color: #f7f7f7; margin-bottom: 5px; padding-bottom: 25px">

                            <div class=" form-group font-strong">

                                <!-- IMAGE CONTAINER -->
                                <div style="
                                    display: flex;
                                    flex-direction: row;
                                    height: 50px;">

                                    <!-- IMAGE AREA -->
                                    <div style="
                                        align-self: center;
                                        margin-top: 18px;">

                                        <!-- YELLOW CIRCLE -->
                                        <div style="
                                        width: 60px;
                                        height: 60px;
                                        background-color: #EFDC35;
                                        border-radius: 100%;">

                                            <!-- IMAGE FILE -->
                                            <img src="{{asset('admin/sespimmen/foto_gadik')}}/{{$g->foto}}" style="
                                            width: 50px;
                                            height: 50px;
                                            margin-left: 5px;
                                            margin-top: 5px;
                                            background-color: green;
                                            border-radius: 100%;" />

                                            <!-- WHATSAPP ICON -->
                                            <img src="{{url('admin/sespimmen/wa.png')}}" style="
                                            width: 25px;
                                            position: absolute;
                                            margin-left: -10px;" />
                                        </div>
                                    </div>

                                    <!-- NUMBER AREA -->
                                    <div style="
                                    display: flex;
                                    flex-direction: column;              
                                    margin-left: 20px;">

                                        <div style="
                                        background-color: #EFDC35;
                                        width: 180px;
                                        padding: 5px;
                                        margin-bottom: 2px;">
                                            <div style="font-size: .8em; font-weight: 600;">{{$g->nama_gadik}}</div>
                                        </div>

                                        <div style="
                                        background-color: #C4C4C4;
                                        padding: 5px;
                                        width: 180px;">
                                            <a href="https://wa.me/15551234567" style="
                                            color: #000;
                                            font-size: .7em; 
                                            font-weight: 600;">{{$g->no_telp}}</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- TULISAN LIHAT SELENGKAPNYA -->
                        <div class="form-group" style="padding: 10px;">
                            <a href="{{url('list_lengkap_gadik')}}">Lihat selengkapnya ...</a>
                        </div>
                    </div>

                </div>
            </div>

            @elseif(auth()->user()->level == "gadik")

            <!-- KONTAK GADIK -->
            <div class="col-md-4">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Kontak Anda</div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{url('post_edit_no_telp')}}/{{$gadik->id}}" method="POST">
                            @csrf
                            <div class="form-group font-strong">
                                <label>{{$gadik->nama_gadik}}</label>
                                <input class="form-control" type="text" placeholder="@if(empty($gadik->no_telp)) NO ANDA MASIH KOSONG @else {{$gadik->no_telp}} @endif" disabled="" name="no_telp">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 0.8em; color: dimgray">Informasi ini digunakan agar peserta didik dapat menghubungi Anda untuk bimbingan.</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-edit" type="button">Edit Kontak</button>
                                <button class="btn btn-primary btn-simpan d-none" type="submit">Simpan</button>
                                <!-- 
                                @note: Setelah di klik "Edit No. Telp." Lari ke halaman "Bimbingan_Edit.html" di folder GADIK
                             -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </div>

    <!-- END PAGE CONTENT-->
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Upload Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('post_bimbingan_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="judul">Deskripsi</label>
                        <textarea type="text" name="deskripsi" class="form-control"></textarea>
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


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script>
    $(".btn-edit").on("click", function() {
        $(".btn-edit").addClass('d-none');
        $(".btn-simpan").removeClass('d-none');
        $("input[name='no_telp']").removeAttr('disabled');
        $("input[name='no_telp']").focus();
    });
    $("#btn-add").on("click", function() {
        $("#modalAdd").modal("show");
    });
</script>
</script>
@endsection