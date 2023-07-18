 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme menu-custom">
    <div class="app-brand demo">

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    @if (auth()->user()->user_level == 2)
    <ul class="menu-inner py-1">
      <li class="menu-item w-100">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div >Phòng</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item w-100">
            <a href="{{route('rooms.index')}}" class="menu-link">
              <div>Danh sách phòng</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item w-100">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div>Đặt phòng</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item w-100">
            <a href="{{route('bookings.index')}}" class="menu-link">
              <div>Danh sách đặt phòng</div>
            </a>
          <li class="menu-item w-100">
            <a href="{{route('bookings.bookedList')}}" class="menu-link">
              <div>Danh sách booking đã đặt</div>
            </a>
          </li>
          <li class="menu-item w-100">
            <a href="{{route('bookings.handleBooking')}}" class="menu-link">
              <div>Danh sách xử lý đặt phòng</div>
            </a>
          </li>
          <li class="menu-item w-100">
            <a href="{{route('bookings.canceBookingView')}}" class="menu-link">
              <div>Danh sách hủy đặt phòng</div>
            </a>
          </li>
        </ul>
      </li>
    </ul>
    @elseif(auth()->user()->user_level == 1)
      <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item w-100">
          <a href="index.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
          </a>
        </li>

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Trang quản lý</span>
        </li>
        <li class="menu-item w-100">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div>Khách hàng</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{route('customers.index')}}" class="menu-link">
                <div>Danh sách khách hàng</div>
              </a>
            </li>
            </li>
          </ul>
        </li>
        <li class="menu-item w-100">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div>Nhân viên</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{route('employees.index')}}" class="menu-link">
                <div>Danh sách nhân viên</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('employees.create')}}" class="menu-link">
                <div>Tạo mới nhân viên</div>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item w-100">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div >Phòng</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{route('rooms.index')}}" class="menu-link">
                <div>Danh sách phòng</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('rooms.create')}}" class="menu-link">
                <div>Thêm phòng mới</div>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item w-100">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div>Loại phòng</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{route('room_types.index')}}" class="menu-link">
                <div>Danh sách loại phòng</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('room_types.create')}}" class="menu-link">
                <div>Thêm mới loại phòng</div>
              </a>
            </li>
          </ul>
        </li>
      
        <li class="menu-item w-100">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div>Thiết bị</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{route('facilities.index')}}" class="menu-link">
                <div>Danh sách thiết bị</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('facilities.create')}}" class="menu-link">
                <div>Thêm mới thiết bị</div>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item w-100">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div>Loại thiết bị</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{route('facility_types.index')}}" class="menu-link">
                <div>Danh sách loại thiết bị</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('facility_types.create')}}" class="menu-link">
                <div>Thêm mới loại thiết bị</div>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item w-100">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div>Thời điểm</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{route('occasion_pricings.index')}}" class="menu-link">
                <div>Danh sách thời điểm</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('occasion_pricings.create')}}" class="menu-link">
                <div>Thêm mới thời điểm</div>
              </a>
            </li>
          </ul>
        </li>
    
        
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Trang đặt phòng</span></li>
        <!-- Forms -->
        <li class="menu-item w-100">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div>Đặt phòng</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item w-100">
              <a href="{{route('bookings.index')}}" class="menu-link">
                <div>Danh sách đặt phòng</div>
              </a>
            <li class="menu-item w-100">
              <a href="{{route('bookings.bookedList')}}" class="menu-link">
                <div>Danh sách booking đã đặt</div>
              </a>
            </li>
            <li class="menu-item w-100">
              <a href="{{route('bookings.handleBooking')}}" class="menu-link">
                <div>Danh sách phòng chờ xử lý đặt phòng</div>
              </a>
            </li>
            <li class="menu-item w-100">
              <a href="{{route('bookings.canceBookingView')}}" class="menu-link">
                <div>Danh sách phòng chờ hủy đặt phòng</div>
              </a>
            </li>
          </ul>
        </li>
      
      </ul>    
    @endif
  </aside>
  <!-- / Menu -->
