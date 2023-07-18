@if (isset($roomList))
@foreach ($roomList as $room)
<div class="row border">
    <div class="col-md-6 col-sm-6">
            <div id="serv_hover"  class="room">
                <div class="room_img">
                    <?php
                        $a = unserialize($room->image);
                        $b = array_values($a)[0];
                    ?>
                    @if(isset($b))
                        <figure><a href="{{route('cus.rooms.roomDetail', ['room' => $room->uuid])}}"><img class=" w-100" src="{{url('admin/assets/img/rooms/'.$b)}}"/></a></figure>
                    @endif
                </div>
            </div>
    </div> 
    <div class="col-md-5 col-sm-6">
        <div class="bed_room p-4">
            <h3>Loại phòng {{$room->room_type->name}}</h3>
            <p>Phù hợp với {{$room->adult_quantity}} nguời lớn, {{$room->children_quantity}} trẻ em</p>
            <p>Giá phòng {{$room->reference_price}} VND/đêm</p>
        </div>

        <div class="btn label label-yellow p-2">
            Đặt phòng
        </div>
    </div>
        
</div>
@endforeach
    
    {{-- <h1> Có phòng đã đặt vào thời gian này nhé!</h1> --}}
@else
    <span>Không có phòng đã đặt vào thời gian này !</span>
@endif    
