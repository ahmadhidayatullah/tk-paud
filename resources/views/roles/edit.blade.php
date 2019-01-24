@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title">Edit Level</h3>
              <form class="form" action="{{route('role.update',$role->id)}}" method="post">
                  {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Level</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $role->name }}" placeholder="Nama" name="name" required>
                    @if ($errors->has('name')) 
                      <small class="form-text text-muted">{{$errors->first('name')}}</small></div>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label"></label>
                  <div class="col-md-9 right">
                    <a href="{{route('role')}}" class="btn btn-md btn-warning">Batal</a>
                    <button type="submit" class="btn btn-md btn-info">Simpan</button>
                </div>
              </form>
            </div>
          </div>
    </div>
</section>
@endsection