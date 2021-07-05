@extends('backend.layout')
@section('content')
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="row">
<div class="col-lg-12 ">
<div class="panel panel-green">
    <div class="panel-heading" style="height:60px;">
      <h3 >
        <a href="{!! URL::route('admin.nhanvien.list') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Nhân viên</i></a>
        /Cập nhật
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
                <input class="form-control" name="txtNVName" value="{!! $nhanvien->nhanvien_ten !!}" placeholder="Tên..." />
                <div>
                    {!! $errors->first('txtNVName') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Số CMND</label>
                <input class="form-control" name="txtNVID" value="{!! $nhanvien->nhanvien_cmnd !!}" placeholder="Số cmnd..." />
                <div>
                    {!! $errors->first('txtNVID') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Số điện thoại</label>
                <input class="form-control" name="txtNVPhone" value="{!! $nhanvien->nhanvien_sdt !!}" placeholder="Số điện thoại..." />
                <div>
                    {!! $errors->first('txtNVPhone') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Ngày vào làm</label>
                <input class="form-control" type="date" name="txtNVDate" value="{!! $nhanvien->nhanvien_ngay_vao_lam !!}"/>
                <div>
                    {!! $errors->first('txtNVDate') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea class="form-control" rows="3" name="txtNVAddress" placeholder="Địa chỉ...">{!! $nhanvien->nhanvien_dia_chi !!}</textarea>
                <div>
                        {!! $errors->first('txtNVAddress') !!}
                    </div> 
            </div>
        </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>USER ID</label>
                    <input class="form-control" value="{!! $nhanvien->user_id !!}" placeholder="Tài khoản..." disabled="true"/>
                    <div>
                        {!! $errors->first('txtUsername') !!}
                    </div>  
                    
                </div>
            </div>
        </div>
    </form>
@stop