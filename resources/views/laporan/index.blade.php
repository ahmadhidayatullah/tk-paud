@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title">{{$title}}</h3>
              @if (!empty(Request::segment(2)))    
              <div class="dropdown card-title-btn-container">
                <button class="btn btn-sm btn-subtle dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><em class="fa fa-cog"></em></button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('laporan',['semester' => Request::segment(2),'kelompok' => 'tk'])}}"><em class="fa fa-search mr-1"></em> TK</a>
                    <a class="dropdown-item" href="{{route('laporan',['semester' => Request::segment(2),'kelompok' => 'kb'])}}"><em class="fa fa-search mr-1"></em> KB</a>
                    <a class="dropdown-item" href="{{route('laporan',['semester' => Request::segment(2),'kelompok' => 'tpa'])}}"><em class="fa fa-search mr-1"></em> TPA</a></div>
              </div>
              @endif
              <div class="table-responsive">
                  @if(session('message')) {!!session('message')!!} @endif
                <table class="table table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jenis Bayar</th>
                      <th>Tanggal</th>
                      <th>Bayar</th>
                      <th>Denda</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($data as $item)
                      <tr>
                        <td>{{ucwords($item->getSiswaById->nama)}}</td>
                        <td>{{ucwords($item->jenis_pembayaran)}}</td>
                        <td>{{ date('d M Y',strtotime($item->tanggal)) }}</td>
                        <td>{{\GeneralHelper::toRupiah($item->bayar)}}</td>
                        <td>{{\GeneralHelper::toRupiah($item->total_denda)}}</td>
                        <td>
                          <a target="_blank" href="{{route('print.kwitansi',$item->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Print"
                            class="editor_view"><i class="fa fa-print"></i></a>
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
@endsection

@section('assetcss')
<link href="{!!asset('css/dataTables.css')!!}" rel="stylesheet">
@endsection

@section('assetjs')
<script src="{!!asset('js/dataTables.js')!!}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>
@endsection