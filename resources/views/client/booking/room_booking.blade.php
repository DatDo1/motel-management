@foreach ($room_bookings as $room)
    <div class="">
        <input type="button" class="w-100" value="{{$room->name}}" id="room-{{$room->name}}" onclick="createBooking(this)">
        <input type="hidden" name="roomIDs[]" value="{{$room->id}}"/>
    </div>
    <div class="pr-4">
        <i class="fa fa-window-close btn p-0" style="font-size:22px" onclick="removeRoom(this)" room_id="{{$room->id}}"></i>
    </div>
@endforeach