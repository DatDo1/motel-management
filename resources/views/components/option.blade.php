<div>
  @if(auth()->check())
    @if (auth()->user()->user_level == 1)
      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="bx bx-dots-vertical-rounded"></i>
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{$routeDetail}}"
          ><i class="bx bx-edit-alt me-2"></i> Xem chi tiết
        </a>
        <a class="dropdown-item" href="{{$routeEdit}}"
          ><i class="bx bx-edit-alt me-2"></i> Chỉnh sửa
        </a>
        <form action="{{$routeDestroy}}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="dropdown-item"><i class="bx bx-trash me-2"></i> Xóa</button>
        </form>
        <a class="dropdown-item" href="{{$routeBooking}}" {{$bookingClass}}
          ><i class="bx bx-edit-alt me-2"></i> Đặt phòng
        </a>
      </div>  
    @elseif (auth()->user()->user_level == 2)
      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="bx bx-dots-vertical-rounded"></i>
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{$routeDetail}}"
          ><i class="bx bx-edit-alt me-2"></i> Xem chi tiết
        </a>
        <a class="dropdown-item {{$bookingClass}}" href="{{$routeBooking}}" >
          <i class="bx bx-edit-alt me-2 "></i> Đặt phòng
        </a>
      </div>
    @endif
  @else
    <div class="btn">
      <a class="dropdown-item {{$bookingClass}}" href="{{$routeBooking}}" >
        <i class="bx bx-edit-alt me-2 "></i> Đặt phòng
      </a>
    </div>
  @endif
</div>