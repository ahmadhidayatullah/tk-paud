@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-block">
                <h3 class="card-title">Log Aktivitas</h3>
                
                <div class="table-responsive">
                    @if(session('message')) {!!session('message')!!} @endif
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Url</th>
                          <th>Method</th>
                          <th>Ip</th>
                          <th>Agent</th>
                          <th>User Id</th>
                          <th>Tgl Log</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($logs as $log)
                        <tr>
                          <td class="width-350">{{$log->subject}}</td>
                          <td class="width-200">{{$log->url}}</td>
                          <td class="width-200"><span class="tag tag-pill tag-info">{{$log->method}}</span></td>
                          <td class="width-200">{{$log->ip}}</td>
                          <td class="width-350">{{$log->agent}}</td>
                          <td class="width-200">{{$log->getUserById->name}}</td>
                          <td class="width-200">{{$log->created_at}}</td>
        
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Subject</th>
                          <th>Url</th>
                          <th>Method</th>
                          <th>Ip</th>
                          <th>Agent</th>
                          <th>User Id</th>
                          <th>Tgl Log</th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection