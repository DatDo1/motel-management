 
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label" for="basic-default-first_name">Họ và tên lót</label>
      <div class="col-sm-10">
        <div class="input-group input-group-merge">
          <input
            type="text"
            id="basic-default-first_name"
            class="form-control"
            aria-describedby="basic-default-first_name"
            name="first_name"
            value="{{$cus->user->first_name}}"
            />
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
            name="last_name"
            value="{{$cus->user->last_name}}"
            />
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label" for="basic-default-phone_number">Phone Number</label>
      <div class="col-sm-10">
        <div class="input-group input-group-merge">
          <input
            type="phone_number"
            id="basic-default-phone_number"
            class="form-control"
            aria-describedby="basic-default-phone_number"
            name="phone_number"
            value="{{$cus->user->phone_number}}"
            />
        </div>
      </div>
      @if($errors->has('phone_number'))
        <div class="error">
            {{ $errors->first('phone_number') }}
        </div>
      @endif
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
            value="{{$cus->user->email}}"
            disabled
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
      <label class="col-sm-2 col-form-label" for="basic-default-credit_card">Thẻ tín dụng</label>
      <div class="col-sm-10">
        <input
          type="text"
          id="basic-default-credit_card"
          class="form-control"
          name="credit_card"
          value="{{$cus->credit_card}}"
        />
      </div>
      @if($errors->has('credit_card'))
        <div class="error">
            {{ $errors->first('credit_card') }}
        </div>
      @endif
    </div>
    
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label" for="basic-default-citizen_identification">CCCD/CMND</label>
      <div class="col-sm-10">
        <input
          type="text"
          id="basic-default-citizen_identification"
          class="form-control"
          name="citizen_identification"
          value="{{$cus->user->citizen_identification}}"
        />
      </div>
      @if($errors->has('citizen_identification'))
        <div class="error">
            {{ $errors->first('citizen_identification') }}
        </div>
      @endif
    </div>
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label" for="basic-default-address">Địa chỉ</label>
      <div class="col-sm-10">
        <input
          type="text"
          id="basic-default-address"
          class="form-control"
          name="address"
          value="{{$cus->user->address}}"
        />
      </div>
      @if($errors->has('address'))
        <div class="error">
            {{ $errors->first('address') }}
        </div>
      @endif
    </div>
    
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label" for="basic-default-order_request">Thêm yêu cầu khác</label>
      <div class="col-sm-10">
        <textarea
          type="text"
          id="basic-default-order_request"
          class="form-control"
          name="order_request"
          cols="6" rows="5"
        ></textarea>
      </div>
  </div>

 
