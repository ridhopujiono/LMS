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
        <h1 class="page-title">Perkuliahan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href=""><i class="la la-home font-20"></i></a>
            </li>

        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="row row-card-mobile">

            <div class="col-lg-3 col-md-6">
                <a href="{{url('lihat_penilaian_sespimmen')}}">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">

                            <div class="m-b-5">Lihat Penilaian</div><i class="fa fa-eye widget-stat-icon" style="
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            "></i>
                            <div><i class=" m-r-5"></i><small></small></div>
                        </div>
                    </div>
                </a>
            </div>
            @if(auth()->user()->level == "gadik" || auth()->user()->level == "admin")
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <a href="{{url('penilaian_sespimmen')}}" style="text-decoration: none; color: white">
                        <div class="ibox-body">

                            <div class="m-b-5">Input Nilai</div><i class="fa fa-pencil widget-stat-icon" style="
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        "></i>
                            <div><i class=" m-r-5"></i><small></small></div>
                        </div>
                    </a>
                </div>
            </div>
            @endif
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
</style>
<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Data Serdik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " id="modal-detail-body">

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

    let id_serdik = [];
    $('input[type="checkbox"]').click(function() {
        if ($(this).prop("checked") == true) {
            id_serdik.push($(this).val());
        } else if ($(this).prop("checked") == false) {
            for (var i = 0; i < id_serdik.length; i++) {

                if (id_serdik[i] === $(this).val()) {

                    id_serdik.splice(i, 1);
                }

            }
        }
    });
    let token = $('meta[name="csrf_token"]').attr("content");
    let url_hapus = "{{url('hapus_serdik_sespimmen')}}";
    let url_detail = "{{url('detail_serdik_sespimmen')}}";
    let url_img = "{{asset('admin/sespimmen/foto_serdik')}}";
    let html = ``;
    $('#detail_serdik').click(() => {
        $.ajax({
            url: url_detail,
            method: "POST",
            data: {
                _token: token,
                id: id_serdik
            },
            success: (response) => {
                $.each(response[0], function(i, val) {
                    html += `<div class="card mb-3">
                                <form action="" class="p-3" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for=""><b>Nama serdik</b></label>
                                        <p>${val.nama_serdik}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Username</b></label>
                                        <p>${val.username}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Pangkat</b></label>
                                        <p>${val.pangkat}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Kode</b></label>
                                        <p>${val.kode}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Jabatan</b></label>
                                        <p>${val.jabatan}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Jenis Kelamin</b></label>
                                        <p>${val.lp}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>No. Serdik</b></label>
                                        <p>${val.no_serdik}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>No. Telp</b></label>
                                        <p>${val.no_telp}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Pokjar</b></label>`;
                    $.each(response[1], function(j, val2) {
                        if (val2.id == val.pokjar) {
                            html += `<p>${val2.nama_pokjar}</p>`;
                        }
                    })

                    html += `</div>
                                    <div class="form-group">
                                        <label for=""><b>Foto</b></label>
                                        <br>
                                        <img width="150px" src="${url_img}/${val.foto}">
                                    </div>
                                    
                                </form>
                            </div>`;
                });


                $('#modal-detail-body').html(html);
                $('#modalDetail').modal('show');
                html = ``;
            },
            error: (err) => {
                console.log(err);
            }
        });
    });

    $('#hapus_serdik').click(function() {
        if (confirm("Apa anda yakin?")) {
            $.ajax({
                url: url_hapus,
                method: "POST",
                data: {
                    _token: token,
                    id: id_serdik
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
</script>
@endsection