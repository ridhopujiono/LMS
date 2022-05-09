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
                    @foreach($data as $d)
                    <form action="{{url('update_gadik_sespimmen')}}" class="p-3" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$d->id}}">
                        <div class="form-group">
                            <label for="nama_gadik">Nama Gadik</label>
                            <input type="text" name="nama_gadik" class="form-control" value="{{$d->nama_gadik}}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="{{$d->username}}">
                        </div>
                        <div class="form-group">
                            <label for="pangkat">Pangkat</label>
                            <input type="text" name="pangkat" class="form-control" value="{{$d->pangkat}}">
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input type="text" name="kode" class="form-control" value="{{$d->kode}}">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" value="{{$d->jabatan}}">
                        </div>
                        <div class="form-group">
                            <label for="lp">Jenis Kelamin</label>
                            <select name="lp" id="" class="form-control">
                                @if($d->lp == "L")
                                <option selected value="L">L</option>
                                <option value="P">P</option>
                                @else
                                <option value="L">L</option>
                                <option selected value="P">P</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis_gadik">Jenis Gadik</label>
                            <input type="text" name="jenis_gadik" class="form-control" value="{{$d->jenis_gadik}}">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No. Telp</label>
                            <input type="text" name="no_telp" class="form-control" value="{{$d->no_telp}}">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        
                    </form>

                    @endforeach
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
    </script>
    @endsection