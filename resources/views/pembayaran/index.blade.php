@extends('layouts.master') 
@section('content')
{{-- <section class="row"> --}}
<form action="{{route('pembayaran.submit')}}" method="post">
    <div class="row">
          <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-block">
                  <h3 class="card-title">Form Pembayaran</h3>
                  @if(session('message')) {!!session('message')!!} @endif
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
                      {{csrf_field()}}
                      <div class="col-md-4">
                        <input type="text" id="cari" class="form-control" value="" placeholder="Cari Siswa" name="tempat" required>
                      </div>
                      <div class="col-md-5">
                        <select class="custom-select form-control" name="data_siswa_id" id="data_siswa_id">
                          <option value="">-- Silahkan Cari Siswa -- </option>
                        </select>
                        @if ($errors->has('data_siswa_id')) 
                          <small class="form-text text-muted">{{$errors->first('data_siswa_id')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Tanggal</label>
                      <div class="col-md-9">
                        <input type="date" id="tanggal" class="form-control {{ $errors->has('tanggal') ? ' is-invalid' : '' }}" value="{{date('Y-m-d')}}" placeholder="tanggal" name="tanggal" required>
                        @if ($errors->has('tanggal')) 
                          <small class="form-text text-muted">{{$errors->first('tanggal')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Bayar</label>
                      <div class="col-md-9">
                        <input type="number" id="bayar" class="form-control {{ $errors->has('bayar') ? ' is-invalid' : '' }}" value="{{ (old('bayar') !== null) ? old('bayar') : 0 }}" placeholder="bayar" name="bayar" required>
                        @if ($errors->has('bayar')) 
                          <small class="form-text text-muted">{{$errors->first('bayar')}}</small>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Denda</label>
                      <div class="col-md-9">
                        <input type="number" id="denda" class="form-control {{ $errors->has('total_denda') ? ' is-invalid' : '' }}" value="{{ (old('total_denda') !== null) ? old('total_denda') : 0 }}" placeholder="total_denda" name="total_denda" required>
                        @if ($errors->has('total_denda')) 
                          <small class="form-text text-muted">{{$errors->first('total_denda')}}</small>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Total</label>
                      <div class="col-md-9">
                        <input type="number" id="total" class="form-control {{ $errors->has('total') ? ' is-invalid' : '' }}" value="{{ (old('total') !== null) ? old('total') : 0 }}" placeholder="total" name="total" required>
                        @if ($errors->has('total')) 
                          <small class="form-text text-muted">{{$errors->first('total')}}</small>
                        @endif
                      </div>
                    </div>
                    @if (Auth::user()->role_id == 1)
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label"></label>
                      <div class="col-md-9 right">
                        <button type="reset" class="btn btn-md btn-warning">Batal</button>
                        <button type="submit" class="btn btn-md btn-info">Simpan</button>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
        </div>
    </div>
</form>
{{-- </section> --}}
@endsection
@section('assetjs')
<script src="{{asset('js/axios.min.js')}}"></script>

    <script type="text/javascript">
      $('#cari').on('keyup',function(){
        let text = $(this).val();

        let url = $('meta[name="app-url"]').attr('content')

        axios.get(`${url}/pembayaran/getSiswa/?text=${text}`).then(function (response) {
          let text = response.data
          if (text == '') {
            $('#data_siswa_id').html(text)
          }else{
            $('#data_siswa_id').html(text)
          }
          // $('data_siswa_id').html()
        }).catch((error) => {
           console.log(error);
        });
      });

      $('#data_siswa_id').on('change',function(){
        let tanggal = $("#tanggal").val();
        let siswa = $("#data_siswa_id option:selected").val();
        let jenis_bayar = $("#jenis_pembayaran option:selected").val();
        let url = $('meta[name="app-url"]').attr('content')

        axios.get(`${url}/pembayaran/getBiaya/?tanggal=${tanggal}&siswa=${siswa}&jenis_bayar=${jenis_bayar}`).then(function (response) {
          let text = response.data
          if (text == '') {
            // $('#bayar').val()
            // $('#denda').val()
            console.log(text);
            
          }else{
            // console.log(text);
            $('#bayar').val(text.bayar)
            $('#denda').val(text.denda)
            $('#total').val(text.total)
          }
        }).catch((error) => {
           console.log(error);
        });
      });
    </script>
@endsection