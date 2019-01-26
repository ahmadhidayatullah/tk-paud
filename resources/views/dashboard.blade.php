@extends('layouts.master') 
@section('content')
<section class="row">
    <div class="col-md-12 col-lg-12">
      <div class="jumbotron">
        <h1 class="mb-4">Hello, {{Auth::user()->name}}!</h1>
        <p class="lead">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus est consequuntur fuga. Id veritatis facere at ullam ipsum voluptatum, ducimus quia mollitia dicta dolores, nesciunt iste laborum porro aliquam quasi!
        </p>
      </div>
    </div>
  </section>
@endsection