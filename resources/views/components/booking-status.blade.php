<div>
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="bx bx-dots-vertical-rounded"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{$routeDetail}}"
            ><i class="bx bx-edit-alt me-2"></i> Xem chi tiết
        </a>
        <form action="{{$acceptBooking}}" method="post" {{$acceptBookingAttr}}>
            @csrf
            <button type="submit" class="dropdown-item"><i class="bx bx-edit-alt me-2"></i>Chấp nhật đặt phòng</button>
        </form>
        <form action="{{$cancelBooking}}" method="post">
            @csrf
            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-2"></i>Hủy đặt phòng</button>
        </form>
    </div>
</div>