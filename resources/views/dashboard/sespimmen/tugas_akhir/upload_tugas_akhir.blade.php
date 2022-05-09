@extends('dashboard/template/main')
@section('content')
<link href="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title"></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href=""><i class="la la-home font-20"></i></a>
            </li>

        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title" style="text-transform: uppercase;">{{$data->nama_tugas}}</div>
                    </div>
                    <div class="ibox-body">
                        <div id="container-tugas">
                            <div class="form-group">
                                <label>Matkul</label>
                                @foreach($matkul as $m)
                                @if($data->id_matkul == $m->id)
                                <input type="text" disabled placeholder="{{$m->nama_mata_kuliah}}" class="form-control">
                                <input type="text" placeholder="{{$m->id}}" class="d-none form-control">
                                @endif
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Pengirim</label>
                                @foreach($gadik as $g)
                                @if($data->id_gadik == $g->id)
                                <input type="text" disabled placeholder="{{$g->nama_gadik}}" class="form-control">
                                <input type="text" placeholder="{{$g->id}}" class="d-none form-control">
                                @endif
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Dikirim</label>
                                <input class="form-control" type="text" placeholder="{{$data->created_at}}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Batas Waktu</label>
                                <input class="form-control" type="text" placeholder="{{$data->deadline}}, {{$data->end}}" disabled="">
                            </div>
                            <div class="form-group">
                                <a class="btn btn-success btn-block" href="{{url('admin/sespimmen/file_tugas_akhir')}}/{{$data->file}}" download="{{$data->nama_tugas}}"><span class="fa fa-download mr-2"></span>Unduh Tugas</a>
                            </div>
                        </div>
                        <div class="form-group form-penyerahan d-none">
                            <div class="alert alert-info name-file-tugas"></div>
                            <form action="{{url('upload_tugas_akhir_sespimmen')}}/{{$data->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="d-none" type="file" name="file_upload" id="input_file">
                                <button class="btn btn-primary btn-block" type="submit"><span class="fa fa-upload mr-2"></span>Serahkan!</button>
                            </form>

                        </div>
                        @if($status_upload == 1)
                        <div class="form-group">
                            <div class="alert alert-info">Anda sudah upload tugas</div>
                        </div>
                        @else
                        <div class="form-group">
                            <button id="btn_input_file" class="btn btn-light btn-block" style="box-shadow: 1px 3px 4px #eee;"><span class="fa fa-plus mr-2"></span>Upload Tugas</button>


                        </div>
                        @endif



                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script>
    document.getElementById('btn_input_file').addEventListener('click', () => {
        document.getElementById('input_file').click();
    });
    var fileInput = document.getElementById('input_file');
    fileInput.onchange = function(e) {
        var input = this.files[0];
        if (input) {
            $("#container-tugas").hide();
            $(".form-penyerahan").removeClass('d-none');
            $(".name-file-tugas").html(e.target.files[0].name)
        } else {}
    };
</script>
@endsection