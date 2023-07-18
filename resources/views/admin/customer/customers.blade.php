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
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Khách hàng/</span> Danh sách khách hàng</h4>

      <div class="card">
        <h5 class="card-header">Danh sách khách hàng</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>Họ và tên đệm</th>
                <th>Tên</th>
                <th>CMND/CCCD</th>
                <th>Phone number</th>
                <th>Địa chỉ</th>
                <th>Thẻ tín dụng</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if ($cusList)
                @foreach ($cusList as $cus)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$cus->user->first_name}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$cus->user->last_name}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$cus->user->citizen_identification}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$cus->user->phone_number}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$cus->user->address}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$cus->credit_card}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$cus->user->email}}</td>
                  <td>
                    <div>
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                          ><i class="bx bx-edit-alt me-2"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                          ><i class="bx bx-trash me-2"></i> Delete</a
                        >
                      </div>
                    </div>
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

