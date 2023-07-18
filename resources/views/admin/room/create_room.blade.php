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
    <hr>

    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Thêm phòng</h5>
          </div>
          <div class="card-body">
            <form action="{{route('rooms.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3 ">
                <label class="col-sm-2 col-form-label " for="basic-default-room_name">Tên phòng</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-room_name" name="roomName" value="{{old('roomName')}}"/>
                </div>
                @if($errors->has('roomName'))
                  <div class="error">
                      {{ $errors->first('roomName') }}
                  </div>
                @endif
              </div>

              <div class="row mb-3 ">
                <label class="col-sm-2 col-form-label " for="basic-default-floor">Tầng</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-floor" name="floor" value="{{old('floor')}}"/>
                </div>
                @if($errors->has('floor'))
                  <div class="error">
                      {{ $errors->first('floor') }}
                  </div>
                @endif
              </div>
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-room_status">Tình trạng phòng</label>
                <div class="col-sm-10">
                  <select name="room_status" id="basic-default-room_status" class="form-select">
                    <option value="0">Đang trống</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-image">Hình ảnh</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input
                      type="file"
                      id="basic-default-image"
                      class="form-control"
                      aria-describedby="basic-default-image2"
                      name="image[]"
                      value="{{old('image')}}"
                      multiple="multiple"
                    />
                  </div>
                </div>
                @if($errors->has('image'))
                  <div class="error">
                      {{ $errors->first('image') }}
                  </div>
                @endif
              </div>
              <div class="row mb-3">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                  <div id="myImg"></div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-referencePrice">Giá tham khảo (đêm)</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    id="basic-default-referencePrice"
                    class="form-control"
                    name="referencePrice"
                  />
                </div>
                @if($errors->has('referencePrice'))
                  <div class="error">
                      {{ $errors->first('referencePrice') }}
                  </div>
                @endif
              </div>
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-area">Diện tích (m<sup>2</sup>) </label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    id="basic-default-area"
                    class="form-control"
                    name="area"
                  />
                </div>
                @if($errors->has('area'))
                  <div class="error">
                      {{ $errors->first('area') }}
                  </div>
                @endif
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-adult_quantity">Số lượng người lớn</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    id="basic-default-adult_quantity"
                    class="form-control"
                    name="adultQuantity"
                  />
                </div>
                @if($errors->has('adultQuantity'))
                  <div class="error">
                      {{ $errors->first('adultQuantity') }}
                  </div>
                @endif
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-children_quantity">Số lượng trẻ em</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    id="basic-default-children_quantity"
                    class="form-control"
                    name="childrenQuantity"
                  />
                </div>
                @if($errors->has('childrenQuantity'))
                  <div class="error">
                      {{ $errors->first('childrenQuantity') }}
                  </div>
                @endif
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-room_type">Loại phòng</label>
                <div class="col-sm-10">
                  <select name="room_type" id="basic-default-room_type" class="form-select">
                    @foreach ($roomTypeList as $roomType)
                      <option value="{{$roomType->id}}">{{$roomType->name}}</option>       
                    @endforeach
                  </select>
                </div>
              </div>
              
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Thêm phòng</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>

@endsection

@section('footer')
  @include('layouts.be.footer')
  <script>
    $(function() {
      $(":file").change(function() {
        var imgRoom = $('.imgRoom');
        if(imgRoom.length > 0){
          $('.imgRoom').remove();
        }
        if (this.files && this.files[0]) {
          for (var i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[i]);
          }
        }
      });
    });

    function imageIsLoaded(e) {
      // $('#myImg').insertAdjacentHTML('beforeend', '<img class="imgRoom" height="200" width="200" src=' + e.target.result + '>')
      $('#myImg').append('<img class="imgRoom" style="margin: 0 10px 10px 0;" height="200" width="200" src=' + e.target.result + '>');
    };  
  </script>
@endsection

