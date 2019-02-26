<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
    <h1 class="site-title"><a href="index.html"><em class="fa fa-rocket"></em> PENDIDIKAN ANAK USIA DINI</a></h1>
                      
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
    <ul class="nav nav-pills flex-column sidebar-nav">
      <li class="nav-item"><a class="nav-link {{ is_current_route(['home']) }}" href="{!!url('home')!!}"><em class="fa fa-dashboard"></em> PAUD TERPADU ASOKA <span class="sr-only">(current)</span></a></li>
      @if (Auth::user()->role_id == 1)
        <li class="parent nav-item">
          <a class="nav-link collapsed" data-toggle="collapse" href="#akun" aria-expanded="false">
            <em class="fa fa-user-o"></em> User <span data-toggle="collapse" href="#akun" class="icon pull-right collapsed" aria-expanded="false"><i class="fa fa-plus"></i></span>
          </a>
          <ul class="children collapse" id="akun" style="">
            <li class="nav-item"><a class="nav-link {{ is_current_route(['user', 'user/*']) }}" href="{{route('user')}}"><em class="fa fa-user-o"></em> User</a></li>
            <li class="nav-item"><a class="nav-link {{ is_current_route(['role', 'role/*']) }}" href="{{route('role')}}"><em class="fa fa-cogs"></em> Pengaturan</a></li>
          </ul>
        </li>      
      @endif
      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <li class="nav-item"><a class="nav-link {{ is_current_route(['data-guru', 'data-guru/*']) }}" href="{{route('data-guru')}}"><em class="fa fa-address-card-o"></em> Data Guru</a></li>
      @endif
      @if (Auth::user()->role_id == 3)
      <li class="nav-item"><a class="nav-link {{ is_current_route(['data-siswa', 'data-siswa/*']) }}" href="{{route('data-siswa')}}"><em class="fa fa-id-card-o"></em> Data Siswa</a></li>
      @endif
      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <li class="parent nav-item">
          <a class="nav-link collapsed" data-toggle="collapse" href="#siswa" aria-expanded="false">
            <em class="fa fa-id-card-o"></em> Data Siswa <span data-toggle="collapse" href="#siswa" class="icon pull-right collapsed" aria-expanded="false"><i class="fa fa-plus"></i></span>
          </a>
          <ul class="children collapse" id="siswa" style="">
              <li class="nav-item"><a class="nav-link {{ is_current_route(['data-siswa', 'data-siswa/*']) }}" href="{{route('data-siswa')}}"> Semua Siswa</a></li>
              <li class="nav-item"><a class="nav-link {{ is_current_route(['data-siswa', 'data-siswa/*']) }}" href="{{route('data-siswa',['siswa' => 'tk'])}}"> TK</a></li>
              <li class="nav-item"><a class="nav-link {{ is_current_route(['data-siswa', 'data-siswa/*']) }}" href="{{route('data-siswa',['siswa' => 'kb'])}}"> Kelompok Bermain</a></li>
              <li class="nav-item"><a class="nav-link {{ is_current_route(['data-siswa', 'data-siswa/*']) }}" href="{{route('data-siswa',['siswa' => 'tpa'])}}"> Taman Penitipan Anak</a></li>

          </ul>
        </li>  
      @endif
      @if (Auth::user()->role_id == 1)
      <li class="nav-item"><a class="nav-link {{ is_current_route(['kontrol-penitipan', 'kontrol-penitipan/*']) }}" href="{{route('kontrol-penitipan')}}"><em class="fa fa-exchange"></em> Kontrol Penitipan</a></li>
      @endif
      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
        <li class="nav-item"><a class="nav-link {{ is_current_route(['pembayaran', 'pembayaran/*']) }}" href="{{route('pembayaran')}}"><em class="fa fa-dollar"></em> Pembayaran</a></li>
      @endif
      @if (Auth::user()->role_id == 1)
      <li class="parent nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#laporan" aria-expanded="false">
          <em class="fa fa-bar-chart"></em> Laporan <span data-toggle="collapse" href="#laporan" class="icon pull-right collapsed" aria-expanded="false"><i class="fa fa-plus"></i></span>
        </a>
        <ul class="children collapse" id="laporan" style="">
            <li class="nav-item"><a class="nav-link {{ is_current_route(['laporan', 'laporan/*']) }}" href="{{route('laporan.print')}}"> Print Laporan</a></li>
            <li class="nav-item"><a class="nav-link {{ is_current_route(['laporan', 'laporan/*']) }}" href="{{route('laporan')}}"> Semua Laporan</a></li>
            <li class="nav-item"><a class="nav-link {{ is_current_route(['laporan', 'laporan/*']) }}" href="{{route('laporan',['semester' => '1'])}}"> Tahun Ajar 2018/2019 Semester 1</a></li>
            <li class="nav-item"><a class="nav-link {{ is_current_route(['laporan', 'laporan/*']) }}" href="{{route('laporan',['semester' => '2'])}}"> Tahun Ajar 2018/2019 Semester 2</a></li>

        </ul>
      </li>  
      <li class="nav-item"><a class="nav-link {{ is_current_route(['umum', 'umum/*']) }}" href="{{route('umum')}}"><em class="fa fa-cogs"></em> Umum</a></li>
      @endif
      {{-- <li class="nav-item"><a class="nav-link {{ is_current_route(['log','log/*']) }}" href="{{route('log')}}"><em class="fa fa-file"></em> Log System</a></li> --}}
    </ul>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="logout-button"><em class="fa fa-power-off"></em> Logout</a>
    <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
  </nav>