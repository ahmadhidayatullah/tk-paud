@extends('layouts.master') 
@section('content')
{{-- <section class="row"> --}}
<form action="{{route('data-siswa.create.submit')}}" method="post">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card mb-4">
                <div class="card-block">
                  <h3 class="card-title">Data Siswa</h3>
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">NIS</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('nis') ? ' is-invalid' : '' }}" value="{{ old('nis') }}" placeholder="Nomor Induk Siswa" name="nis" required>
                        @if ($errors->has('nis')) 
                          <small class="form-text text-muted">{{$errors->first('nis')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Nama</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}" value="{{ old('nama') }}" placeholder="Nama" name="nama" required>
                        @if ($errors->has('nama')) 
                          <small class="form-text text-muted">{{$errors->first('nama')}}</small>
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
                      <label class="col-md-3 col-form-label">Agama</label>
                      <div class="col-md-9">
                        <select class="form-control" name="agama" id="agama" required>
                          <option value="">Tidak Ada</option>
                          <option value="Kristen Katolik">Kristen Katolik</option>
                          <option value="Kristen Protestan">Kristen Protestan</option>
                          <option value="Buddha">Buddha</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Islam">Islam</option>
                          <option value="Konghucu">Konghucu</option>
                        </select>
                        @if ($errors->has('agama')) 
                          <small class="form-text text-muted">{{$errors->first('agama')}}</small>
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
                      <label class="col-md-3 col-form-label">Alamat</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="Alamat" name="alamat" value="{{old('alamat')}}" required>
                        @if ($errors->has('alamat')) 
                          <small class="form-text text-muted">{{$errors->first('alamat')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Kelas</label>
                        <div class="col-md-9">
                          <select class="custom-select form-control" name="kelas" id="kelas">
                            <option value="">Tidak Ada</option>
                            <option value="A1">A1</option>
                            <option value="A2">A2</option>
                            <option value="B1">B1</option>
                            <option value="B2">B2</option>
                            <option value="B3">B3</option>
                            <option value="B4">B4</option>
                          </select>
                          @if ($errors->has('kelas')) 
                            <small class="form-text text-muted">{{$errors->first('kelas')}}</small>
                          @endif
                        </div>
                      </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Jenis Siswa</label>
                      <div class="col-md-9">
                        <select class="custom-select form-control" name="jenis_biaya_siswa_id" id="jenis_siswa">
                          <option value="">== Pilih ==</option>
                          @foreach ($jenisBiaya as $item)  
                          <option value="{{$item->id}}">{{$item->nama}}</option>
                          @endforeach
                        </select>
                        <div id="rincian"></div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Jenis Bayar</label>
                      <div class="col-md-9">
                        <select class="custom-select form-control" name="jenis_bayar" id="jenis_bayar">
                          <option value="cash">Cash</option>
                          <option value="cicil">Cicil</option>
                        </select>
                        <input id="cicilan" type="number" class="form-control mt-2" value="{{ old('cicilan') }}" placeholder="Cicilan Pertama" name="cicilan" style="display:none;">
                      </div>
                    </div>
                </div>
              </div>
        </div>
          <div class="col-md-6 col-lg-6">
            <div class="card mb-4">
                <div class="card-block">
                  <h3 class="card-title">Akun Orang Tua/Wali</h3>
                  
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
                      <label class="col-md-3 col-form-label">No. Hp</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('no_hp') ? ' is-invalid' : '' }}" placeholder="Nomor Handphone" name="no_hp" value="{{old('no_hp')}}" required>
                        @if ($errors->has('no_hp')) 
                          <small class="form-text text-muted">{{$errors->first('no_hp')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Pekerjaan</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control {{ $errors->has('pekerjaan_orang_tua') ? ' is-invalid' : '' }}" value="{{ old('pekerjaan_orang_tua') }}" placeholder="Nama Pekerjaan" name="pekerjaan_orang_tua" required>
                        @if ($errors->has('pekerjaan_orang_tua')) 
                          <small class="form-text text-muted">{{$errors->first('pekerjaan_orang_tua')}}</small>
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
@section('assetjs')
<script type="text/javascript">  
  
  $('#jenis_siswa').on('change',function(){
    let tk = "<div class=\"card text-white bg-primary mt-4\"><div class=\"card-header\">Rincian Biaya</div><div class=\"card-block\"><ul><li>uang pendaftaran 100.000</li><li>uang pangkal 2.300.000</li><li>seragam 5 pasang 750.000</li><li>uang bulanan 350.000</li></ul></div></div>";
    let tk2 = "<div class=\"card text-white bg-primary mt-4\"><div class=\"card-header\">Rincian Biaya</div><div class=\"card-block\"><ul><li>uang pendaftaran 100.000</li><li>uang pangkal 2.300.000</li><li>seragam 5 pasang 750.000</li><li>uang bulanan 350.000</li><li>uang peralihan 80.000</li></ul></div></div>";
    let seharian = "<div class=\"card text-white bg-primary mt-4\"><div class=\"card-header\">Rincian Biaya</div><div class=\"card-block\"><ul><li>uang pendaftaran 100.000</li><li>uang pangkal 1.500.000</li><li>uang bulanan 800.000</li><li>08.00 - 17.00</li></ul></div></div>";
    let stengah_hari = "<div class=\"card text-white bg-primary mt-4\"><div class=\"card-header\">Rincian Biaya</div><div class=\"card-block\"><ul><li>uang pendaftaran 100.000</li><li>uang pangkal 1.500.000</li><li>uang bulanan 650.000</li><li>11.30 - 17.00</li></ul></div></div>";
    
    let jenis_siswa = $("#jenis_siswa option:selected").val();
    let kelas = $("#kelas option:selected").val();
    
    if (jenis_siswa == '1' || jenis_siswa == '4') {
      if (kelas == 'B1' || kelas == 'B2' || kelas == 'B3' || kelas == 'B4' && jenis_siswa == '1') {
        $("#rincian").html(tk2);
      }else{
        $("#rincian").html(tk);
      }
    }else if(jenis_siswa == '2'){
      $("#rincian").html(seharian);
    }else if(jenis_siswa == '3'){
      $("#rincian").html(stengah_hari);
    }else{
      $("#rincian").html('');
    }
  });

  $('#jenis_bayar').on('change',function(){
    var cicilan = $("#jenis_bayar option:selected").val();
    if (cicilan == 'cash') {
      $("#cicilan").hide();
    }else{
      $("#cicilan").show();
    }
  });
</script>
    
@endsection