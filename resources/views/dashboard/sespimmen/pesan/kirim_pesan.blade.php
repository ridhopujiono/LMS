@extends('dashboard/template/main')
    @section('content')
    
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
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">
                    Kirim Pesan
                </div>
            </div>
            <div class="ibox-body">
                @if(session("success"))
                    <div class="alert alert-success">Berhasil mengirim pesan!</div>
                @endif
                <div class="row">
                    <div class="col">
                        <form action="{{url('post_pesan_sespimmen')}}" method="POST">
                        @csrf
                            
                        <div class="form-group">
                                <label for="">Sifat Pesan</label>
                                <select class="form-control" name="sifat_pesan" id="">
                                    <option value="null">-- Silahkan Pilih --</option>
                                    <option value="private">Private</option>
                                    <option value="broadcast">Broadcast (SEMUA)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tujuan</label>
                                <select class="form-control" name="tujuan" id="">
                                    <option value="null">-- Silahkan Pilih --</option>
                                    <option value="gadik">Gadik</option>
                                    <option value="serdik">Serdik</option>
                                </select>
                            </div>
                            <div class="form-group atas_nama">
                                <label for="">Atas Nama</label>
                                <select class="form-control" disabled class="form-control" name="atas_nama_tujuan" id="atas_nama_tujuan">
                                    
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="">Judul Pesan</label>
                                <textarea class="form-control" name="judul" id="" cols="30" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Pesan</label>
                                <textarea class="form-control" name="pesan" id="" cols="30" rows="7"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Kirim Pesan</button>
                            </div>
                            <input type="text" style="display: none;" name="nama">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    
    <script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
    
    <script>
        $(document).ready(function(){
            let url_tujuan;
            function get_list_user(url_tujuan){
                let option_html = ``;
                $.ajax({
                    url: url_tujuan,
                    method: "GET",
                    success: function(response){
                        $.each(response, function(i, val){
                            option_html += `<option value="${val.id}">${val.name}</option>`;
                        });
                    },
                    error: function(err){
                        console.log(err);
                    }
                });

                return option_html;
                
            }
            $("select[name='sifat_pesan']").change(function(){
                if($(this).val() == "broadcast"){
                    $(".atas_nama").hide();
                }else if($(this).val() == "private"){
                    $(".atas_nama").show();
                    $("select[name='atas_nama_tujuan']").prop('disabled', false);
                }else{
                    $("select[name='atas_nama_tujuan']").prop('disabled', true);
                }
            });
            
            let option_html = ``;
            let url_user_gadik = "{{url('get_gadik_from_pesan_sespimmen')}}";
            let url_user_serdik = "{{url('get_serdik_from_pesan_sespimmen')}}";
            let container = ``;
            $("select[name='tujuan']").change(function(){
                if($(this).val() == "gadik"){

                    $.ajax({
                        url: url_user_gadik,
                        method: "GET",
                        success: function(response){
                            option_html = `<option value="" data-id="" class="option_html">-- Silahkan Pilih --</option>`;
                            $.each(response, function(i, val){
                                option_html += `<option value="${val.id}" data-id="${val.name}" class="option_html">${val.name}</option>`;
                            });
                            $("select[name='atas_nama_tujuan']").html(option_html)

                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                    
                }else if($(this).val() == "serdik"){
                    $.ajax({
                        url: url_user_serdik,
                        method: "GET",
                        success: function(response){
                            option_html = `<option value="" data-id="" class="option_html">-- Silahkan Pilih --</option>`;
                            $.each(response, function(i, val){
                                option_html += `<option value="${val.id}" data-id="${val.name}" class="option_html">${val.name}</option>`;
                            });
                            $("select[name='atas_nama_tujuan']").html(option_html)

                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                    
                }
                
                option_html = ``;
            });
            $("select[name='atas_nama_tujuan']").change(function(){
                let data = $("#atas_nama_tujuan option:selected").attr("data-id");
                $("input[name='nama']").val(data);
            });
        });

    </script>
    @endsection