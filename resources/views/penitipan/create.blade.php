@extends('layouts.master') 
@section('content')
{{-- <section class="row"> --}}
<form action="{{route('kontrol-penitipan.create.submit')}}" method="post">
    <div class="row">
          <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-block">
                  <h3 class="card-title">Form Kontrol</h3>
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
                    {{-- <div class="form-group row">
                      <label class="col-md-3 col-form-label">Waktu</label>
                      <div class="col-md-9">
                        <input type="date" class="form-control {{ $errors->has('waktu') ? ' is-invalid' : '' }}" value="{{ old('waktu') }}" placeholder="waktu" name="waktu" required>
                        @if ($errors->has('waktu')) 
                          <small class="form-text text-muted">{{$errors->first('waktu')}}</small>
                        @endif
                      </div>
                    </div> --}}
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">Keterlambatan (Menit)</label>
                      <div class="col-md-9">
                        <input type="number" class="form-control {{ $errors->has('keterlambatan_jemput') ? ' is-invalid' : '' }}" value="{{ (old('keterlambatan_jemput') !== null) ? old('keterlambatan_jemput') : 0 }}" placeholder="keterlambatan_jemput" name="keterlambatan_jemput" required>
                        @if ($errors->has('keterlambatan_jemput')) 
                          <small class="form-text text-muted">{{$errors->first('keterlambatan_jemput')}}</small>
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
<script src="{{asset('js/axios.min.js')}}"></script>

    <script type="text/javascript">
      $('#cari').on('keyup',function(){
        let text = $(this).val();

        let url = $('meta[name="app-url"]').attr('content')

        axios.get(`${url}/kontrol-penitipan/getSiswa/?text=${text}`).then(function (response) {
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
    </script>
@endsection