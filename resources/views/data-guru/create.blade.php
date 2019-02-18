@extends('layouts.master') 
@section('content')
{{-- <section class="row"> --}}
<form action="{{route('data-guru.create.submit')}}" method="post">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card mb-4">
                <div class="card-block">
                  <h3 class="card-title">Data Guru</h3>
                   <div class="form-group row">
                      <label class="col-md-3 col-form-label">NIP</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('nip') ? ' is-invalid' : '' }}" placeholder="Nomor Induk Pegawai" name="nip" value="{{old('nip')}}" required>
                        @if ($errors->has('nip')) 
                          <small class="form-text text-muted">{{$errors->first('nip')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">NUPTK</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('nuptk') ? ' is-invalid' : '' }}" placeholder="Nomor Induk Pegawai" name="nuptk" value="{{old('nuptk')}}" required>
                        @if ($errors->has('nuptk')) 
                          <small class="form-text text-muted">{{$errors->first('nuptk')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Jenis Kelamin</label>
                      <div class="col-md-9">
                          {{csrf_field()}}
                        <div class="custom-control custom-radio">
												  <input type="radio" id="customRadio1" name="jenis_kelamin" value="L" class="custom-control-input">
                          <label class="custom-control-label custom-control-description" for="customRadio1">Laki - Laki</label>
												</div>
												<br />
												<div class="custom-control custom-radio">
												  <input type="radio" id="customRadio2" name="jenis_kelamin" value="P" class="custom-control-input">
												  <label class="custom-control-label custom-control-description" for="customRadio2">Perempuan</label>
												</div>
                        @if ($errors->has('jenis_kelamin')) 
                          <small class="form-text text-muted">{{$errors->first('jenis_kelamin')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Tempat Tanggal Lahir</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control {{ $errors->has('tempat') ? ' is-invalid' : '' }}" value="{{ old('tempat') }}" placeholder="Tempat" name="tempat" required>
                        @if ($errors->has('tempat')) 
                          <small class="form-text text-muted">{{$errors->first('tempat')}}</small>
                        @endif
                      </div>
                      <div class="col-md-5">
                        <input type="date" class="form-control {{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" value="{{ old('tanggal_lahir') }}" placeholder="Tanggal lahir" name="tanggal_lahir" required>
                        @if ($errors->has('tanggal_lahir')) 
                          <small class="form-text text-muted">{{$errors->first('tanggal_lahir')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Pangkat Gol</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('pangkat_gol') ? ' is-invalid' : '' }}" placeholder="Pangkat Gol" name="pangkat_gol" value="{{old('pangkat_gol')}}">
                        @if ($errors->has('pangkat_gol')) 
                          <small class="form-text text-muted">{{$errors->first('pangkat_gol')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Pangkat TMT</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('pangkat_tmt') ? ' is-invalid' : '' }}" placeholder="Pangkat TMT" name="pangkat_tmt" value="{{old('pangkat_tmt')}}">
                        @if ($errors->has('pangkat_tmt')) 
                          <small class="form-text text-muted">{{$errors->first('pangkat_tmt')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Jabatan</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('jabatan') ? ' is-invalid' : '' }}" placeholder="Jabatan" name="jabatan" value="{{old('jabatan')}}" required>
                        @if ($errors->has('jabatan')) 
                          <small class="form-text text-muted">{{$errors->first('jabatan')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Pendidikan Jenjang</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('pendidikan_jenjang') ? ' is-invalid' : '' }}" placeholder="Pendidikan Jenjang" name="pendidikan_jenjang" value="{{old('pendidikan_jenjang')}}" required>
                        @if ($errors->has('pendidikan_jenjang')) 
                          <small class="form-text text-muted">{{$errors->first('pendidikan_jenjang')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Pendidikan Jurusan</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('pendidikan_jurusan') ? ' is-invalid' : '' }}" placeholder="Pendidikan Jurusan" name="pendidikan_jurusan" value="{{old('pendidikan_jurusan')}}" required>
                        @if ($errors->has('pendidikan_jurusan')) 
                          <small class="form-text text-muted">{{$errors->first('pendidikan_jurusan')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Alamat</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="Alamat" name="alamat" value="{{old('alamat')}}" required>
                        @if ($errors->has('alamat')) 
                          <small class="form-text text-muted">{{$errors->first('alamat')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">No. Hp</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('no_hp') ? ' is-invalid' : '' }}" placeholder="Nomor Handphone" name="no_hp" value="{{old('no_hp')}}" required>
                        @if ($errors->has('no_hp')) 
                          <small class="form-text text-muted">{{$errors->first('no_hp')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">TMT KGB</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('tmt_kgb') ? ' is-invalid' : '' }}" placeholder="TMT KGB" name="tmt_kgb" value="{{old('tmt_kgb')}}">
                        @if ($errors->has('tmt_kgb')) 
                          <small class="form-text text-muted">{{$errors->first('tmt_kgb')}}</small>
                        @endif
                      </div>
                    </div>
                </div>
              </div>
        </div>
          <div class="col-md-6 col-lg-6">
            <div class="card mb-4">
                <div class="card-block">
                  <h3 class="card-title">Akun</h3>
                  
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
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label"></label>
                      <div class="col-md-9 right">
                        <a href="{{route('user')}}" class="btn btn-md btn-warning">Batal</a>
                        <button type="submit" class="btn btn-md btn-info">Simpan</button>
                      </div>
                    </div>
                  
                </div>
              </div>
        </div>
    </div>
</form>
{{-- </section> --}}
@endsection