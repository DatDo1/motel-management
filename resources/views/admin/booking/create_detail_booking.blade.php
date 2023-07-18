
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Thêm mới chi tiết đặt phòng</h5>
          </div>
          <div class="card-body">
            {{-- <form action="{{route('room_bookings.store')}}" method="post">
              @csrf     --}}
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="basic-default-room_quantity">Phòng</label>
                <div class="col-sm-7">
                    @if(isset($data['room']))
                        <div class="col-md-6">
                            <input class="w-100 room" type="button" value="{{$data['room']}}">
                            {{-- <input type="hidden" name="roomIDs[]" value="{{$room->id}}"/> --}}
                        </div>
                    @endif
  
                </div>
              </div>

              <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="checkin_detail_date">Ngày đến</label>
                    <div class="col-sm-7">
                      <div class="input-group input-group-merge">
                        <input
                          type="date"
                          id="checkin_detail_date"
                          class="form-control"
                          aria-describedby="checkin_detail_date"
                          name="checkin_date"
                          value="{{$data['checkin_date']}}"
                          id="checkin_date"
                          required
                          />
                      </div>
                    </div>              
              </div>

              <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="checkout_detail_date">Ngày đi</label>
                <div class="col-sm-7">
                  <div class="input-group input-group-merge">
                    <input
                      type="date"
                      id="checkout_detail_date"
                      class="form-control"
                      aria-describedby="checkout_detail_date"
                      name="checkout_date"
                      value="{{$data['checkout_date']}}"
                      id="checkout_date"
                      required
                      />
                  </div>
                </div>              
          </div>

              <div class="row mb-3">
                <label class="col-sm-7 col-form-label" for="people_list">Danh sách người ở</label>
                <div class="col-sm-20">
                  <textarea
                      type="text"
                      id="people_list"
                      class="form-control"
                      name="order_request"
                      cols="6" rows="5"
                    ></textarea>
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




