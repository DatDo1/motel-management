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
            <h5 class="mb-0">Thêm thiết bị</h5>
          </div>
          <div class="card-body">
            <form action="{{route('facilities.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3 ">
                <label class="col-sm-2 col-form-label " for="basic-default-facility_name">Tên thiết bị</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-facility_name" name="facilityName" value="{{old('facilityName')}}"/>
                </div>
                @if($errors->has('facilityName'))
                  <div class="error">
                      {{ $errors->first('facilityName') }}
                  </div>
                @endif
              </div>

              <div class="row mb-3 ">
                <label class="col-sm-2 col-form-label " for="basic-default-price">Giá tiền</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-price" name="price" value="{{old('price')}}"/>
                </div>
                @if($errors->has('price'))
                  <div class="error">
                      {{ $errors->first('price') }}
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
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-facility_type">Loại thiết bị</label>
                <div class="col-sm-10">
                  <select name="facility_type" id="basic-default-facility_type" class="form-select">
                    @foreach ($facilityTypes as $facilityType)
                    <option value="{{$facilityType->id}}">{{$facilityType->name}}</option>       
                    @endforeach
                  </select>
                </div>
              </div>
              
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Thêm thiết bị</button>
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

