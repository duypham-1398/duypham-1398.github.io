@extends('backend.layout')
@section('content') 
@foreach($nhom as $key => $nhomm)
    <form action="{{URL::to('/capnhatnhom/'.$nhomm->id)}}" method="POST"  enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}
        <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
              <h3 >
                <a href="{{URL::to('xemnhom')}}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Nhóm thực phẩm</i></a>
                /Sửa
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
                <label>Tên</label>
                <input class="form-control" name="txtNName" value="{!! $nhomm->nhom_ten !!}" placeholder="Tên..." />
                <div>
                    {!! $errors->first('txtNName') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" rows="3" name="txtNIntro" placeholder="Mô tả...">{!! $nhomm->nhom_mo_ta !!}</textarea>
                <script type="text/javascript">CKEDITOR.replace('txtNIntro'); </script>
            </div>
        </div>
    </form>
@endforeach
@stop