@extends('dashboard/template/main')
    @section('content')
    <link href="{{asset('dashboard/dist/assets/css/pages/mailbox.css')}}" rel="stylesheet" />
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
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12">
                        <div class="ibox" id="mailbox-container">
                            <div class="mailbox-header d-flex justify-content-between" style="border-bottom: 1px solid #e8e8e8;">
                                <div>
                                    <h5 class="inbox-title">{{$data->judul}}</h5>
                                    <div class="m-t-5 font-13">
                                        <span class="font-strong">{{$data->to_level}}</span>
                                        @if($data->nama == NULL)
                                        <a class="text-muted m-l-5" href="javascript:;">Broadcast</a>

                                        @else
                                        <a class="text-muted m-l-5" href="javascript:;">{{$data->nama}}</a>
                                        @endif
                                    </div>
                                    <div class="p-r-10 font-13">{{$data->created_at}}</div>
                                </div>
                            </div>
                            <div class="mailbox-body">
                                {{$data->pesan}}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
    </div>
    
    
    <script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    
    @endsection