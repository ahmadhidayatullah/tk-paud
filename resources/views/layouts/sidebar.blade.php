<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
    <h1 class="site-title"><a href="index.html"><em class="fa fa-rocket"></em> TK Paud</a></h1>
                      
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
    <ul class="nav nav-pills flex-column sidebar-nav">
      <li class="nav-item"><a class="nav-link {{ is_current_route(['home']) }}" href="{!!url('home')!!}"><em class="fa fa-dashboard"></em> Dashboard <span class="sr-only">(current)</span></a></li>
      <li class="parent nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#akun" aria-expanded="false">
          <em class="fa fa-user-o">&nbsp;</em> User <span data-toggle="collapse" href="#akun" class="icon pull-right collapsed" aria-expanded="false"><i class="fa fa-plus"></i></span>
        </a>
        <ul class="children collapse" id="akun" style="">
          <li class="nav-item"><a class="nav-link {{ is_current_route(['user', 'user/*']) }}" href="{{route('user')}}"><em class="fa fa-user-o"></em> User</a></li>
          <li class="nav-item"><a class="nav-link {{ is_current_route(['role', 'role/*']) }}" href="{{route('role')}}"><em class="fa fa-cogs"></em> Pengaturan</a></li>
        </ul>
      </li>      
      <li class="nav-item"><a class="nav-link {{ is_current_route(['data-guru', 'data-guru/*']) }}" href="{{route('data-guru')}}"><em class="fa fa-address-card-o"></em> Data Guru</a></li>
      <li class="nav-item"><a class="nav-link" href="#"><em class="fa fa-id-card-o"></em> Data Siswa</a></li>
      <li class="nav-item"><a class="nav-link" href="#"><em class="fa fa-id-card-o"></em> Kontrol Penitipan</a></li>
      <li class="parent nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#sub-item-1" aria-expanded="false">
          <em class="fa fa-file-o">&nbsp;</em> Pembayaran <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right collapsed" aria-expanded="false"><i class="fa fa-plus"></i></span>
        </a>
        <ul class="children collapse" id="sub-item-1" style="">
          <li class="nav-item"><a class="nav-link" href="login.html">
            Login
          </a></li>
          <li class="nav-item"><a class="nav-link" href="error.html">
            Error 404
          </a></li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link" href="#"><em class="fa fa-bar-chart"></em> Laporan</a></li>
      <li class="nav-item"><a class="nav-link {{ is_current_route(['log','log/*']) }}" href="{{route('log')}}"><em class="fa fa-file"></em> Log System</a></li>
    </ul>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="logout-button"><em class="fa fa-power-off"></em> Logout</a>
    <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
  </nav>