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
              <form class="form" action="{{route('umum.update',$data->id)}}" method="post">
                  {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Kepala Sekolah</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control {{ $errors->has('kepsek') ? ' is-invalid' : '' }}" value="{{ $data->kepsek }}" placeholder="Kepala Sekolah" name="kepsek" required>
                    @if ($errors->has('kepsek')) 
                      <small class="form-text text-muted">{{$errors->first('kepsek')}}</small>
                    @endif
                  </div>
                </div>
                @php
                    $lists = ['a1','a2','b1','b2','b3','b4'];
                @endphp
                @foreach ($lists as $key  =>  $list)
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Wali Kelas {{ucwords($list)}}</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control {{ $errors->has($list) ? ' is-invalid' : '' }}" value="{{ $data->$list }}" placeholder="Wali Kelas {{$list}}" name="{{$list}}" required>
                      @if ($errors->has($list)) 
                        <small class="form-text text-muted">{{$errors->first($list)}}</small>
                      @endif
                    </div>
                  </div>
                @endforeach
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