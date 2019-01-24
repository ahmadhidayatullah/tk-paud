@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-8">
      <div class="jumbotron">
        <h1 class="mb-4">Hello, {{Auth::user()->name}}!</h1>
        <p class="lead">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus est consequuntur fuga. Id veritatis facere at ullam ipsum voluptatum, ducimus quia mollitia dicta dolores, nesciunt iste laborum porro aliquam quasi!
        </p>
      </div>
      <div class="card mb-4">
        <div class="card-block">
          <h3 class="card-title">Grafik</h3>
          <div class="dropdown card-title-btn-container">
            <button class="btn btn-sm btn-subtle" type="button"><em class="fa fa-list-ul"></em> View All</button>
            <button class="btn btn-sm btn-subtle dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><em class="fa fa-cog"></em></button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#"><em class="fa fa-search mr-1"></em> More info</a>
                <a class="dropdown-item" href="#"><em class="fa fa-thumb-tack mr-1"></em> Pin Window</a>
                <a class="dropdown-item" href="#"><em class="fa fa-remove mr-1"></em> Close Window</a></div>
          </div>
          <h6 class="card-subtitle mb-2 text-muted">Aktifitas Surat</h6>
          <div class="canvas-wrapper">
            <canvas class="chart" id="line-chart" height="200" width="600"></canvas>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-block">
          <h3 class="card-title">Belum Diproses</h3>
          <div class="dropdown card-title-btn-container">
            <button class="btn btn-sm btn-subtle" type="button"><em class="fa fa-list-ul"></em> View All</button>
            <button class="btn btn-sm btn-subtle dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><em class="fa fa-cog"></em></button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#"><em class="fa fa-search mr-1"></em> More info</a>
                <a class="dropdown-item" href="#"><em class="fa fa-thumb-tack mr-1"></em> Pin Window</a>
                <a class="dropdown-item" href="#"><em class="fa fa-remove mr-1"></em> Close Window</a></div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Order #</th>
                  <th>Product</th>
                  <th>Customer</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>0001</td>
                  <td>Product Name 1</td>
                  <td>Customer 1</td>
                  <td>Complete</td>
                </tr>
                <tr>
                  <td>0002</td>
                  <td>Product Name 2</td>
                  <td>Customer 2</td>
                  <td>Complete</td>
                </tr>
                <tr>
                  <td>0003</td>
                  <td>Product Name 3</td>
                  <td>Customer 3</td>
                  <td>Processing</td>
                </tr>
                <tr>
                  <td>0004</td>
                  <td>Product Name 4</td>
                  <td>Customer 4</td>
                  <td>Pending</td>
                </tr>
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
          <h3 class="card-title">Timeline</h3>
          <h6 class="card-subtitle mb-2 text-muted">Surat Baru</h6>
          <ul class="timeline">
            <li>
              <div class="timeline-badge"><em class="fa fa-camera"></em></div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h5 class="timeline-title mt-2">Lorem ipsum</h5>
                </div>
                <div class="timeline-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="timeline-badge primary"><em class="fa fa-link"></em></div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h5 class="timeline-title mt-2">Dolor</h5>
                </div>
                <div class="timeline-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="timeline-badge"><em class="fa fa-paperclip"></em></div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h5 class="timeline-title mt-2">Sit amet</h5>
                </div>
                <div class="timeline-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
@endsection