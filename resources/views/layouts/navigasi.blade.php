<header class="page-header row justify-center">
    <div class="col-md-6 col-lg-8" >
      <h1 class="float-left text-center text-md-left">PAUD TERPADU ASOKA</h1>
    </div>
    <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img src="{{asset('images/default-avatar.png')}}" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
      <div class="username mt-1">
        <h4 class="mb-1">Username</h4>
        <h6 class="text-muted">{{Auth::user()->name}}</h6>
      </div>
      </a>
      <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
        @if (Auth::user()->role_id == 1)    
          <a class="dropdown-item" href="{{route('user.show',Auth::user()->id)}}"><em class="fa fa-user-circle mr-1"></em> View Profile</a>
        @endif
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <em class="fa fa-power-off mr-1"></em> Logout</a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
    </div>
    <div class="clear"></div>
  </header>