
@extends('layouts.fe.master')

@section('title')
    Hotel Shaga
@endsection
@section('header')
  @include('layouts.fe.header')
@endsection

@section('content')
    @include('layouts.fe.menu')
    <section class="hero spad set-bg" data-setbg="../../../client/img/hero.jpg">
        @include('layouts.fe.search') 
    </section>
    <section class="home-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="home__about__text">
                        <div class="section-title hero__text">
                            <h3>Khách sạn Shaga</h3>  
                        </div>
                        <p class="first-para">Là một khách sạn chuẩn 2 sao, tọa lạc tại thành phố biển Vũng Tàu, chúng tôi mong muốn mang đến cho du khách những trải nghiệm tốt nhất.</p>
                        <p class="last-para">Với không gian phòng thoải mái và yên tĩnh, cách bãi sau chưa đầy 500m, du khách có thể thuận tiện và dễ dàng hơn trong việc du lịch biển. </p>
                        <img src="img/home-about/sign.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="home__about__pic">
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="our_room">
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
            @foreach ($roomList as $room)
                <div class="col-md-4 col-sm-6">
                    <div id="serv_hover"  class="room">
                        <div class="room_img">
                            <?php
                                $a = unserialize($room->image);
                                $b = array_values($a)[0];
                            ?>
                            @if(isset($b))
                                <figure><a href="{{route('cus.rooms.roomDetail', ['room' => $room->uuid])}}"><img src="{{url('admin/assets/img/rooms/'.$b)}}"/></a></figure>
                            @endif
                        </div>
                        <div class="bed_room">
                            <h3>Loại phòng {{$room->room_type->name}}</h3>
                            <p>Phù hợp với {{$room->adult_quantity}} nguời lớn, {{$room->children_quantity}} trẻ em</p>
                            <p>Giá phòng {{$room->reference_price}} VND/đêm</p>
                        </div>
                    </div>
                </div> 
            @endforeach
             
           </div>
        </div>
     </div>
@endsection

@section('footer')
  @include('layouts.fe.footer')
  <script>
    // function findmyall(btn){
    //   var btnType = $(btn).attr('buttonType');
    //   var checkinDate = $('#checkin_date').val();
    //   var checkoutDate = $('#checkout_date').val();

    //   $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //   });

    //   $.ajax({
    //     url: '{{route('cus.rooms.findAllRoomByDate')}}',
    //     method: 'POST',
    //     data: {
    //       checkinDate: checkinDate,
    //       checkoutDate: checkoutDate,
    //       btnType: btnType
    //     },

    //     success: function (data) {
    //           $('table tbody').html(data);
    //     }
    //   });
    // }

    // $(document).ready(function () {
    //   $('#checkin_date').max = new Date().toLocaleDateString('fr-ca')

    //   $("#checkAll").click(function () {
    //     $(".check").prop('checked', $(this).prop('checked'));
    //   });

    //   $('.check').click(function () {
    //     if(!$(this).is(':checked')){
    //       $(this).attr("value", "");
    //     }
    //   })
    // })

  </script>
@endsection

  
   
