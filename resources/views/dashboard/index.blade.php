@extends('dashboard/template/main')
@section('content')

<style>
    .row-card-mobile,
    .row-keterangan-mobile {
        display: none;
    }

    @media only screen and (max-width: 768px) {
        .col-logo {
            display: none;
        }

        .row-card-mobile,
        .row-keterangan-mobile {
            display: block;
        }

        .row-keterangan-desktop,
        .row-card-desktop {
            display: none;
        }
    }
</style>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">

        <!-- Desktop -->
        @if(auth()->user()->level == "serdik")

        @elseif(auth()->user()->level == "admin")
        <div class="row row-card-desktop">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong" id="txt_timer">...</h2>
                        <div class="m-b-5" id="txt_tanggal">...</div><i class="ti-time widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_serdik}}</h2>
                        <div class="m-b-5">Jumlah Serdik</div><i class="fa fa-user widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_gadik}}</h2>
                        <div class="m-b-5">Jumlah Gadik</div><i class="fa fa-users widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_chat}}</h2>
                        <div class="m-b-5">TOTAL PESAN</div><i class="fa fa-envelope widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i></div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(auth()->user()->level == "gadik")
        <div class="row row-card-desktop">

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_tugas}}</h2>
                        <div class="m-b-5">Total Tugas</div><i class="fa fa-user widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_tugas_akhir}}</h2>
                        <div class="m-b-5">Total Tugas Akhir</div><i class="fa fa-users widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_upload_tugas}}</h2>
                        <div class="m-b-5">Upload-an Tugas Serdik </div><i class="fa fa-envelope widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_upload_tugas_akhir}}</h2>
                        <div class="m-b-5">Upload-an Tugas Akhir Serdik</div><i class="fa fa-user widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
        </div>

        @endif
        <div class="row row-keterangan-desktop p-2">
            <div class="col-12 col-md-8">
                <div class="card p-4 " style="font-size: 16px; letter-spacing: 0.01rem; text-shadow: 0.1rem;">
                    <p>Assalamulaikum Wr.Wb <br>
                        Salam Sejahtera bagi kita semua, <br>
                        Om Swastiastu, Name Buddhaya, Salam Kebajikan
                        <br>
                        <br>
                        Learning Management System (LMS) ini merupakan piranti pendukung sistem pembelajaran jarak jauh berbaris digital Sespim Lemdiklat Polri. <br><br>
                        Dengan adanya LMS ini diharapkan dapat menjadi piranti utama dalam proses pembelajaran Sespim Lemdiklat Polri, dan dapat menjadi pemantik dalam peningkatan kualitas pendidikan di Sespim Lemdiklat Polri, guna mewujudkan kepemimpinan polri yang presisi di era Revolusi Industri 4.0. <br><br>
                        Silahkan anda menggunakan LMS ini dengan baik, sebagai bagian dari proses pembelajaran anda di Sespim Lemdiklat Polri.
                        <br><br>
                        Tetap semangat, Selamat belajar <br>
                        Salam Presisi <br><br>
                        Wassalamualaikum Wr. Wb.
                        <br><br><br>

                        Admin
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4 col-logo">
                <div class="card p-4">
                    <img src="{{asset('dashboard/logo-sespim.png')}}" alt="">
                </div>
            </div>
        </div>
        <!-- End Desktop -->

        <!-- Mobile -->
        <div class="row row-keterangan-mobile mb-3">
            <div class="col-12 col-md-8">
                <div class="card p-4 " style="font-size: 16px; letter-spacing: 0.01rem; text-shadow: 0.1rem;">
                    <p>Assalamulaikum Wr.Wb <br>
                        Salam Sejahtera bagi kita semua, <br>
                        Om Swastiastu, Namo Buddhaya, Salam Kebajikan
                        <br>
                        <br>
                        Learning Management System (LMS) ini merupakan piranti pendukung sistem pembelajaran jarak jauh berbaris digital Sespim Lemdiklat Polri. <br><br>
                        Dengan adanya LMS ini diharapkan dapat menjadi piranti utama dalam proses pembelajaran Sespim Lemdiklat Polri, dan dapat menjadi pemantik dalam peningkatan kualitas pendidikan di Sespim Lemdiklat Polri, guna mewujudkan kepemimpinan polri yang presisi di era Revolusi Industri 4.0. <br><br>
                        Silahkan anda menggunakan LMS ini dengan baik, sebagai bagian dari proses pembelajaran anda di Sespim Lemdiklat Polri.
                        <br><br>
                        Tetap semangat, Selamat belajar <br>
                        Salam Presisi <br><br>
                        Wassalamualaikum Wr. Wb.
                        <br><br><br>

                        Admin
                    </p>
                </div>
            </div>

        </div>
        @if(auth()->user()->level == "gadik")
        <div class="row row-card-mobile">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_tugas}}</h2>
                        <div class="m-b-5">Total Tugas</div><i class="fa fa-user widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_tugas_akhir}}</h2>
                        <div class="m-b-5">Total Tugas Akhir</div><i class="fa fa-users widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_upload_tugas}}</h2>
                        <div class="m-b-5">Upload-an Tugas Serdik </div><i class="fa fa-envelope widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_upload_tugas_akhir}}</h2>
                        <div class="m-b-5">Upload-an Tugas Akhir Serdik</div><i class="fa fa-user widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(auth()->user()->level == "admin")
        <div class="row row-card-mobile">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong" id="txt_timer2">...</h2>
                        <div class="m-b-5 " id="txt_tanggal2">...</div><i class="ti-time widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">300</h2>
                        <div class="m-b-5">Jumlah Serdik</div><i class="fa fa-user widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$total_gadik}}</h2>
                        <div class="m-b-5">Jumlah Gadik</div><i class="fa fa-users widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">108</h2>
                        <div class="m-b-5">PESAN MASUK</div><i class="fa fa-envelope widget-stat-icon"></i>
                        <div><i class=" m-r-5"></i><small>50 Dibaca, 58 Belum dibaca</small></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- End Mobile -->
    </div>
    <!-- END PAGE CONTENT-->
    @include('dashboard/template/footer')

