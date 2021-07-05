@extends('layout')
@section('content')
@include('sweet::alert') 
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Home</a></li>
                <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
                <li><a href="{!! url('quen-mat-khau') !!}">Quên mật khẩu</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
</section>
<div class="Lost-pass ptb-100 ptb-sm-60">
    <div class="container">
        <div class="col-lg-6 center">
            <div class="register-title" >
                <h3 class="mb-10 custom-title" >Đặt lại mật khẩu</h3>
            </div>
            <form action="{{ URL::to('newPass') }}" method="post">
            {{ csrf_field() }}
                <input type="text" name="token" value="{{ $info }}" hidden="">
                Mật khẩu mới: <input type="password" name="password" class="form-control" style="margin-bottom:10px">
                Xác nhận mật khẩu: <input type="password" name="confirm" class="form-control" style="margin-bottom:20px">
                <input type="submit" class="btn btn-danger btn-block" >
		    </form>
        </div>
    </div>
    <!-- Container End -->
</div>
@endsection