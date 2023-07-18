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
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Đặt phòng/</span> Danh sách booking đã đặt</h4>

      <div class="card">
        <h5 class="card-header">Danh sách booking đã đặt</h5>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Ngày đến</th>
                <th>Ngày đi</th>
                <th>Phòng</th>
                <th>Số tiền</th>
                <th>Số lượng phòng</th>
                <th>Tên khách hàng</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if ($bookingRooms)
                @foreach ($bookingRooms as $bookingRoom)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$bookingRoom->checkin_date}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$bookingRoom->checkout_date}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$bookingRoom->room_id}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$bookingRoom->pay_price}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$bookingRoom->booking_id}}</td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$bookingRoom->booking_id}}</td>
                  <td>
                    <x-booking-status routeDetail="" acceptBooking="" acceptBookingAttr="hidden" cancelBooking="{{route('bookings.cancelBooking', ['booking' => $bookingRoom->uuid])}}"/>
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

