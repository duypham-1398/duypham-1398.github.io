@extends('backend.layout')
@section('content')
    <form action="{!! route('admin.nhanvien.getAdd') !!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="row">
<div class="col-lg-12 ">
<div class="panel panel-green">
    <div class="panel-heading" style="height:60px;">
      <h3 >
        <a href="{!! URL::route('admin.nhanvien.list') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Nhân viên</i></a>
        /Thêm mới
      </h3>
    <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{!! URL::route('admin.nhanvien.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
    </div>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Tên</label>
                <input class="form-control" name="txtNVName" value="{!! old('txtNVName') !!}" placeholder="Tên..." />
                <div>
                    {!! $errors->first('txtNVName') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Số CMND</label>
                <input class="form-control" name="txtNVID" value="{!! old('txtNVID') !!}" placeholder="Số cmnd..." />
                <div>
                    {!! $errors->first('txtNVID') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Số điện thoại</label>
                <input class="form-control" name="txtNVPhone" value="{!! old('txtNVPhone') !!}" placeholder="Số điện thoại..." />
                <div>
                    {!! $errors->first('txtNVPhone') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Ngày vào làm</label>
                <input class="form-control" type="date" name="txtNVDate" value="{!! old('txtNVDate') !!}"/>
                <div>
                    {!! $errors->first('txtNVDate') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea class="form-control" rows="3" name="txtNVAddress" placeholder="Địa chỉ...">{!! old('txtNVAddress') !!}</textarea>
                <div>
                        {!! $errors->first('txtNVAddress') !!}
                    </div> 
            </div>
        </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tài khoản</label>
                    <input class="form-control" name="txtUsername" value="{!! old('txtUsername') !!}" placeholder="Tài khoản..." />
                    <div>
                        {!! $errors->first('txtUsername') !!}
                    </div>  
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="txtEmail" value="{!! old('txtEmail') !!}" placeholder="abc@gmail.com,..." />
                    <div>
                        {!! $errors->first('txtEmail') !!}
                    </div>  
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input class="form-control" type="password" name="txtPass" placeholder="Mật khẩu..." />
                    <div>
                        {!! $errors->first('txtPass') !!}
                    </div>  
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input class="form-control" type="password" name="txtRePass" placeholder="Nhập lại mật khẩu..." />
                    <div>
                        {!! $errors->first('txtRePass') !!}
                    </div>  
                    
                </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
                <label for="input" >Loại người dùng</label>
                <div>
                    <select id="input" name="txtRole"  class="form-control">
                            <option value="">--Chọn loại người dùng--</option>
                            <?php Select_Function($loainguoidung); ?>
                    </select>
                </div>
                <div>
                    {!! $errors->first('txtRole') !!}
                </div> 
            </div>
            </div>
        </div>
    </form>
@stop