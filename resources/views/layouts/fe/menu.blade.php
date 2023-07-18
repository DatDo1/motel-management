{{-- <div id="preloder">
    <div class="loader"></div>
</div> --}}

<header class="header ">
    <div class="header__top ">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul class="header__top__widget">
                        <li><span class="icon_pin_alt"></span> 167 Chấn Hưng, Phường 6, Quận Tân Bình, TP.HCM</li>
                        <li><span class="icon_phone"></span> (84) 365367059</li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="header__top__right">
                        <div class="header__top__auth">
                            <ul>
                                <li><a href="{{route('login')}}">Đăng nhập</a></li>
                                <li><a href="{{route('register')}}">Đăng ký</a></li>
                                @if (Auth::check())
                                    <li>
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class='bx bxs-user'></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href=""
                                            > Chỉnh sửa thông tin cá nhân
                                            </a>
                                            <a class="dropdown-item" href=""
                                            > Danh sách những booking đã đặt
                                            </a>
                                            <a class="dropdown-item" href="{{route('logout')}}"
                                            > Đăng xuất
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__nav__option">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="./index.html"><img src="" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header__nav">
                        <nav class="header__menu">
                            <ul class="menu__class">
                                <li class="active"><a href="{{route('cusHome')}}">Trang chủ</a></li>
                                <li><a href="./rooms.html">Các loại phòng</a></li>
                                <li></li>
                            </ul>
                        </nav>
                        <div class="header__nav__widget">
                            <a href="{{route('users.rooms.findRoom')}}">Đặt phòng <span class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <span class="fa fa-bars"></span>
            </div>
        </div>
    </div>
</header>