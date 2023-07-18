@extends('layouts.fe.master')

@section('title')
    Hotel Shaga - Chi tiết phòng
@endsection
@section('header')
  @include('layouts.fe.header')
@endsection
    
@section('content')
    @include('layouts.fe.menu')
    
    <br>
    <br>
    <br>
    <!-- Room Details Slider Begin -->
    <div class="room-details-slider">
        <div class="container">
            <div class="room__details__pic__slider owl-carousel">
                    <?php
                        $roomImgs = unserialize($room->image);                     
                    ?>
                @foreach ($roomImgs as $roomImg)
                    <div class="room__details__pic__slider__item set-bg" data-setbg="{{url('admin/assets/img/rooms/'.$roomImg)}}"></div>           
                @endforeach
            </div>
        </div>
    </div>
    <!-- Room Details Slider End -->

    <!-- Rooms Details Section Begin -->
    <section class="room-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="room__details__content">
                        {{-- <div class="room__details__rating">
                            <div class="room__details__hotel">
                                <span>Hotel</span>
                                <div class="room__details__hotel__rating">
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star-half_alt"></span>
                                </div>
                            </div>
                            <div class="room__details__advisor">
                                <img src="img/rooms/details/tripadvisor.png" alt="">
                                <div class="room__details__advisor__rating">
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star-half_alt"></span>
                                </div>
                                <span class="review">(1000 Reviews)</span>
                            </div>
                        </div> --}}
                        <div class="room__details__title">
                            <h2>Loại phòng {{$room->room_type->name}}</h2>
                            <div id="btn_addBooking" onclick="addBookingtoCart(this)" room_id="{{$room->id}}" class="primary-btn btn ">Thêm đặt phòng</div>
                        </div>
                        {{-- <div >
                            <input class="datepicker" type="date" name="" id="">
                        </div> --}}
                        <div class="room__details__desc">
                            <h2>Mô tả</h2>
                            <p>We’re halfway through the summer, but while plenty of people are kicking back and
                                enjoying their vacations, the social media development teams likely aren’t doing the
                                same. In the past two weeks alone, we’ve seen four big new updates that can directly
                                impact the social marketing campaigns of hotels, resorts, and other businesses in the
                                hospitality industry. Let’s take a close look at each one.</p>
                            <p>The new desktop version of the site is significantly improved, which will make it easier
                                for hotels and resorts to navigate the platform.</p>
                            <p>There is one big change though that we want to note, and that’s the more live video and
                                local moments (the latter of which are based on your location). These will be
                                prioritized in users’ feeds, so take advantage of this and create this content to
                                improve your reach and connect with more members of your target audience.</p>
                            <p>We’ve gotten yet another new feature for Instagram Stories, and this time it’s the Chat
                                sticker, which allows you to invite Story followers to join in on a new group chat.
                                Instagram is currently advertising this as a way to jumpstart big group conversations or
                                make plans.</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="room__details__facilities">
                                    <h2>Others facilities:</h2>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul>
                                                <li><span class="icon_check"></span> Takami Bridal Attire</li>
                                                <li><span class="icon_check"></span> Esthetic Salon</li>
                                                <li><span class="icon_check"></span> Multilingual staff</li>
                                                <li><span class="icon_check"></span> Dry cleaning and laundry</li>
                                                <li><span class="icon_check"></span> Credit cards accepted</li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul>
                                                <li><span class="icon_check"></span> Rent-a-car</li>
                                                <li><span class="icon_check"></span> Reservation & confirmation</li>
                                                <li><span class="icon_check"></span> Babysitter upon request</li>
                                                <li><span class="icon_check"></span> 24-hour currency exchange</li>
                                                <li><span class="icon_check"></span> 24-hour Manager on Duty</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="room__details__more__facilities">
                                    <h2>Most popular facilities:</h2>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-1.png"
                                                        alt=""></div>
                                                <h6>Air Conditioning</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-2.png"
                                                        alt=""></div>
                                                <h6>Cable TV</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-3.png"
                                                        alt=""></div>
                                                <h6>Free drinks</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-4.png"
                                                        alt=""></div>
                                                <h6>Unlimited Wifi</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-5.png"
                                                        alt=""></div>
                                                <h6>Restaurant quality</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-6.png"
                                                        alt=""></div>
                                                <h6>Service 24/24</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-7.png"
                                                        alt=""></div>
                                                <h6>Gym Centre</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-8.png"
                                                        alt=""></div>
                                                <h6>Spa & Wellness</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('layouts.fe.addBookingToCart')
                
            </div>
        </div>
    </section>

@endsection

@section('footer')
  @include('layouts.fe.footer')
  <script>
    function addBookingtoCart(room){
            var room_id = $(room).attr('room_id');
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: '{{route('users.rooms.addBookingtoCart')}}',
                method: 'POST',
                data: {
                    room_id: room_id,
                },

                success: function (data) {
                    $('#btn_addCart').html(`<a
                        href="{{route('cus.bookings.create')}}"
                        target="_blank"
                        class="btn btn-warning">
                        Phòng đã chọn (${data[0]})
                        </a>`);
                }
            });
            
        }


  </script>
@endsection