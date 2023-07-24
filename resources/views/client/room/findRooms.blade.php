@extends('layouts.fe.master')

@section('title')
    Hotel Shaga - Tạo mới booking
@endsection
@section('header')
  @include('layouts.fe.header')
@endsection
    
@section('content')
  @include('layouts.fe.menu')
  <section class="hero spad set-bg" data-setbg="../../../client/img/hero.jpg">
    @include('layouts.fe.search') 
    @include('layouts.fe.filter_rooms') 
  </section>

  

  <div class="custom_room">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Các loại phòng</h2>
                  {{-- <p>Lorem Ipsum available, but the majority have suffered</p> --}}
               </div>
            </div>
         </div>
        <div class="row">
            <div class="col-md-3">
                <div class="border border-dark p-4">
                    Loại phòng bạn muốn ở
                    @if(isset($roomTypeList))
                        @foreach($roomTypeList as $roomType)
                            <div class="form-check">
                                <input class="form-check-input room-type" type="checkbox" value="{{$roomType->id}}" id="" name="room_type"/>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$roomType->name}}
                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="border border-dark p-4">
                    Chọn tầng bạn mong muốn 
                    <div class="form-check">
                        <input class="form-check-input floor" type="checkbox" value="1" id="" name="floor"/>
                        <label class="form-check-label" for="flexCheckDefault">
                          Tầng 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input floor" type="checkbox" value="2" id="" name="floor"/>
                        <label class="form-check-label" for="flexCheckChecked">
                          Tầng 2
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input floor" type="checkbox" value="3" id="" name="floor"/>
                        <label class="form-check-label" for="flexCheckChecked">
                          Tầng 3
                        </label>
                    </div>

                    {{-- <div class="btn" id="btn_findRoomByPrice" onclick="btn_findRoomByPrice(this)" buttonType="4">
                        <button>Tìm phòng</button>
                    </div> --}}
                </div>
                <div class="border border-dark p-4">
                    Ngân sách của bạn mỗi đêm
                    <div class="form-check">
                        <input class="form-check-input price" type="checkbox" value="300000" id="p300K" name="room_price"/>
                        <label class="form-check-label" for="flexCheckDefault">
                          Dưới 300000 VND
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="checkbox" value="500000" id="p500K" name="room_price"/>
                        <label class="form-check-label" for="flexCheckChecked">
                          Dưới 500000 VND
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="checkbox" value="1000000" id="p100K" name="room_price"/>
                        <label class="form-check-label" for="flexCheckChecked">
                          Dưới 1000000 VND
                        </label>
                    </div>
                    {{-- <div class="btn" id="btn_findRoomByPrice" onclick="btn_findRoomByPrice(this)" buttonType="4">
                        <button>Tìm phòng</button>
                    </div> --}}
                </div>
            </div>

            <div class="col-md-8" id="roomList">
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
                                <input type="hidden" name="room_id" value="{{$room->id}}" id="room_id" />
                            </div>

                            <div class="btn label label-yellow p-2" id="btn_addBooking" onclick="addBookingtoCart(this)" room_id="{{$room->id}}">
                                Thêm đặt phòng
                            </div>
                        </div>
                            
                    </div>
                @endforeach

            </div>
        </div>
        @include('layouts.fe.addBookingToCart')
        
    </div>
 </div>
@endsection

@section('footer')
    @include('layouts.fe.footer')
    <script>

        $('.room-type').on('change', function(){
            var roomType = null;
            if($('.room-type').not(this).prop('checked', false)){
                roomType = null;
            }
            if($(this).prop('checked')){
                roomType = $(this).val();
            }
            var floor = $('.floor:checked').val()!=undefined?$('.floor:checked').val():null;
            var price = $('.price:checked').val()!=undefined?$('.price:checked').val():null;
            var checkinDate = $('#checkin_date').val();
            var checkoutDate = $('#checkout_date').val();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: '{{route('users.rooms.findRoomsByOption')}}',
                method: 'POST',
                data: {
                    checkinDate: checkinDate,
                    checkoutDate: checkoutDate,
                    roomType: roomType,
                    floor: floor,
                    price: price
                },

                success: function (data) {
                    $('#roomList').html(data);
                }
            });
        })

        $('.floor').on('change', function(){
            var floor = null;
            if($('.floor').not(this).prop('checked', false)){
                floor = null;
            }
            if($(this).prop('checked')){
                floor = $(this).val();
            }
            var roomType = $('.room-type:checked').val()!=undefined?$('.room-type:checked').val():null;
            var price = $('.price:checked').val()!=undefined?$('.price:checked').val():null;
            var checkinDate = $('#checkin_date').val();
            var checkoutDate = $('#checkout_date').val();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: '{{route('users.rooms.findRoomsByOption')}}',
                method: 'POST',
                data: {
                    checkinDate: checkinDate,
                    checkoutDate: checkoutDate,
                    roomType: roomType,
                    floor: floor,
                    price: price
                },

                success: function (data) {
                    $('#roomList').html(data);
                }
            });
        })

        $('.price').on('change', function(){
            var price = null;
            if($('.price').not(this).prop('checked', false)){
                price = null;
            }
            if($(this).prop('checked')){
                price = $(this).val();
            }
           
            var floor = $('.floor:checked').val()!=undefined?$('.floor:checked').val():null;
            var roomType = $('.room-type:checked').val()!=undefined?$('.room-type:checked').val():null;
            var checkinDate = $('#checkin_date').val();
            var checkoutDate = $('#checkout_date').val();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: '{{route('users.rooms.findRoomsByOption')}}',
                method: 'POST',
                data: {
                    checkinDate: checkinDate,
                    checkoutDate: checkoutDate,
                    roomType: roomType,
                    floor: floor,
                    price: price
                },

                success: function (data) {
                    $('#roomList').html(data);
                }
            });
        })

        function findmyall(btn){
            var btnType = $(btn).attr('buttonType');
            var checkinDate = $('#checkin_date').val();
            var checkoutDate = $('#checkout_date').val();
            var adult_quantity = $('#adult_quantity').val();
            var children_quantity = $('#children_quantity').val();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: '{{route('users.rooms.filterRooms')}}',
                method: 'POST',
                data: {
                    checkinDate: checkinDate,
                    checkoutDate: checkoutDate,
                    adult_quantity: adult_quantity,
                    children_quantity: children_quantity,
                    btnType: btnType
                },

                success: function (data) {
                    $('#roomList').html(data);
                }
            });
        }

        function btn_findRoomByPrice(btn){
            var room_price = $('input[name="room_price"]:checked').val();
            
            var btnType = $(btn).attr('buttonType');
            var checkinDate = $('#checkin_date').val();
            var checkoutDate = $('#checkout_date').val();
            var adult_quantity = $('#adult_quantity').val();
            var children_quantity = $('#children_quantity').val();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: '{{route('users.rooms.filterRooms')}}',
                method: 'POST',
                data: {
                    checkinDate: checkinDate,
                    checkoutDate: checkoutDate,
                    adult_quantity: adult_quantity,
                    children_quantity: children_quantity,
                    room_price: room_price,
                    btnType: btnType
                },

                success: function (data) {
                    $('#roomList').html(data);
                }
            });
        }


       function addBookingtoCart(room){
            var room_id = $(room).attr('room_id');
            var checkin_date = $("#checkin_date").val()!=null?$("#checkin_date").val():"";
            var checkout_date = $("#checkout_date").val()!=null?$("#checkout_date").val():"";

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
                    checkin_date : checkin_date,
                    checkout_date : checkout_date
                },

                success: function (data) {
                    $('#btn_addCart').html(`<a
                        href="{{route('cus.bookings.create')}}"
                        target="_blank"
                        class="btn btn-warning">
                        Phòng đã chọn (${data[0]})
                        </a>`
                        );
                    
                    
                }
            });
            
        } 
    </script>

    
@endsection