@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title">Tambah User</h3>
              <form class="form" action="{{route('user.create.submit')}}" method="post">
                  {{csrf_field()}}
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Nama</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Nama" name="name" required>
                    @if ($errors->has('name')) 
                      <small class="form-text text-muted">{{$errors->first('name')}}</small>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Username</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" placeholder="Username" name="username" required>
                    @if ($errors->has('username')) 
                      <small class="form-text text-muted">{{$errors->first('username')}}</small>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Password</label>
                  <div class="col-md-9">
                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                    @if ($errors->has('password')) 
                      <small class="form-text text-muted">{{$errors->first('password')}}</small>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Konirmasi Password</label>
                  <div class="col-md-9">
                    <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Konfirmasi Password" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation')) 
                      <small class="form-text text-muted">{{$errors->first('password_confirmation')}}</small>
                    @endif
                  </div>
                </div>
                {{-- <div class="form-group row">
                  <label class="col-md-3 col-form-label">Level</label>
                  <div class="col-md-9">
                    <select class="custom-select form-control" name="role">
                      <option selected>-- Pilih Level --</option>
                      @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('role')) 
                      <small class="form-text text-muted">{{$errors->first('role')}}</small>
                    @endif
                  </div>
                </div> --}}
                <div class="form-group row">
                  <label class="col-md-3 col-form-label"></label>
                  <div class="col-md-9 right">
                    <a href="{{route('user')}}" class="btn btn-md btn-warning">Batal</a>
                    <button type="submit" class="btn btn-md btn-info">Simpan</button>
                  </div>
                </div>
              </div>
              </form>
          </div>
    </div>
</section>
@endsection