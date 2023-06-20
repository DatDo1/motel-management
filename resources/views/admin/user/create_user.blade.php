@extends('layouts.be.master')

@section('header')
  @include('layouts.be.header')
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../../admin/assets/css/custom.css">
@endsection

@section('content')
  @include('layouts.be.menu')
  @include('layouts.be.search-infor')

  <div class="row create-form">
    <hr>

    <form action="{{route('users.store')}}" method="post">
      @csrf
      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="fisrt_name">Họ và Tên đệm</label>
          <input type="text" class="form-control" id="fisrt_name" name="fisrt_name">
        </div>
        @if ($errors->has('fisrt_name'))
          <span class="text-danger text-left">{{ $errors->first('first_name') }}</span>
        @endif
        {{-- <div class="col-md-3 mb-3">
          <label for="last_name">Tên</label>
          <input type="text" class="form-control" id="last_name"  required>
        </div>
        <div class="col-md-4 mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email"  required>
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div> --}}
      </div>
      {{-- <div class="row">
        <div class="col-md-4 mb-3">
          <label for="password">Mật khẩu</label>
          <input type="password" class="form-control" id="password" required>
          <div class="invalid-feedback">
            Please enter a password.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="confirmPassword">Xác nhận lại mật khẩu</label>
          <input type="password" class="form-control" id="confirmPassword"  required>
          <div class="invalid-feedback">
            Please enter the same password as above.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="role">Vị trí</label>
          <input list="roles" name="role" id="role" class="form-control">
          <datalist id="roles">
            <option value="Admin">
            <option value="Manager">
            <option value="Employee">
          </datalist>
        </div> --}}
      {{-- </div> --}}
      <button class="btn btn-primary" type="submit">Tạo tài khoản</button>
    </form>
  </div>
  
@endsection

@section('footer')
  @include('layouts.be.footer')
@endsection

