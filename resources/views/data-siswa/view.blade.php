@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-8">
        <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title">Data Siswa</h3>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Nama</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" value="{{ ucwords($data->nama) }}" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Jenis Kelamin</label>
                  <div class="col-md-9">
                      <input type="text" class="form-control" value="{{ ($data->jenis_kelamin=='L') ? 'Laki - Laki':'Perempuan' }}" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Tempat Tanggal Lahir</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" value="{{ $data->tempat }}" readonly>
                  </div>
                  <div class="col-md-5">
                    <input type="text" class="form-control" value="{{ date('d M Y',strtotime($data->tanggal_lahir)) }}" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Alamat</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" value="{{ $data->alamat }}" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Jenis Siswa</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" value="{{ $data->getJenisBiayaById->nama }}" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Jenis Bayar</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" value="{{ $data->jenis_bayar }}" readonly>
                  </div>
                </div>
            </div>
          </div>
          <div class="card mb-4">
              <div class="card-block">
                <h3 class="card-title">History Pembayaran Bulanan</h3>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Tanggal </th>
                        <th>Jenis Bayar</th>
                        <th>Bayar</th>
                        <th>Denda</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data->getPembayaran as $item) 
                        @if ($item->jenis_pembayaran == 'bulanan')
                          <tr>
                            <td>{{ date('d M Y',strtotime($item->tanggal)) }}</td>
                            <td>{{ucwords($item->jenis_pembayaran)}}</td>
                            <td>{{\GeneralHelper::toRupiah($item->bayar)}}</td>
                            <td>{{\GeneralHelper::toRupiah($item->total_denda)}}</td>
                          </tr>
                        @endif   
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>    
    </div>
    <div class="col-md-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-block">
          <div class="divider"></div>
          <h3 class="card-title">Orang Tua</h3>
          <h6 class="card-subtitle mb-2 text-muted">Akun</h6>
          <ul class="timeline">
           <li>
              <div class="timeline-badge"><em class="fa fa-user"></em></div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h5 class="timeline-title mt-2">{{ucwords($data->getUserById->username)}} (User)</h5>
                </div>
                <div class="timeline-body">
                  <p>Nama : {{ucwords($data->getUserById->name)}}</p>
                </div>
              </div>
            </li>
            <li>
              <div class="timeline-badge"><em class="fa fa-mobile"></em></div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h5 class="timeline-title mt-2">{{$data->no_hp}}</h5>
                </div>
                <div class="timeline-body">
                  <p>{{ucwords($data->alamat)}}</p>
                </div>
              </div>
            </li>
            <li>
              <div class="timeline-badge"><em class="fa fa-suitcase"></em></div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h5 class="timeline-title mt-2">{{$data->pekerjaan_orang_tua}}</h5>
                </div>
                <div class="timeline-body">
                  <p> </p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-block">
          <div class="divider"></div>
          <h3 class="card-title">History pembayaran</h3>
          <h6 class="card-subtitle mb-2 text-muted">Administrasi</h6>
          <ul class="timeline">
            @foreach ($data->getPembayaran as $item)  
            @if ($item->jenis_pembayaran != 'bulanan')    
              <li>
                <div class="timeline-badge primary"><em class="fa fa-dollar"></em></div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h5 class="timeline-title mt-2">{{ucwords($item->jenis_pembayaran)}}</h5>
                  </div>
                  <div class="timeline-body">
                    <p>{{ date('d M Y',strtotime($item->tanggal)) }} - {{\GeneralHelper::toRupiah($item->bayar)}}</p>
                  </div>
                </div>
              </li>
            @endif  
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>
@endsection