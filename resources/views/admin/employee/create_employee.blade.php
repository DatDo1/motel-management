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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Nhân viên/</span> Thêm mới nhân viên</h4>
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Thêm tài khoản nhân viên</h5>
          </div>
          <div class="card-body">
            <form action="{{route('employees.store')}}" method="post">
              @csrf
              <div class="row mb-3 ">
                <label class="col-sm-2 col-form-label " for="basic-default-fisrt_name">Họ và tên đệm</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-first_name" name="firstName" value="{{old('firstName')}}"/>
                </div>
                @if($errors->has('firstName'))
                  <div class="error">
                      {{ $errors->first('firstName') }}
                  </div>
                @endif
              </div>

              <div class="row mb-3 ">
                <label class="col-sm-2 col-form-label " for="basic-default-last_name">Tên</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-last_name" name="lastName" value="{{old('lastName')}}"/>
                </div>
                @if($errors->has('lastName'))
                  <div class="error">
                      {{ $errors->first('lastName') }}
                  </div>
                @endif
              </div>
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone_number" >Số điện thoại</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="basic-default-phone_number"
                    name="phoneNumber"
                    value="{{old('phoneNumber')}}"
                  />
                </div>
                @if($errors->has('phoneNumber'))
                  <div class="error">
                      {{ $errors->first('phoneNumber') }}
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
                <label class="col-sm-2 col-form-label" for="basic-default-password">Mật khẩu</label>
                <div class="col-sm-10">
                  <input
                    type="password"
                    id="basic-default-password"
                    class="form-control"
                    name="password"
                  />
                </div>
                @if($errors->has('password'))
                  <div class="error">
                      {{ $errors->first('password') }}
                  </div>
                @endif
              </div>
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-confirm_password">Xác nhận mật khẩu</label>
                <div class="col-sm-10">
                  <input
                    type="password"
                    id="basic-default-confirm_password"
                    class="form-control"
                    name="confirmPassword"
                  />
                </div>
                @if($errors->has('confirmPassword'))
                  <div class="error">
                      {{ $errors->first('confirmPassword') }}
                  </div>
                @endif
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-role">Vị trí</label>
                <div class="col-sm-10">
                  <select name="role" id="basic-default-role" class="form-select">
                    <option value="1">Admin</option>
                    <option value="2">Employee</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-basic_salary">Lương cơ bản</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    id="basic-default-basic_salary"
                    class="form-control"
                    name="basicSalary"
                    value="{{old('basicSalary')}}"
                  />
                </div>
                @if($errors->has('basicSalary'))
                  <div class="error">
                      {{ $errors->first('basicSalary') }}
                  </div>
                @endif
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-start_date">Ngày vào làm</label>
                <div class="col-sm-10">
                  <input
                    type="date"
                    id="basic-default-start_date"
                    class="form-control"
                    name="startDate"
                    value="{{old('startDate')}}"
                  />
                </div>
                @if($errors->has('startDate'))
                  <div class="error">
                      {{ $errors->first('startDate') }}
                  </div>
                @endif
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
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

