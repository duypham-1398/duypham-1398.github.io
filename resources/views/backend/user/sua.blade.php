@extends('backend.layout')
@section('content')
@include('sweet::alert')
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="row">
<div class="col-lg-12 ">
<div class="panel panel-green">
    <div class="panel-heading" style="height:60px;">
      <h3 >
        <a href="{!! URL::route('admin.user.list') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Người dùng</i></a>
        /Đổi mật khẩu
      </h3>
    <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{!! URL::route('admin.user.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
    </div>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Mật khẩu cũ</label>
                <input class="form-control" type="password" name="txtOldPass" placeholder="Nhập mật khẩu cũ" />
                <div>
                    {!! $errors->first('txtOldPass') !!}
                </div>  
                
            </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input class="form-control" type="password" name="txtPass" placeholder="Mật khẩu..." />
                <div>
                    {!! $errors->first('txtPass') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nhập lại mật khẩu mới</label>
                <input class="form-control" type="password" name="txtRePass" placeholder="Nhập lại mật khẩu..." />
                <div>
                    {!! $errors->first('txtRePass') !!}
                </div>  
                
            </div>
        </div>
    </form>
@stop