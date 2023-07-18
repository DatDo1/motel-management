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
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Nhân viên/</span> Danh sách nhân viên</h4>

      <div class="card">
        <h5 class="card-header">Danh sách nhân viên</h5>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Họ và tên đệm</th>
                <th>Tên</th>
                <th>CMND/CCCD</th>
                <th>Phone number</th>
                <th>Địa chỉ</th>
                <th>Lương cơ bản</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if ($empList)
                @foreach ($empList as $emp)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$emp->user->first_name}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$emp->user->last_name}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$emp->user->citizen_identification}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$emp->user->phone_number}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$emp->user->address}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$emp->basic_salary}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$emp->user->email}}</td>
                  <td>
                    <x-option routeDetail="{{route('employees.show', ['employee' => $emp->id])}}" routeEdit="{{route('employees.edit', ['employee' => $emp->id])}}" routeDestroy="{{route('employees.destroy', ['employee' => $emp->id])}}" routeBooking="" bookingClass="hidden"/>
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