</div>
<script src="{{asset('dashboard/dist/assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/dist/assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>

<script>
    function showTime() {
        var date = new Date();
        var h = date.getHours();
        var m = date.getMinutes();
        var s = date.getSeconds();
        var tahun = date.getFullYear();
        var bulan = date.getMonth();
        var tanggal = date.getDate();
        var hari = date.getDay();
        var session = "AM";

        switch (hari) {
            case 0:
                hari = "Minggu";
                break;
            case 1:
                hari = "Senin";
                break;
            case 2:
                hari = "Selasa";
                break;
            case 3:
                hari = "Rabu";
                break;
            case 4:
                hari = "Kamis";
                break;
            case 5:
                hari = "Jumat";
                break;
            case 6:
                hari = "Sabtu";
                break;
        }
        switch (bulan) {
            case 0:
                bulan = "Januari";
                break;
            case 1:
                bulan = "Februari";
                break;
            case 2:
                bulan = "Maret";
                break;
            case 3:
                bulan = "April";
                break;
            case 4:
                bulan = "Mei";
                break;
            case 5:
                bulan = "Juni";
                break;
            case 6:
                bulan = "Juli";
                break;
            case 7:
                bulan = "Agustus";
                break;
            case 8:
                bulan = "September";
                break;
            case 9:
                bulan = "Oktober";
                break;
            case 10:
                bulan = "November";
                break;
            case 11:
                bulan = "Desember";
                break;
        }

        if (h == 0) {
            h = 12;
        }

        if (h > 12) {
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;



        var time = h + ":" + m + ":" + s + " " + session;
        var tanggal_full = hari + ", " + tanggal + " " + bulan + " " + tahun;
        $("#txt_timer").html(time);
        $("#txt_tanggal").html(tanggal_full);
        $("#txt_tanggal2").html(tanggal_full);
        $("#txt_timer2").html(time);

        setTimeout(showTime, 1000);

    }

    showTime();

    let flag = false;
</script>
@endsection