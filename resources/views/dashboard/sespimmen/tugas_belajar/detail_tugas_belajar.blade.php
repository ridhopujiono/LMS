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
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Tugas Belajar</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Detail Tugas</div>
                    </div>
                    <div class="ibox-body">
                        <form action="">
                            <div class="form-group">
                                <label>Penerima</label>

                                @if(!empty($pokjar))
                                @for($i = 0; $i < count($pokjar); $i++) @if($data->pokjar == $pokjar[$i]->id)

                                    <input class="form-control" type="text" placeholder="" disabled="" value="{{$pokjar[$i]->nama_pokjar}}">
                                    @endif
                                    @endfor
                                    @else
                                    <input class="form-control" type="text" placeholder="" disabled="" value="ALL">
                                    @endif

                            </div>
                            <div class="form-group">
                                <label>Batas Waktu</label>
                                <input class="form-control" type="text" value="{{$data->deadline}}, {{$data->end}}" placeholder="" disabled="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Tugas Dikumpulkan</div>
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
                            <th>Pengirim</th>
                            <th>POKJAR</th>
                            <th>Dikirim</th>
                            <th>Nilai</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($pengupload as $pu)
                            @foreach($data_serdik as $ds)
                            @if($pu->id_serdik == $ds->id)
                            <td>{{$ds->nama_serdik}}</td>
                            @endif
                            @endforeach

                            @foreach($data_pokjar as $dp)
                            @if($pu->pokjar == $dp->id)
                            <td>{{$dp->nama_pokjar}}</td>
                            @endif
                            @endforeach


                            <td>{{$pu->created_at}}</td>
                            <td>{{$pu->nilai}}</td>
                            <td>
                                <a class="btn btn-xs btn-success text-white" download="" href="{{url('admin/sespimmen/file_upload_tugas_belajar')}}/{{$pu->file}}">
                                    <i class="fa fa-download"></i>
                                    <small><b>Unduh</b></small>
                                </a>
                                <a class="btn btn-xs btn-info text-white btn-lihat-tugas" href="{{url('admin/sespimmen/file_upload_tugas_belajar')}}/{{$pu->file}}">
                                    <i class="fa fa-eye"></i>
                                    <small><b>Lihat</b></small>
                                </a>
                                <a class="btn btn-xs btn-primary text-white btn-nilai" href="{{$pu->id}}">
                                    <i class="fa fa-pencil"></i>
                                    <small><b>Nilai</b></small>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Berikan Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" name="form-nilai" class="p-3" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama_pokjar">Nilai</label>
                        <input type="text" name="nilai" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLihatTugas" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe class="frame-pdf" src="" style="
                    width: 100%;
                    height: 100vh;
                " frameborder="0"></iframe>
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
            pageLength: 100,
        });
    });
    let url_post_nilai = "{{url('post_nilai_tugas_belajar')}}";
    $(".btn-nilai").on("click", function(e) {
        e.preventDefault();
        // alert($(this).attr('href'));
        $("form[name='form-nilai']").attr('action', url_post_nilai + "/" + $(this).attr('href'));
        $("#modalAdd").modal('show');
    });

    $(".btn-lihat-tugas").on("click", function(e) {
        e.preventDefault();
        let href = $(this).attr('href');
        $(".frame-pdf").attr('src', href);
        $("#modalLihatTugas").modal('show');
    });
</script>
@endsection