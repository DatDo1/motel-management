@extends('layouts.fe.master')

@section('title')
    Hotel Shaga - Tạo mới booking
@endsection
@section('header')
  @include('layouts.fe.header')
@endsection
    
@section('content')
  @include('layouts.fe.menu')
  <section class="hero spad set-bg" data-setbg="../../../client/img/hero.jpg">
    @include('layouts.fe.search') 
  </section>

    
@endsection

@section('footer')
    @include('layouts.fe.footer')
@endsection 