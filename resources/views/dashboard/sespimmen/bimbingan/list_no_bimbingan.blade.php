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
        <h1 class="page-title">Bimbingan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href=""><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Nomer WhatsApp Gadik</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Kontak Gadik</div>

            </div>
            <div class="ibox-body">
                <table class="
              table
              table-responsive
              table-striped
              table-bordered
              table-hover
            " id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Foto</th>
                            <th>Nama</th>
                            <th>Nomer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gadik as $g)
                        <tr>
                            <td><img src="{{url('admin/sespimmen/foto_gadik')}}/{{$g->foto}}" width="75px" /></td>
                            <td>{{$g->nama_gadik}}</td>
                            <td>{{$g->no_telp}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

<script>
    $("#example-table").DataTable({
        paginate: 10
    })
</script>

@endsection