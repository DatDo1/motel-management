
<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h2 class="mb-0">Thêm mới chi tiết đặt phòng</h2>
    </div>
    <div class="card-body">
      {{-- <form action="{{route('users.room_detail_bookings')}}" method="post" id="form-detail-booking">
        @csrf     --}}
        <div class="row mb-3">
          <label class="col-sm-4 col-form-label" for="basic-default-room_quantity">Phòng</label>
          <div class="col-sm-2">
              @if(isset($data['room']))
                  <input class="w-100 room" type="button" value="{{$data['room']}}">
              @endif

          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-5 col-form-label" for="basic-default-room_quantity">Một số hình ảnh về phòng</label>
          <div class="p-0 order-lg-2 order-md-2">
              <div class="col-sm-12">
              {{-- <div class="room__pic__slider owl-carousel"> --}}
                <?php
                  $roomImgs = unserialize($room->image);                     
                ?>
                  <div class="row">
                      @foreach ($roomImgs as $roomImg)
                      <div class="col-sm-6">
                          <img class="" src="{{url('admin/assets/img/rooms/'.$roomImg)}}" alt="" style="width: 100%; height: 100%; padding: 8px">
                      </div>
                  
                      @endforeach
                  </div>
              {{-- </div> --}}
            </div>

          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-4 col-form-label" for="basic-default-room_quantity">Loại phòng</label>
          <div class="col-sm-2">
              {{$room->room_type->name}}
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-4 col-form-label" for="basic-default-room_quantity">Giá phòng</label>
          <div class="col-sm-3">
              {{$room->reference_price}}/đêm

          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-4 col-form-label" for="basic-default-room_quantity">Số lượng người lớn</label>
          <div class="col-sm-2">
              {{$room->adult_quantity}}
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-4 col-form-label" for="basic-default-room_quantity">Số lượng trẻ em</label>
          <div class="col-sm-2">
              {{$room->children_quantity}}
          </div>
        </div>

        <div class="row mb-3">
              <label class="col-sm-4 col-form-label" for="checkin_detail_date">Ngày đến</label>
              <div class="col-sm-5">
                <div class="input-group input-group-merge">
                  <input
                    type="date"
                    id="checkin_detail_date"
                    class="form-control"
                    aria-describedby="checkin_detail_date"
                    name="checkin_date"
                    value="{{old('checkin_date')}}"
                    id="checkin_date"
                    required
                    onclick="chooseDate(this)"
                    room_id="{{$room->id}}"
                    />
                </div>
              </div>              
        </div>

        <div class="row mb-3">
          <label class="col-sm-4 col-form-label" for="checkout_detail_date">Ngày đi</label>
          <div class="col-sm-5">
            <div class="input-group input-group-merge">
              <input
                type="date"
                id="checkout_detail_date"
                class="form-control datepicker"
                aria-describedby="checkout_detail_date"
                name="checkout_date"
                value="{{old('checkout_date')}}"
                id="checkout_date"
                required
                onclick="chooseDate(this)"
                room_id="{{$room->id}}"
                />
            </div>
          </div>              
        </div>


        <div class="row mb-3">
          <label class="col-sm-12 col-form-label" for="people_list">Danh sách người ở</label>
          <div class="col-sm-12">
            <textarea
                type="text"
                id="people_list"
                class="form-control"
                name="people_list"
                cols="6" rows="5"
                value="{{old('people_list')}}"
              ></textarea>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-4 col-form-label" for="">Tổng tiền phòng</label>
          <div class="col-sm-5">
            
          </div>              
        </div>

        <div class="row justify-content-end">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" id="btnAddDetailBooking" onclick="addDetailBooking(this)">Thêm chi tiết đặt phòng</button>
          </div>
        </div>

      {{-- </form> --}}
    </div>
  </div>
</div>




