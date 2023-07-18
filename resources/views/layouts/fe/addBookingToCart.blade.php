@if(Session::has('room_quantity'))
    <div class="fixed-bottom custom-position" id="btn_addCart">
        <a href="{{route('cus.bookings.create')}}" target="_blank"
            class="btn btn-warning">
            Phòng đã chọn ({{Session::get('room_quantity')}})
        </a>
    </div>
@else
<div class="fixed-bottom custom-position" id="btn_addCart">
    <a href="{{route('cus.bookings.create')}}" target="_blank"
        class="btn btn-warning">
        Phòng đã chọn
    </a>
</div>
@endif