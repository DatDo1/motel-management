<div class="container">

    <div class="card">
        <br>
        <form action="{{route('bookings.createBookingByRoomIDs')}}" method="post">
          @csrf
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
          <br>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th><input type="checkbox" class="check" id="checkAll"></th>
                  <th>Tên phòng</th>
                  <th>Tầng</th>
                  <th>Tình trạng</th>
                  <th>Giá tham khảo</th>
                  <th>Số người ở tối đa</th>
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
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><a href="{{route('cus.rooms.roomDetail', ['room' => $room->id])}}">{{$room->name}}</a></td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->floor}}</td>
                    <x-room-status status='{{$room->is_available}}' />
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->reference_price}}</td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{$room->people_quantity}}</td>
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