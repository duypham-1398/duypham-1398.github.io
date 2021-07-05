@extends('backend.layout')
@section('content')
    <form action="{{URL::to('/luunhom')}}" method="POST"  enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
              <h3 >
                <a href="{{URL::to('xemnhom')}}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Nhóm sản phẩm</i></a>
                /Thêm mới
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{URL::to('xemnhom')}}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
        <div class="col-lg-7">
        <div class="col-lg-12">
            <div class="form-group">
                <label>ID</label>
                <input class="form-control" name="id" value="" placeholder="Nếu không nhập hệ thống sẽ tự sinh" />
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Tên</label>
                <input class="form-control" name="txtNName" value="" placeholder="Tên..." />
                <div>
                    {!! $errors->first('txtNName') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" rows="3" name="txtNIntro" placeholder="Mô tả..." ></textarea>
                <script type="text/javascript">CKEDITOR.replace('txtNIntro'); </script>
            </div>
        </div>
    </form>
@stop