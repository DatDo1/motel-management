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
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Đặt phòng/</span> Danh sách đặt phòng</h4>

      <div class="card">
        <form action="{{route('bookings.createBookingByRoomIDs')}}" method="post" id="bookingForm">
          @csrf
          <h5 class="card-header">Danh sách đặt phòng</h5>
          <div class="row m-7-mb-24">
            <div class="col-md-2">
              Ngày đến <input type="date" id="checkin_date" name="checkinDate" min="<?php echo date('Y-m-d');?>" required>
            </div>
            <div class="col-md-2">
              Ngày đi <input type="date" id="checkout_date" name="checkoutDate" min="<?php echo date('Y-m-d');?>" required>
            </div>
            <div class="col-md-1">
              Người lớn
              <select name="adult_quantity" id="adult_quantity">
                <option value="3">3 Người</option>
                <option value="2">2 Người</option>
                <option value="1">1 Người</option>
              </select>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1">
              Trẻ em
              <select name="children_quantity" id="children_quantity">
                <option value="3">3 Người</option>
                <option value="2">2 Người</option>
                <option value="1">1 Người</option>
              </select>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
              <div id="btn-empty" buttonType="2" onclick="findmyall(this)" class="btn label label-default">
                <i class='bx bx-search-alt-2'></i> Lọc phòng
              </div>
            </div>
          </div>
          <div class="row m-7-mb-24">
            <div class="col-md-1">
              Loại phòng
              <select name="room_type" id="room_type">
                @if(isset($roomTypes))
                  @foreach ($roomTypes as $roomType)
                    <option value="{{$roomType->id}}">{{$roomType->name}}</option>     
                  @endforeach
                @endif
              </select>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
              Giá tiền phòng / đêm
              <select name="room_price" id="room_price">
                <option value="300000">Dưới 300000 VND</option>
                <option value="500000">Dưới 500000 VND</option>
                <option value="1000000">Dưới 1000000 VND</option>
              </select>
            </div>
            <div class="col-md-1">
              Tầng
              <select name="floor" id="floor">
                <option value="1">Tầng 1</option>
                <option value="2">Tầng 2</option>
                <option value="3">Tầng 3</option>
                <option value="4">Tầng 4</option>
              </select>
            </div>
          </div>
          <div class="row m-7-mb-24">
            <div class="col-md-2">
              {{-- <div id="btn-all" buttonType="1" onclick="findmyall(this)" class="btn label bg-info">Tất cả</div> --}}
            </div>
            <div class="col-md-2">
              {{-- <div id="btn-empty" buttonType="2" onclick="findmyall(this)" class="btn label label-success">Còn trống</div> --}}
            </div>
            <div class="col-md-2">
              {{-- <div id="btn-booked" buttonType="3" onclick="findmyall(this)" class="btn label label-danger">Đã đặt</div> --}}
            </div>
            <div class="col-md-2">
              {{-- <div id="btn-waiting" buttonType="4" onclick="findmyall(this)" class="btn label label-default">Đang chờ xử lý</div> --}}
            </div>
            <div class="col-md"></div>
            <div class="col-md-2">
              <button type="submit" class="">
                  <i class="bx bx-edit-alt me-2 "></i> Đặt phòng
              </button>
            </div>
          </div>
          <div class="table-responsive">
            <hr>
            <table class="table">
              <thead>
                <tr>
                  <th><input type="checkbox" class="check" id="checkAll"></th>
                  <th>Tên phòng</th>
                  <th>Tầng</th>
                  <th>Tình trạng</th>
                  <th>Giá tham khảo</th>
                  <th>Người lớn</th>
                  <th>Trẻ em</th>
                  <th>Loại phòng</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @if (isset($roomList))
                  @foreach ($roomList as $room)
                  <tr>
                    @if ($room->is_available == 0)
                      <td><input type="checkbox" class="check" value="{{$room->id}}" name="room_id[]"></td>
                    @else
                      <td><input type="checkbox" class="check" value="{{$room->id}}" name="room_id[]" disabled></td>
                    @endif
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
        </form>
        
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
      var adult_quantity = $('#adult_quantity').val();
      var children_quantity = $('#children_quantity').val();
      var room_type = $('#room_type').val();
      var room_price = $('#room_price').val();
      var floor = $('#floor').val();

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
          adult_quantity: adult_quantity,
          children_quantity: children_quantity,
          room_type: room_type,
          room_price: room_price,
          floor: floor,
          btnType: btnType
        },

        success: function (data) {
              $('table tbody').html(data);
        }
      });
    }

    $(document).ready(function () {
      $('#checkin_date').max = new Date().toLocaleDateString('fr-ca')

      $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
      });

      $('.check').click(function () {
        if(!$(this).is(':checked')){
          $(this).attr("value", "");
        }
      })
    })

  </script>
@endsection

