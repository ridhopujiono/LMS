@extends('dashboard/template/main')
@section('content')
<link href="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
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
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="ibox-title">
                                Data Tugas Akhir
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="ibox-body">
                <form action="{{url('post_tugas_akhir_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Tugas</label>
                        <textarea type="text" class="form-control" name="nama_tugas"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Mata Kuliah</label>
                        <select class="form-control" name="id_mata_kuliah" id="">
                            <option value="">-- Silahkan pilih mata kuliah --</option>
                            @foreach($matkul as $mk)
                            <option value="{{$mk->id}}">{{$mk->nama_mata_kuliah}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kepada</label>
                        <select class="form-control" name="sifat_tujuan" id="">
                            <option value="all">Broadcast (SEMUA)</option>


                        </select>

                    </div>
                    <div class="form-group">
                        <label>Batas Pengerjaan (Tanggal dan waktu)</label>
                        <div class="row">
                            <div class="col">
                                <input class="form-control" name="deadline" type="date" placeholder="">
                            </div>
                            <div class="col">
                                <input class="form-control" name="end" type="time" placeholder="">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="file">File Tugas</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script>
    $(document).ready(function() {});
</script>
@endsection