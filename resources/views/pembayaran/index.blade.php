@extends('layouts.master') 
@section('content')
{{-- <section class="row"> --}}
<form action="{{route('pembayaran.submit')}}" method="post">
    <div class="row">
          <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-block">
                  <h3 class="card-title">Form Pembayaran</h3>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Jenis Bayar</label>
                      <div class="col-md-9">
                        <select class="custom-select form-control" name="jenis_pembayaran" id="jenis_pembayaran">
                          <option value="bulanan">Uang Bulanan</option>
                          <option value="pangkal">Pangkal</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Nama Siswa</label>
                      <div class="col-md-9">
                          {{csrf_field()}}
                        <input type="text" class="form-control {{ $errors->has('data_siswa_id') ? ' is-invalid' : '' }}" value="{{ old('data_siswa_id') }}" placeholder="Nama" name="data_siswa_id" required>
                        @if ($errors->has('data_siswa_id')) 
                          <small class="form-text text-muted">{{$errors->first('data_siswa_id')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Tanggal</label>
                      <div class="col-md-9">
                        <input type="date" class="form-control {{ $errors->has('tanggal') ? ' is-invalid' : '' }}" value="{{ old('tanggal') }}" placeholder="tanggal" name="tanggal" required>
                        @if ($errors->has('tanggal')) 
                          <small class="form-text text-muted">{{$errors->first('tanggal')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Bayar</label>
                      <div class="col-md-9">
                        <input type="number" class="form-control {{ $errors->has('bayar') ? ' is-invalid' : '' }}" value="{{ (old('bayar') !== null) ? old('bayar') : 0 }}" placeholder="bayar" name="bayar" required>
                        @if ($errors->has('bayar')) 
                          <small class="form-text text-muted">{{$errors->first('bayar')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Denda</label>
                      <div class="col-md-9">
                        <input type="number" class="form-control {{ $errors->has('total_denda') ? ' is-invalid' : '' }}" value="{{ (old('total_denda') !== null) ? old('total_denda') : 0 }}" placeholder="total_denda" name="total_denda" required>
                        @if ($errors->has('total_denda')) 
                          <small class="form-text text-muted">{{$errors->first('total_denda')}}</small>
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