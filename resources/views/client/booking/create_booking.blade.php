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
  </section>
  <br>
  <div class="container ">
    <div class="row " id="booking-form">
      {{-- <div class="col-md-6">
        <div class="p-0 order-lg-2 order-md-2">
          <div class="room__pic__slider owl-carousel">
            <?php
              $roomImgs = unserialize($room->image);                     
            ?>
            @foreach ($roomImgs as $roomImg)
                <div class="room__details__pic__slider__item set-bg" data-setbg="{{url('admin/assets/img/rooms/'.$roomImg)}}"></div>           
            @endforeach
          </div>
        </div>
      </div> --}}
      
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h2 class="mb-0">Thêm mới đặt phòng</h2>
          </div>
          <div class="card-body">
            <form action="{{route('user-bookings.store')}}" method="post">
              @csrf     
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="basic-default-room_quantity">Phòng</label>
                <div class="col-sm-8">
                  <div class="row" id="room_list">
                    @if(Session::has('room_bookings'))
                      @foreach (session('room_bookings') as $room)
                          <div class="">
                            <input type="button" class="w-100" value="{{$room->name}}" id="room-{{$room->name}}" room_id="{{$room->id}}" onclick="createDetailBooking(this)">
                            <input type="hidden" name="roomIDs[]" value="{{$room->id}}"/>
                          </div>
                          <div class="pr-4">
                            <i class="fa fa-window-close btn p-0" style="font-size:22px" onclick="removeRoom(this)" room_id="{{$room->id}}"></i>
                          </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>

              @if(Session::has('date_booking') && Session::get('date_booking') != null)
                @foreach (session('date_booking') as $date)
                 
                    <div class="input-group input-group-merge">
                      <input
                        type="hidden"
                        id="checkin_date-{{$date['room_id']}}"
                        class="form-control"
                        aria-describedby="basic-default-checkin_date"
                        name="checkin_date"
                        value="{{$date['checkin_date']}}"
                       
                        />
                    </div>
      
                    <div class="input-group input-group-merge">
                      <input
                        type="hidden"
                        id="checkout_date-{{$date['room_id']}}"
                        class="form-control"
                        aria-describedby="basic-default-checkout_date"
                        name="checkout_date"
                        value="{{$date['checkout_date']}}"
                       
                        />
                    </div>
                  @endforeach
                @endif

              @if (Auth::check())
                <div class="cus-infor">
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-first_name">Họ và tên lót</label>
                    <div class="col-sm-8">
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="basic-default-first_name"
                          class="form-control"
                          aria-describedby="basic-default-first_name"
                          name="first_name"
                            value="{{Auth::user()->first_name}}"
                          />
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-last_name">Tên</label>
                    <div class="col-sm-8">
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="basic-default-last_name"
                          class="form-control"
                          aria-describedby="basic-default-last_name"
                          name="last_name"
                            value="{{Auth::user()->last_name}}"
                          />
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-phone_number">Số điện thoại</label>
                    <div class="col-sm-8">
                      <div class="input-group input-group-merge">
                        <input
                          type="number"
                          id="basic-default-phone_number"
                          class="form-control"
                          aria-describedby="basic-default-phone_number"
                          name="phone_number"
                            value="{{Auth::user()->phone_number}}"
                          />
                      </div>
                    </div>   
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-email">Email</label>
                    <div class="col-sm-8">
                      <div class="input-group input-group-merge">
                        <input
                          type="email"
                          id="basic-default-email"
                          class="form-control"
                          aria-describedby="basic-default-email2"
                          name="email"
                          
                          value="{{Auth::user()->email}}"
                        />
                      
                      </div>
                    </div>
                    @if($errors->has('email'))
                      <div class="error">
                          {{ $errors->first('email') }}
                      </div>
                    @endif
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-createdit_card">Thẻ tín dụng</label>
                    <div class="col-sm-8">
                      <input
                        type="text"
                        id="basic-default-createdit_card"
                        class="form-control"
                        name="createdit_card"
                        value="{{Auth::user()->credit_card}}"
                        />
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-citizen_identification">CCCD/CMND</label>
                    <div class="col-sm-8">
                      <input
                        type="text"
                        id="basic-default-citizen_identification"
                        class="form-control"
                        name="citizen_identification"
                        value="{{Auth::user()->citizen_identification	}}"
                        />
                    </div>
  
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-address">Địa chỉ</label>
                    <div class="col-sm-8">
                      <input
                        type="text"
                        id="basic-default-address"
                        class="form-control"
                        name="address"
                        value="{{Auth::user()->address}}"
                        />
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-order_request">Thêm yêu cầu khác</label>
                  <div class="col-sm-8">
                    <textarea
                      type="text"
                      id="basic-default-order_request"
                      class="form-control"
                      name="order_request"
                      cols="6" rows="3"
                    ></textarea>
                  </div>
              </div>
              @else
                <div class="cus-infor">
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-first_name">Họ và tên lót</label>
                    <div class="col-sm-8">
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="basic-default-first_name"
                          class="form-control"
                          aria-describedby="basic-default-first_name"
                          name="first_name"/>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-last_name">Tên</label>
                    <div class="col-sm-8">
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="basic-default-last_name"
                          class="form-control"
                          aria-describedby="basic-default-last_name"
                          name="last_name"/>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-phone_number">Số điện thoại</label>
                    <div class="col-sm-8">
                      <div class="input-group input-group-merge">
                        <input
                          type="number"
                          id="basic-default-phone_number"
                          class="form-control"
                          aria-describedby="basic-default-phone_number"
                          name="phone_number"/>
                      </div>
                    </div>   
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-email">Email</label>
                    <div class="col-sm-8">
                      <div class="input-group input-group-merge">
                        <input
                          type="email"
                          id="basic-default-email"
                          class="form-control"
                          aria-describedby="basic-default-email2"
                          name="email"
                          value="{{old('email')}}"
                        />
                      </div>
                    </div>
                    @if($errors->has('email'))
                      <div class="error">
                          {{ $errors->first('email') }}
                      </div>
                    @endif
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-createdit_card">Thẻ tín dụng</label>
                    <div class="col-sm-8">
                      <input
                        type="text"
                        id="basic-default-createdit_card"
                        class="form-control"
                        name="createdit_card"
                      />
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-citizen_identification">CCCD/CMND</label>
                    <div class="col-sm-8">
                      <input
                        type="text"
                        id="basic-default-citizen_identification"
                        class="form-control"
                        name="citizen_identification"
                      />
                    </div>

                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-address">Địa chỉ</label>
                    <div class="col-sm-8">
                      <input
                        type="text"
                        id="basic-default-address"
                        class="form-control"
                        name="address"
                      />
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-people_quantity">Số lượng người tất cả</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="basic-default-people_quantity" name="peopleQuantity" value="{{old('peopleQuantity')}}" required/>
                  </div>
                </div>  

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-order_request">Thêm yêu cầu khác</label>
                  <div class="col-sm-8">
                    <textarea
                      type="text"
                      id="basic-default-order_request"
                      class="form-control"
                      name="order_request"
                      cols="6" rows="3"
                    ></textarea>
                  </div>
              </div>
              @endif
              <div class="row mb-3 h4">
                <label class="col-sm-7 col-form-label">Tổng tiền đặt phòng</label>
                <div class="col-sm-5 col-form-label" id="booking_total_price">
                  {{-- @if(Session::get('booking_total_price') != null)
                    {{Session::get('booking_total_price')}}
                  @endif --}}
                </div>              
              </div>
              <br>
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Thêm đặt phòng</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
     
      <div class="col-md-6" id="detail-booking"> </div>
    </div>
  </div>

  
