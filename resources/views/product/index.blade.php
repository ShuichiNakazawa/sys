@extends('layouts.app_ec')

@section('title')

商品一覧
@endsection

@section('content')
<div class="jumbotron top-img">
  <p class="text-center text-white top-img-text">{{ config('app.name.ec.sample', 'Straipe決済サンプル') }}</p>
</div>

<div class="container">
  <div class="top__title text-center">
    All Products
  </div>
  <div class="row">
    @foreach($products as $product)
    <a href="{{ route('product.show', $product->id) }}" class="col-lg-4 col-md-6">

      <div class="card card__btn_scale">
        <img src="{{ asset($product->image) }}" class="card-img"/>
        <div class="card-body">
          <p class="card-title">{{ $product->name }}</p>
          <p class="card-text">{{ number_format($product->price) }}</p>
        </div>
      </div>
    </a>
    @endforeach
  </div>
</div>

@endsection
