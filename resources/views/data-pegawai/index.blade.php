@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
                <h3 class="card-title">Halaman Pegawai
                    @if (Auth::user()->role_id == 1)    
                  <a href="{{route('data-pegawai.create')}}" class="btn btn-md btn-default">Tambah Pegawai</a>
                  @endif
                  {{-- <a href="{{route('print.pegawai')}}" target="_blank" class="btn btn-md btn-default">Print</a> --}}
                </h3>
                <div class="table-responsive">
                    @if(session('message')) {!!session('message')!!} @endif
                    <table class="table table-striped table-bordered zero-configuration" id="dataTable">
                      <thead>
                        <tr>
                          <th rowspan="2">No</th>
                          <th rowspan="2">Nama</th>
                          <th rowspan="2">NIP</th>
                          <th rowspan="2">Jabatan</th>
                          <th rowspan="2">Tempat/Tgl Lahir</th>
                          <th colspan="2">Pangkat Terakhir</th>
                          <th colspan="2">Pendidikan Terakhir</th>
                          <th rowspan="2">Alamat</th>
                          <th rowspan="2">No. Hp</th>
                          <th rowspan="2">TMT KGB</th>
                          <th rowspan="2">Ket</th>
                          <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                          <th>GOL</th>
                          <th>TMT</th>
                          <th>Jenjang</th>
                          <th>Jurusan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $key=>$item)
                        <tr>
                          <td>{{++$key}}</td>
                          <td>{{ucwords($item->getUserById->name)}}</td>
                          <td>{{$item->nip}}</td>
                          <td>{{$item->jabatan}}</td>
                          <td>{{$item->tempat.'/'.$item->tanggal_lahir}}</td>
                          <td>{{$item->pangkat_gol}}</td>
                          <td>{{$item->pangkat_tmt}}</td>
                          <td>{{$item->pendidikan_jenjang}}</td>
                          <td>{{$item->pendidikan_jurusan}}</td>
                          <td>{{$item->alamat}}</td>
                          <td>{{$item->no_hp}}</td>
                          <td>{{$item->tmt_kgb}}</td>
                          <td>{{$item->ket}}</td>
                          <td>
                            <a href="{{route('data-pegawai.edit',$item->id)}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Lihat"
                              class="editor_view"><i class="fa fa-pencil"></i></a>
                            @if (Auth::user()->role_id == 1)    
                              <a data-href="{{route('data-pegawai.delete',$item->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"
                                title="Hapus" class="editor_remove"><i class="fa fa-trash"></i></a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
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