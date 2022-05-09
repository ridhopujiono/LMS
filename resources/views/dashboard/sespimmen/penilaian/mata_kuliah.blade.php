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
                                List Mata Pelajaran
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
                                <th width="5%" style="text-align: center">NO</th>
                                <th style="text-align: center">Kode Mata Kuliah</th>
                                <th style="text-align: center">Nama Mata Kuliah</th>
                                <th style="text-align: center">Jam Kuliah</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>

                                <td width="10%" style="text-align: center; vertical-align:middle;">{{$no++}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->kode_mata_kuliah}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->nama_mata_kuliah}}</td>
                                <td style="text-align: center; vertical-align:middle;">{{$d->jp}}</td>

                                <td><a class="btn btn-info text-white" href="{{url('detail_tugas_serdik')}}/{{$d->id}}/{{$id_serdik}}"><span class="fa fa-eye"></span> List Tugas</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
</script>
@endsection