@endsection

@section('footer')
  @include('layouts.fe.footer')

  <script>

    $('#searchUser').on('keyup',function() {
        var value = $(this).val(); 
        if(value == ""){
          $('#user').html("");
          $('#result').hide();
        }else {
          $.ajax({
              url:"{{ route('bookings.searchCustomer') }}",
              type:"GET",
              data:{'search': value},
              success:function (data) {
                  $('#user').empty().html(data);
                  $('#result').show();
              }
          })
        }
    });

    function clickResultSearch(cus){
          var cusName = $(cus).attr('cusName');
          var cusID = $(cus).attr('cusID');
          $('#cusID').val(cusID);
          $('#searchUser').val(cusName);
          $('#user').html("");
          $('#result').hide();
    }

    $('body').on('click', 'li', function(){
        var value = $(this).text();
        
    });


    
    function createDetailBooking(room){
      // $("#booking-form").css("width", "50%");
      var room_id = $(room).attr("room_id");
      var checkin_date = $("#checkin_date-"+room_id).val()?$("#checkin_date-"+room_id).val():"";
      var checkout_date = $("#checkout_date-"+room_id).val()?$("#checkout_date-"+room_id).val():"";
      var room = $(room).val();      // room name
 
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({
        url: '{{route('cus.bookings.createDetail')}}',
        method: 'POST',
        data: {
          checkin_date : checkin_date,
          checkout_date : checkout_date,
          room : room
        },
        success: function (data) {
          $('#detail-booking').html(data);
        }
      });

    }

    function chooseDate(a){
      var room = $(a).attr('room_id');


      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({
        url: '{{route('cus.bookings.checkDate')}}',
        method: 'POST',
        data: {
          room : room
        },
        success: function (data) { 
          if(data != ""){
            for(let i = 0; i < data[0].length; i++) {
              var checkinDate = new Date(data[0][i]);
              var checkoutDate = new Date(data[1][i]);

              var $input = $(a).pickadate();
              var picker = $input.pickadate('picker')
              picker.set('min', true);
              
              picker.set('disable', [
                  { from: [checkinDate.getFullYear(),checkinDate.getMonth(),checkinDate.getDate()], to: [checkoutDate.getFullYear(),checkoutDate.getMonth(),checkoutDate.getDate()] },
              ]);
            }
          }else {
              var $input = $(a).pickadate();
              var picker = $input.pickadate('picker')
              picker.set('min', true);
          }
        }
      });

        
    
        // $(a).pickadate({
          
        //   disable: [
        //       // { from: date, to: [2023,6,27] },  { from: date, to: [2023,6,27] },
      
        //   ]
        // })
    }


    $("#btnAddNewCus").click(function () {
      $(".cus-infor").html(`
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-first_name">Họ và tên lót</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <input
                        type="text"
                        id="basic-default-first_name"
                        class="form-control"
                        aria-describedby="basic-default-first_name"
                        name="first_name"/>
                    </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-last_name">Tên</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <input
                        type="text"
                        id="basic-default-last_name"
                        class="form-control"
                        aria-describedby="basic-default-last_name"
                        name="last_name"/>
                    </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone_number">Số điện thoại</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <input
                        type="number"
                        id="basic-default-phone_number"
                        class="form-control"
                        aria-describedby="basic-default-phone_number"
                        name="phone_number"/>
                    </div>
                  </div>
                
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <input
                        type="email"
                        id="basic-default-email"
                        class="form-control"
                        aria-describedby="basic-default-email2"
                        name="email"
                        value="{{old('email')}}"
                      />
                  
                    </div>
                  </div>
                  @if($errors->has('email'))
                    <div class="error">
                        {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-createdit_card">Thẻ tín dụng</label>
                  <div class="col-sm-10">
                    <input
                      type="text"
                      id="basic-default-createdit_card"
                      class="form-control"
                      name="createdit_card"
                    />
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-citizen_identification">CCCD/CMND</label>
                  <div class="col-sm-10">
                    <input
                      type="text"
                      id="basic-default-citizen_identification"
                      class="form-control"
                      name="citizen_identification"
                    />
                  </div>

                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-address">Địa chỉ</label>
                  <div class="col-sm-10">
                    <input
                      type="text"
                      id="basic-default-address"
                      class="form-control"
                      name="address"
                    />
                  </div>`)
    })

      
    function addDetailBooking(booking){
      var checkin_date = $("#checkin_detail_date").val();
      var checkout_date = $("#checkout_detail_date").val();
      var roomName = $(".room").val();
      var peopleList = $("#people_list").val();
      var room_total_price = $("#room_total_price").attr("room_total_price");


      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({
        url: '{{route('users.room_detail_bookings')}}',
        method: 'POST',
        data: {
          checkin_date: checkin_date, 
          checkout_date: checkout_date,
          room : roomName,
          peopleList : peopleList,
          room_total_price: room_total_price
        },
        success: function (data) {
          if(data == "/login"){
            window.location = data;
          }else{
            $("#booking_total_price").html(`${data} VND`);
          }
        }
      });

      $('#detail-booking').html("");
      $("#room-"+roomName).attr("disabled", true);   //khi f5 van hien ra
    
    }

    function removeRoom(room){
      var room_id = $(room).attr('room_id');
      
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({
        url: '{{route('users.rooms.removeBookingtoCart')}}',
        method: 'POST',
        data: {
          room_id : room_id,
        },
        success: function (data) {
          $('#room_list').html(data);
        }
      });
    }

    function changeDate(date){
      var checkin_detail_date = $("#checkin_detail_date").val();
      var checkout_detail_date = $("#checkout_detail_date").val();
      var room_id = $(date).attr('room_id');

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({
        url: '{{route('users.bookings.roomTotalPrice')}}',
        method: 'POST',
        data: {
          checkin_detail_date : checkin_detail_date,
          checkout_detail_date : checkout_detail_date,
          room_id : room_id,
        },
        success: function (data) {
          if(data != ""){
            $('#room_total_price').html(`${data} VND`);
          }
        }
      });

    }
  </script>
@endsection



