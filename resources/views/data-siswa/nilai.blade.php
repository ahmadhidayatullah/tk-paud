@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
      <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title"></h3>
              @if(session('message')) 
                {!!session('message')!!} 
              @endif
              <form class="form" action="{{route('data-siswa.nilai.store',$data->id)}}" method="post">
                  {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Pendahuluan</label>
                  <div class="col-md-9">
                    <textarea name="pendahuluan" class="form-control {{ $errors->has('pendahuluan') ? ' is-invalid' : '' }}" cols="20" rows="5" required>{{ @$data->getNilaiSiswa->pendahuluan }}</textarea>
                    @if ($errors->has('pendahuluan')) 
                      <small class="form-text text-muted">{{$errors->first('pendahuluan')}}</small>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Agama dan Moral</label>
                  <div class="col-md-9">
                    <textarea name="agama" class="form-control {{ $errors->has('agama') ? ' is-invalid' : '' }}" cols="20" rows="5" required>{{ @$data->getNilaiSiswa->agama }}</textarea>
                    @if ($errors->has('agama')) 
                      <small class="form-text text-muted">{{$errors->first('agama')}}</small>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Fisik Motorik</label>
                  <div class="col-md-9">
                    <textarea name="fisik_motorik" class="form-control {{ $errors->has('fisik_motorik') ? ' is-invalid' : '' }}" cols="20" rows="5" required>{{ @$data->getNilaiSiswa->fisik_motorik }}</textarea>
                    @if ($errors->has('fisik_motorik')) 
                      <small class="form-text text-muted">{{$errors->first('fisik_motorik')}}</small>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Sosial Emosional</label>
                  <div class="col-md-9">
                    <textarea name="sosial_emosional" class="form-control {{ $errors->has('sosial_emosional') ? ' is-invalid' : '' }}" cols="20" rows="5" required>{{ @$data->getNilaiSiswa->sosial_emosional }}</textarea>
                    @if ($errors->has('sosial_emosional')) 
                      <small class="form-text text-muted">{{$errors->first('sosial_emosional')}}</small>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Bahasa</label>
                  <div class="col-md-9">
                    <textarea name="bahasa" class="form-control {{ $errors->has('bahasa') ? ' is-invalid' : '' }}" cols="20" rows="5" required>{{ @$data->getNilaiSiswa->bahasa }}</textarea>
                    @if ($errors->has('bahasa')) 
                      <small class="form-text text-muted">{{$errors->first('bahasa')}}</small>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Kognitif</label>
                  <div class="col-md-9">
                    <textarea name="kognitif" class="form-control {{ $errors->has('kognitif') ? ' is-invalid' : '' }}" cols="20" rows="5" required>{{ @$data->getNilaiSiswa->kognitif }}</textarea>
                    @if ($errors->has('kognitif')) 
                      <small class="form-text text-muted">{{$errors->first('kognitif')}}</small>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Seni</label>
                  <div class="col-md-9">
                    <textarea name="seni" class="form-control {{ $errors->has('seni') ? ' is-invalid' : '' }}" cols="20" rows="5" required>{{ @$data->getNilaiSiswa->seni }}</textarea>
                    @if ($errors->has('seni')) 
                      <small class="form-text text-muted">{{$errors->first('seni')}}</small>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Penutup</label>
                  <div class="col-md-9">
                    <textarea name="penutup" class="form-control {{ $errors->has('penutup') ? ' is-invalid' : '' }}" cols="20" rows="5" required>{{ @$data->getNilaiSiswa->penutup }}</textarea>
                    @if ($errors->has('penutup')) 
                      <small class="form-text text-muted">{{$errors->first('penutup')}}</small>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label"></label>
                  <div class="col-md-9 right">
                    <button type="submit" class="btn btn-md btn-info">Simpan</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</section>
@endsection