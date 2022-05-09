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
                                Data Gadik
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="ibox-body">
                <form action="{{url('post_gadik_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group d-none">
                        <input type="text" name="bagian" value="{{auth()->user()->bagian}}" class="d-none">
                    </div>
                    <div class="form-group">
                        <label for="nama_gadik">Nama Gadik</label>
                        <input type="text" name="nama_gadik" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pangkat">Pangkat</label>
                        <input type="text" name="pangkat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lp">Jenis Kelamin</label>
                        <select name="lp" id="" class="form-control">
                            <option value="-">--- Silahkan Pilih ---</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_gadik">Jenis Gadik</label>
                        <input type="text" name="jenis_gadik" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. Telp</label>
                        <input type="text" name="no_telp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

@endsection