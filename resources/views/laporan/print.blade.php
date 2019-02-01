@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title">Print</h3>
              <form action="{{route('laporan.print')}}">
              <div class="row">
                      <div class="col-lg-4 col-sm-4">
                          <select class="custom-select form-control" name="bulan" id="bulan">
                              @php
                                  $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                              @endphp
                              @foreach ($bulan as $item=>$key)
                                  <option value="{{++$item}}" {{(Request::get('bulan') == $item)?'selected':''}}>{{$key}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-lg-4 col-sm-4">
                          <select class="custom-select form-control" name="tahun" id="tahun">
                              @for ($i = 2019; $i <= 2022; $i++)  
                                <option value="{{$i}}" {{(Request::get('tahun') == $i)?'selected':''}}>{{$i}}</option>
                              @endfor
                          </select>
                      </div>
                      <div class="col-lg-4 col-sm-4">
                          <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                      </div>
                    </div>
                </form>
            </div>
          </div>
    </div>
    @if (!empty($data))
    <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-block">
                    <h3 class="card-title">Laporan <a target="_blank" class="btn btn-default" href="{{route('print.bulanan',['bulan' => $get_bulan,'tahun'=>$get_tahun])}}">Print <i class="fa fa-print"></i></a></h3>
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
    @endif
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