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
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Phòng/</span> Danh sách phòng</h4>

      <div class="card">
        {{-- <form action="{{route('bookings.createBookingByRoomIDs')}}" method="post">
          @csrf --}}
          <h5 class="card-header">Danh sách phòng</h5>
          {{-- <div class="row m-7-mb-24">
            <div class="col-md-4">
              Ngày đến <input type="date" id="checkin_date" name="checkinDate" min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-md-4">
              Ngày đi <input type="date" id="checkout_date" name="checkoutDate" min="<?php echo date('Y-m-d'); ?>">
            </div>
          </div> --}}
          {{-- <div class="row m-7-mb-24">
            <div class="col-md-2">
              
              <div id="btn-all" buttonType="1" onclick="findmyall(this)" class="btn label bg-info">Tất cả</div>
            </div>
            <div class="col-md-2">
              <div id="btn-empty" buttonType="2" onclick="findmyall(this)" class="btn label label-success">Còn trống</div>
            </div>
            <div class="col-md-2">
              <div id="btn-booked" buttonType="3" onclick="findmyall(this)" class="btn label label-danger">Đã đặt</div>
            </div>
            <div class="col-md-2">
              <div id="btn-waiting" buttonType="4" onclick="findmyall(this)" class="btn label label-default">Đang chờ xử lý</div>
            </div>
            <div class="col-md"></div>
            <div class="col-md-2">
              <button type="submit" class="">
                  <i class="bx bx-edit-alt me-2 "></i> Đặt phòng
              </button>
            </div>
          </div> --}}
          <div class="table-responsive">
            <hr>
            <table class="table">
              <thead>
                <tr>
                  <th>Tên phòng</th>
                  <th>Tầng</th>
                  <th>Tình trạng hiện tại</th>
                  <th>Giá tham khảo</th>
                  <th>Số lượng người lớn</th>
                  <th>Số lượng trẻ em</th>
                  <th>Loại phòng</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @if (isset($roomList))
                  @foreach ($roomList as $room)
                  <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->name}}</td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->floor}}</td>
                    <x-room-status status='{{$room->is_available}}' />
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->reference_price}}</td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->adult_quantity}}</td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->children_quantity}}</td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->room_type->name}}</td>
                    @if ($room->is_available == 0)
                      <td>
                          <x-option routeDetail="{{route('rooms.show', ['room' => $room->id])}}" routeEdit="{{route('rooms.edit', ['room' => $room->id])}}" routeDestroy="{{route('rooms.destroy', ['room' => $room->id])}}" routeBooking="{{route('bookings.createBookingByRoomID', ['id'=>$room->id])}}" bookingClass=""/>    
                      </td>  
                    @else
                      <td>
                        <x-option routeDetail="{{route('rooms.show', ['room' => $room->id])}}" routeEdit="{{route('rooms.edit', ['room' => $room->id])}}" routeDestroy="{{route('rooms.destroy', ['room' => $room->id])}}" routeBooking="" bookingClass="disabled"/>    
                      </td> 
                    @endif
                  </tr> 
                  @endforeach
                @endif    
              </tbody>
            </table>
          </div>
        {{-- </form> --}}
        
      </div>
    </div>
  </div>
@endsection

@section('footer')
  @include('layouts.be.footer')

  <script>

    function findmyall(btn){
      var btnType = $(btn).attr('buttonType');
      var checkinDate = $('#checkin_date').val();
      var checkoutDate = $('#checkout_date').val();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({
        url: '{{route('rooms.findAllRoomByDate')}}',
        method: 'POST',
        data: {
          checkinDate: checkinDate,
          checkoutDate: checkoutDate,
          btnType: btnType
        },

        success: function (data) {
              $('table tbody').html(data);
        }
      });
    }

  </script>
@endsection

