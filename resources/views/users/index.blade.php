@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
                <h3 class="card-title">Halaman User

                  <a href="{{route('user.create')}}" class="btn btn-md btn-default">Tambah User</a>
                </h3>
                <div class="table-responsive">
                    @if(session('message')) {!!session('message')!!} @endif
                    <table class="table table-striped table-bordered zero-configuration" id="dataTable">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Level</th>
                          <th>Tgl Buat</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{$user->name}}</td>
                          <td>{{$user->username}}</td>
                          <td>{{$user->role->name}}</td>
                          <td>{{ date('d M Y',strtotime($user->created_at)) }}</td>
                          <td>
                            <a href="{{route('user.show',$user->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Lihat"
                              class="editor_view"><i class="fa fa-expand"></i></a>
                            <a data-href="{{route('user.delete',$user->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"
                              title="Hapus" class="editor_remove"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Role</th>
                          <th>Tgl Buat</th>
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

@section('assetcss')
<link href="{!!asset('css/dataTables.css')!!}" rel="stylesheet">
@endsection

@section('assetjs')
<script src="{!!asset('js/dataTables.js')!!}"></script>
<script type="text/javascript">
  $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.act-ok').attr('action', $(e.relatedTarget).data('href'));
    });
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>
@endsection