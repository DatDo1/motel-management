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
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loại thiết bị/</span> Danh sách loại thiết bị</h4>

      <div class="card">
        <h5 class="card-header">Danh sách loại thiết bị</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>Tên loại thiết bị</th>
                <th>Mô tả</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if ($facilityTypes)
                @foreach ($facilityTypes as $facilityType)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$facilityType->name}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$facilityType->description}}</td>
                  <td>
                    <x-option routeDetail="" routeBooking="" bookingClass="hidden"  routeEdit="{{route('facility_types.edit', ['facility_type' => $facilityType->id])}}" routeDestroy="{{route('facility_types.destroy', ['facility_type' => $facilityType->id])}}"/>
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

