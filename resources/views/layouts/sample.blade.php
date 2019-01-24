@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-8">
        <div class="card mb-4">
            <div class="card-block">
                <h3 class="card-title">Recent Orders</h3>
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
</section>
@endsection