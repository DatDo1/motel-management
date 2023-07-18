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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loại phòng/</span> Thêm mới loại phòng</h4>
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Thêm loại phòng</h5>
          </div>
          <div class="card-body">
            <form action="{{route('room_types.store')}}" method="post">
              @csrf
              <div class="row mb-3 ">
                <label class="col-sm-2 col-form-label " for="basic-default-room_type_name">Tên loại phòng</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-room_type_name" name="roomTypeName" value="{{old('roomTypeName')}}"/>
                </div>
                @if($errors->has('roomTypeName'))
                  <div class="error">
                      {{ $errors->first('roomTypeName') }}
                  </div>
                @endif
              </div>
              <div class="row mb-3 ">
                <label class="col-sm-2 col-form-label " for="basic-default-description">Mô tả</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="basic-default-description" rows="6" name="description" value="{{old('description')}}"></textarea>
                </div>
                @if($errors->has('description'))
                  <div class="error">
                      {{ $errors->first('description') }}
                  </div>
                @endif
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Thêm loại phòng</button>
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
@endsection

