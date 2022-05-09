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
                                    Data Kurikulum
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{url('post_kurikulum_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul Kurikulum</label>
                            <input type="text" name="judul" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Kurikulum</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">File Kurikulum</label>
                            <input type="file" name="file" id="file" class="form-control">
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