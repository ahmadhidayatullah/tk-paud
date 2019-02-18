@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
                <h3 class="card-title">{{$title}}
                    @if (Auth::user()->role_id == 1)    
                  <a href="{{route('data-siswa.create')}}" class="btn btn-md btn-default">Tambah Siswa</a>
                  <a href="{{route('export.data-siswa')}}" target="_blank" class="btn btn-md btn-default">Export</a>
                  @endif
                  <div class="dropdown card-title-btn-container">
                    <button class="btn btn-sm btn-subtle dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><em class="fa fa-print"></em> Print</button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('print.siswa',['ket' => 'a1'])}}" target="_blank"><em class="fa fa-print mr-1"></em> A1</a>
                        <a class="dropdown-item" href="{{route('print.siswa',['ket' => 'a2'])}}" target="_blank"><em class="fa fa-print mr-1"></em> A2</a>
                        <a class="dropdown-item" href="{{route('print.siswa',['ket' => 'b1'])}}" target="_blank"><em class="fa fa-print mr-1"></em> B1</a>
                        <a class="dropdown-item" href="{{route('print.siswa',['ket' => 'b2'])}}" target="_blank"><em class="fa fa-print mr-1"></em> B2</a>
                        <a class="dropdown-item" href="{{route('print.siswa',['ket' => 'b3'])}}" target="_blank"><em class="fa fa-print mr-1"></em> B3</a>
                        <a class="dropdown-item" href="{{route('print.siswa',['ket' => 'b4'])}}" target="_blank"><em class="fa fa-print mr-1"></em> B4</a>
                      </div>
                  </div>
                  <select name="select-limit" id="limit-page-show" class="btn btn-common">
                    <option value="{{route('data-siswa', ['siswa' => '','limit' => 'all'])}}" {{ (Request::get('limit') == 'all') ? 'selected' : ''}}>All</option>
                    <option value="{{route('data-siswa', ['siswa' => '','limit' => '1'])}}" {{ (Request::get('limit') == '1') ? 'selected' : ''}}>Tahun 2018/2019</option>
                    <option value="{{route('data-siswa', ['siswa' => '','limit' => '2'])}}" {{ (Request::get('limit') == '2') ? 'selected' : ''}}>Tahun 2019/2020</option>
                    <option value="{{route('data-siswa', ['siswa' => '','limit' => '3'])}}" {{ (Request::get('limit') == '3') ? 'selected' : ''}}>Tahun 2020/2021</option>
                    <option value="{{route('data-siswa', ['siswa' => '','limit' => '4'])}}" {{ (Request::get('limit') == '4') ? 'selected' : ''}}>Tahun 2021/2022</option>
                    <option value="{{route('data-siswa', ['siswa' => '','limit' => '5'])}}" {{ (Request::get('limit') == '5') ? 'selected' : ''}}>Tahun 2022/2023</option>
                  </select>
                </h3>
                <div class="table-responsive">
                    @if(session('message')) {!!session('message')!!} @endif
                    <table class="table table-striped table-bordered zero-configuration" id="dataTable">
                      <thead>
                        <tr>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Jenis Kelamin</th>
                          <th>Agama</th>
                          <th>Tempat Tgl Lahir</th>
                          <th>Nama Orang Tua dan Pekerjaan</th>
                          <th>Alamat</th>
                          <th>No. Hp</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $item)
                        <tr>
                          <td>{{$item->nis}}</td>
                          <td>{{ucwords($item->nama)}}</td>
                          <td>{{$item->jenis_kelamin}}</td>
                          <td>{{$item->agama}}</td>
                          <td>{{$item->tempat.' / '.$item->tanggal_lahir}}</td>
                          <td>{{ucwords($item->getUserById->name).' / '.$item->pekerjaan_orang_tua}}</td>
                          <td>{{$item->alamat}}</td>
                          <td>{{$item->no_hp}}</td>
                          <td>
                            <a href="{{route('data-siswa.show',$item->id)}}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Lihat"
                              class="editor_view"><i class="fa fa-expand"></i></a>
                            {{-- <a href="{{route('data-guru.edit',$item->id)}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Lihat"
                                class="editor_view"><i class="fa fa-pencil"></i></a> --}}
                                @if (Auth::user()->role_id == 1)    
                            <a data-href="{{route('data-siswa.delete',$item->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"
                              title="Hapus" class="editor_remove"><i class="fa fa-trash"></i></a>
                              @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>kelas</th>
                          <th>Jenis Kelamin</th>
                          <th>Agama</th>
                          <th>Jenis Siswa</th>
                          <th>Jenis Bayar</th>
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
<script type="text/javascript">
	$(document).on('change', 'select[name="select-limit"]', function(){
        location.href = $(this).val();
  });

</script>
@endsection