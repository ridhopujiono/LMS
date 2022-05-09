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

        .content-wrapper {
            padding: 0;
        }

        .page-content {
            padding-top: 0;
        }
    }
</style>
<div class="content-wrapper" style="">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        @if(auth()->user()->level == "admin")
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="ibox p-4" id="mailbox-container">
                    <div class="mailbox-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="d-none d-lg-block inbox-title"><i class="fa fa-envelope-o m-r-5 mb-3"></i> Pesan</h5>

                        </div>
                    </div>
                    <style>
                        td {
                            text-align: unset;
                        }

                        .mail-message {
                            text-transform: capitalize;
                        }
                    </style>
                    <div class="mailbox clf">
                        <table class="table table-hover table-inbox" id="table-inbox">
                            <thead>
                                <tr>
                                    <td>Tujuan</td>
                                    <td>Pesan</td>
                                    <td>Sifat Pesan</td>
                                    <td style="text-align: end;">Waktu</td>
                                    <td class="text-right">Opsi</td>
                                </tr>
                            </thead>
                            <tbody class="rowlinkx" data-link="row">
                                @foreach($data as $d)
                                <tr data-id="1">

                                    @if($d->nama == NULL)
                                    <td class="mail-message">{{$d->to_level}}</td>
                                    @else
                                    <td class="mail-message">{{$d->nama}}</td>

                                    @endif

                                    <td class="mail-message">{{Str::limit($d->pesan, 55, '.......')}}</td>
                                    @if($d->to == NULL)
                                    <td class="font-weight-bold">
                                        Broadcast
                                    </td>
                                    @else
                                    <td class="font-weight-bold">
                                        Private
                                    </td>
                                    @endif

                                    <td class="text-right">{{$d->created_at}}</td>
                                    <td class="text-right">
                                        <a href="{{url('detail_pesan_sespimmen')}}/{{$d->id}}" class="btn btn-danger">detail</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="card p-4" style="">
            <table>
                @foreach($data as $d)

                @if($d->to == auth()->user()->id)
                <tr style="color: brown; cursor: pointer" class="tr-link" data-url="{{url('detail_pesan_sespimmen')}}/{{$d->id}}">
                    <!-- private -->
                    <td>
                        <b>{{$d->name_from->name}} | {{$d->from_level}}</b>
                    </td>
                    <td style="text-align: end; font-weight: 200;">{{$d->created_at}}</td>
                    <!-- private -->


                </tr>
                <tr style="cursor: pointer" class="tr-link" data-url="{{url('detail_pesan_sespimmen')}}/{{$d->id}}">
                    <td colspan="2" style="text-align: justify;"><b>{{$d->judul}}</b> <br> {{Str::limit($d->pesan, 55, '.......')}}
                        <hr>
                    </td>

                </tr>
                @else
                @if($d->to == NULL && $d->to_level == auth()->user()->level)
                <tr style="color: brown; cursor: pointer" class="tr-link" data-url="{{url('detail_pesan_sespimmen')}}/{{$d->id}}">
                    <td><b>{{$d->name_from->name}} | {{$d->from_level}}</b></td>
                    <td style="text-align: end; font-weight: 200;">{{$d->created_at}}</td>
                </tr>
                <tr style="cursor: pointer" class="tr-link" data-url="{{url('detail_pesan_sespimmen')}}/{{$d->id}}">
                    <td colspan="2" style="text-align: justify;"><b>{{$d->judul}}</b> <br> {{Str::limit($d->pesan, 55, '.......')}}
                        <hr>
                    </td>
                </tr>
                @endif

                @endif
                @endforeach

            </table>
        </div>
        @endif

    </div>

</div>


<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>


<script>
    $(document).ready(function() {
        $(".tr-link").on("click", function() {
            window.location.href = $(this).data('url');
        });
    });
</script>
@endsection