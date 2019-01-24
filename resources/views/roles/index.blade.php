@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
                <h3 class="card-title">Pengaturan Level User

                  <a href="{{route('role.create')}}" class="btn btn-md btn-default">Tambah Level</a>
                </h3>
                <div class="table-responsive">
                    @if(session('message')) {!!session('message')!!} @endif
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $role)
                        <tr>
                          <td>{{$role->id}}</td>
                          <td>{{$role->name}}</td>
                          <td>
                            <a href="{{route('role.edit',$role->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="View"
                              class="editor_view"><i class="fa fa-pencil"></i></a>
                            <a data-href="{{route('role.delete',$role->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"
                              title="Delete" class="editor_remove"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus</h4>
        </div>
        <div class="modal-body">
          <p>Ingin Menghapus Data Ini ?</p>
        </div>
        <div class="modal-footer">
          <form action="" method="post" class="act-ok">
            <button type="button" class="btn btn-default inline" data-dismiss="modal">Batal</button>
            <input type="submit" name="submit" value="Hapus" class="btn btn-danger btn-ok"> {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('assetjs')
<script type="text/javascript">
  $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.act-ok').attr('action', $(e.relatedTarget).data('href'));
    });
</script>
@endsection