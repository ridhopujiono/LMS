<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{asset('login/styles/sop.css')}}" />
  <title>{{$judul}}</title>
</head>

<body>
  <div class="container">
    <div class="firstMenu">

      <!-- HEADER -->
      <div class="container_HEADER">
        <div class="flex_HEADER">

          <div>
            <a href="{{url('/')}}" class="icon_HEADER">
              <img src="{{asset('login/assets/Home.svg')}}" alt="Beranda" />
              <span class="icon_text_HEADER">Beranda</span>
            </a>
          </div>

          <div>
            <div class="address_HEADER">
              <span class="text_address_BOLD_HEADER">SESPIM LEMDIKLAT POLRI</span>
              <span class="text_address_REGULAR_HEADER">Jl. Raya Maribaya No.53 .Lembang ,Bandung 40391</span>
            </div>
          </div>

        </div>
      </div>

      <!-- COURSEL / SLIDER -->
      <div class="container_COURSEL">
        <div id="slider">
          <figure>
            <img src="{{asset('login/assets/imgs/Cover_01.png')}}" />
            <img src="{{asset('login/assets/imgs/Cover_02.png')}}" />
            <img src="{{asset('login/assets/imgs/Cover_01.png')}}" />
            <img src="{{asset('login/assets/imgs/Cover_02.png')}}" />
            <img src="{{asset('login/assets/imgs/Cover_01.png')}}" />
          </figure>
        </div>
      </div>

      <!-- TENTANG -->
      <div class="container_TENTANG">
        <div class="area_TENTANG">
          <iframe width="100%" height="450px" src="https://lmssespim.lemdiklat.polri.go.id/_up/Dokumen%20SOP.pdf" frameborder="0"></iframe>
        </div>
      </div>

      <!-- MENUS -->
      <div class="container_MENUS">

        <a href="{{url('tentang')}}" class="card_MENUS_BLUE">
          <div class="flex_MENUS">
            <img src="{{asset('login/assets/Logo_LMS.svg')}}" />
            <div class="text_MENUS">TENTANG LMS</div>
          </div>
        </a>

        <a href="https://sespim.lemdiklat.polri.go.id/pustaka" class="card_MENUS_SKYBLUE">
          <div class="flex_MENUS">
            <img src="{{asset('login/assets/Logo_Buku.svg')}}" />
            <div class="text_MENUS">E-LIBRARY</div>
          </div>
        </a>

        <a href="{{url('sop')}}" class="card_MENUS_BLUE">
          <div class="flex_MENUS">
            <img src="{{asset('login/assets/Logo_SOP.svg')}}" />
            <div class="text_MENUS">SOP LMS</div>
          </div>
        </a>

      </div>

    </div>

    <div class="secondMenu">

      <!-- LOGO POLISI -->
      <div class="container_LOGO_POLISI">
        <img src="{{asset('login/assets/Logo_Kop.png')}}" />
      </div>

      <!-- TEXT LMS -->
      <div class="container_LMS">
        <p class="title_LMS">LEARNING MANAGEMENT SYSTEM</p>
        <p class="title_SMALL_LMS">SESPIM LEMDIKLAT POLRI</p>
      </div>

      <!-- FORM LOGIN -->
      <div class="container_FORM">
        <form action="{{url('auth')}}" method="post">
          @csrf
          <div class="card_FORM">
            <input class="input_FORM" type="text" placeholder="Username" name="username" autocomplete="off" required>
            <input class="input_FORM" type="password" name="password" placeholder="Password" required>
            <button type="submit" class="button_FORM">LOGIN</button>
          </div>
        </form>
      </div>

      <!-- LOGO PRESISI -->
      <div class="container_LOGO_PRESISI">
        <img src="{{asset('login/assets/Logo_Presisi.png')}}" />
        <span class="text_LOGO_PRESISI">@sespimlemdiklatpolri</span>
      </div>

    </div>

  </div>
  <script>
    let data;

    function peringatan(data) {
      if (data == 'data') {
        alert('Data tidak ditemukan');
      } else if (data == 'auth') {
        alert('Mohon Login');

      }
    }
  </script>
  @error('username')
  <script>
    peringatan('data');
  </script>
  @enderror
  @if(session('!auth'))
  <script>
    peringatan('auth');
  </script>
  @endif
</body>

</html>