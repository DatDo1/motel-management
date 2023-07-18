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
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thời điểm/</span> Danh sách thời điểm</h4>

      <div class="card">
        <h5 class="card-header">Danh sách thời điểm</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>Thời điểm</th>
                <th>Mô tả</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if ($occasionList)
                @foreach ($occasionList as $occasion)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$occasion->time}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$occasion->description}}</td>  
                  <td>
                    <x-option routeEdit="{{route('occasion_pricings.edit', ['occasion_pricing' => $occasion->id])}}" routeDestroy="{{route('occasion_pricings.destroy', ['occasion_pricing' => $occasion->id])}}"/>
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

