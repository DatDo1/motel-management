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
    
    {{-- <h1> Có phòng đã đặt vào thời gian này nhé!</h1> --}}
@else
    <span>Không có phòng đã đặt vào thời gian này !</span>
@endif    
