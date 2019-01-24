@extends('layouts.app') 
@section('content')
<div class="container-fluid" id="wrapper">
		<div class="row">
			<main class="col-xs-10 col-sm-8 col-md-4 m-auto ">
				<div class="login-panel card mt-5">
					<div class="card-block">
						<h3 class="card-title text-center mt-1">Login</h3>
						<div class="divider mt-0"></div>
            <form role="form" action="{{ route('login') }}" method="post">
                {{csrf_field()}}
							<fieldset>
								<div class="form-group">
                  <input class="form-control" placeholder="Masukkan Username" name="username" {{old('username')}} type="text" autofocus="">
                  @if ($errors->has('username'))
                    <span class="help-block">
                      <strong>{{ $errors->first('username') }}</strong>
                    </span> 
                  @endif
								</div>
								<div class="form-group">
                  <input class="form-control" placeholder="Password" name="password" type="password" value="">
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span> 
                  @endif
								</div>
								<div class="text-center"><button type="submit" class="btn btn-lg btn-primary">Login</button></fieldset>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</main>
		</div>
	</div>
@endsection