@extends('layouts.be.master')

@section('header')
  @include('layouts.be.header')
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../../admin/assets/css/custom.css">
@endsection

@section('content')
  @include('layouts.be.menu')
  @include('layouts.be.search-infor')
  @include('sweetalert::alert')

  <div class="row create-form">

    <div class="row" id="booking-form">
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Thêm mới đặt phòng</h5>
          </div>
          <div class="card-body">
            <form action="{{route('bookings.store')}}" method="post">
              @csrf     
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-room_quantity">Phòng</label>
                <div class="col-sm-10">
                    @if(isset($room))
                        <div class="col-md-2">
                            <input class="w-100" type="button" value="{{$room->name}}" id="{{$room->name}}" onclick="createBooking(this)">
                            <input type="hidden" name="roomIDs[]" value="{{$room->id}}"/>
                        </div>
                    @elseif(isset($rooms))
                        <div class="row">
                            @foreach ($rooms as $room)
                                <div class="col-md-2">
                                    <input type="button" class="w-100" value="{{$room->name}}" id="room-{{$room->name}}" onclick="createBooking(this)">
                                    <input type="hidden" name="roomIDs[]" value="{{$room->id}}"/>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
              </div>

              {{-- <div class="row mb-3">
                    <div class="col-sm-10"> --}}
                      <div class="input-group input-group-merge">
                        <input
                          type="hidden"
                          id="checkin_date"
                          class="form-control"
                          aria-describedby="basic-default-checkin_date"
                          name="checkin_date"
                          value="{{$checkin_date}}"
                          />
                      </div>
                    {{-- </div>              
              </div> --}}

              {{-- <div class="row mb-3">
                <div class="col-sm-10"> --}}
                  <div class="input-group input-group-merge">
                    <input
                      type="hidden"
                      id="checkout_date"
                      class="form-control"
                      aria-describedby="basic-default-checkout_date"
                      name="checkout_date"
                      value="{{$checkout_date}}"
                      />
                  </div>
                {{-- </div>              
              </div> --}}

              <div class="row create-new-cus">
                <label class="col-sm-2 col-form-label" for="basic-default">Khách hàng</label>
                <div class="col-sm-6">
                      <input type="text" class="form-control" name="search" id="searchUser" required>
                      <input type="hidden" class="form-control" name="cusID" id="cusID">
                </div>
                <div class="col-sm-2">
                  <input type="button" value="Thêm mới" id="btnAddNewCus">
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default"></label>
                <div class="col-sm-6">
                  <div id="result" style="display:none">
                      <ul class="list-group" id="user">
                      </ul>
                  </div>
                </div>
              </div>

                <div class="cus-infor">
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-order_request">Thêm yêu cầu khác</label>
                  <div class="col-sm-10">
                    <textarea
                      type="text"
                      id="basic-default-order_request"
                      class="form-control"
                      name="order_request"
                      cols="6" rows="3"
                    ></textarea>
                  </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Thêm đặt phòng</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="detail-booking">
    </div>
  </div>

  
@endsection

@section('footer')
  @include('layouts.be.footer')

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
          
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });

          $.ajax({
            url: '{{route('bookings.clickCustomer')}}',
            method: 'POST',
            data: {
              cusID: cusID
            },
            success: function (data) {
              $('.cus-infor').html(data);
        
            }
          });

          $('#cusID').val(cusID);
          $('#searchUser').val(cusName);
          $('#user').html("");
          $('#result').hide();
    }

    $('body').on('click', 'li', function(){
        var value = $(this).text();
        
    });


    function createBooking(room){
      $("#booking-form").css("width", "60%");

      var checkin_date = $("#checkin_date").val()?$("#checkin_date").val():"";
      var checkout_date = $("#checkout_date").val()?$("#checkout_date").val():"";
      var room = $(room).val();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({
        url: '{{route('bookings.createDetailBooking')}}',
        method: 'POST',
        data: {
          checkin_date: checkin_date,
          checkout_date: checkout_date,
          room : room
        },
        success: function (data) {
          $('#detail-booking').css("width", "40%");
          $('#detail-booking').html(data);
        }
      });

    }

    $("#btnAddNewCus").click(function () {
      $(".create-new-cus").html(`

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
                  <label class="col-sm-2 col-form-label" for="basic-default-email">Email người nhận</label>
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
                      <span class="input-group-text" id="basic-default-email2">@gmail.com</span>
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
                  </div>
                </div>`)
    })

      
    function addDetailBooking(booking){
      var checkin_date = $("#checkin_detail_date").val();
      var checkout_date = $("#checkout_detail_date").val();
      var roomName = $(".room").val();
      var peopleList = $("#people_list").val();
      var total_price = $("#total_price").val();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({
        url: '{{route('bookings.storeDetailBooking')}}',
        method: 'POST',
        data: {
          checkin_date: checkin_date,
          checkout_date: checkout_date,
          room : roomName,
          peopleList : peopleList,
          total_price: total_price,
        },
        success: function (data) {
          // $('#detail-booking').html(data);
        }
      });

      $('#detail-booking').html("");
      $("#room-"+roomName).attr("disabled", true);
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
    }
    
   
    
</script>
@endsection



