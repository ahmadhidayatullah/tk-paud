@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title">Print</h3>
              <form action="{{route('laporan.print')}}">
              <div class="row">
                      <div class="col-lg-3 col-sm-4">
                          <input type="date" class="form-control" name="start">
                      </div>
                      <div class="col-lg-3 col-sm-4">
                        <input type="date" class="form-control" name="end">
                      </div>
                      <div class="col-lg-3 col-sm-4">
                        <select name="filter" class="form-control">
                            <option value="semua">Semua</option>
                            <option value="cash">Lunas</option>
                            <option value="cicil">Cicil</option>
                        </select>
                      </div>
                      <div class="col-lg-3 col-sm-4">
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
                    <h3 class="card-title">Laporan <a target="_blank" class="btn btn-default" href="{{route('print.bulanan',['start' => $get_start,'end'=>$get_end,'filter'=>$filter])}}">Print <i class="fa fa-print"></i></a></h3>
                  <div class="table-responsive">
                      @if(session('message')) {!!session('message')!!} @endif
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                              <th>Nama</th>
                              <th>Jenis Bayar</th>
                              <th>Tanggal</th>
                              <th>Keterangan Bayar</th>
                              <th>Bayar</th>
                              <th>Denda</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($data as $item)
                              @if ($item->jenis_pembayaran == 'pangkal' && $item->getSiswaById->jenis_bayar != 'cash')
                                 <tr class="item">
                                    <td>{{ucwords($item->getSiswaById->nama)}}</td>
                                    <td>{{ucwords($item->jenis_pembayaran)}}</td>
                                    <td>{{ date('d M Y',strtotime($item->tanggal)) }}</td>
                                    <td>
                                        {{ucwords($item->getSiswaById->jenis_bayar)}}
                                    </td>
                                    <td>
                                        {{\GeneralHelper::toRupiah($item->bayar)}}
                                    </td>
                                    <td>{{\GeneralHelper::toRupiah($item->total_denda)}}</td>
                                    <td>
                                        <a target="_blank" href="{{route('print.kwitansi',$item->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Print"
                                          class="editor_view"><i class="fa fa-print"></i></a>
                                      </td>
                                </tr>
                                <tr class="item">
                                    <td>{{ucwords($item->getSiswaById->nama)}}</td>
                                    <td>{{ucwords($item->jenis_pembayaran)}}</td>
                                    <td>{{ date('d M Y',strtotime($item->tanggal)) }}</td>
                                    <td>
                                        Siswa Bayar
                                    </td>
                                    <td>
                                        {{\GeneralHelper::toRupiah($item->getSiswaById->getJenisBiayaById->pangkal - $item->bayar)}}
                                    </td>
                                    <td>{{\GeneralHelper::toRupiah($item->total_denda)}}</td>
                                    <td>
                                        
                                      </td>
                                </tr>
                            @else
        
                                <tr class="item">
                                    <td>{{ucwords($item->getSiswaById->nama)}}</td>
                                    <td>{{ucwords($item->jenis_pembayaran)}}</td>
                                    <td>{{ date('d M Y',strtotime($item->tanggal)) }}</td>
                                    @if ($item->jenis_pembayaran == 'pangkal')
                                        @if ($item->getSiswaById->jenis_bayar == 'cash')  
                                        <td>Lunas</td>
                                        @else
                                        <td>
                                            {{ucwords($item->getSiswaById->jenis_bayar)}}
                                        </td>
                                        @endif
                                    @else
                                        <td></td>
                                    @endif
                                    <td>
                                    @if ($item->jenis_pembayaran == 'pangkal' && $item->getSiswaById->jenis_bayar != 'cash')
                                    {{\GeneralHelper::toRupiah($item->bayar)}} (Sisa {{\GeneralHelper::toRupiah($item->getSiswaById->getJenisBiayaById->pangkal - $item->bayar)}})
                                    @else
                                        {{\GeneralHelper::toRupiah($item->bayar)}}
                                    @endif
                                    </td>
                                    <td>{{\GeneralHelper::toRupiah($item->total_denda)}}</td>
                                    <td>
                                        <a target="_blank" href="{{route('print.kwitansi',$item->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Print"
                                          class="editor_view"><i class="fa fa-print"></i></a>
                                      </td>
                                </tr>
        
                            @endif
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