@extends('layouts.be.master')

@section('header')
  @include('layouts.be.header')
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../../admin/assets/css/custom.css">
@endsection

@section('content')
  @include('layouts.be.menu')
  @include('layouts.be.search-infor')
  
  <div class="content-wrapper">

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thiết bị/</span> Danh sách thiết bị</h4>

      <div class="card">
        <h5 class="card-header">Danh sách thiết bị</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>Tên thiết bị</th>
                <th>Giá tiền</th>
                <th>Mô tả</th>
                <th>Loại thiết bị</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if ($facilities)
                @foreach ($facilities as $facility)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$facility->name}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$facility->price}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$facility->description}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$facility->facility_type->name}}</td>
                  <td>
                    <x-option routeEdit="{{route('facilities.edit', ['facility' => $facility->id])}}" routeDestroy="{{route('facilities.destroy', ['facility' => $facility->id])}}"/>
                  </td>
                </tr> 
                @endforeach
              @endif    
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  @include('layouts.be.footer')
@endsection

