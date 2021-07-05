@extends('backend.layout')
@section('content')  
    <form action="{!! route('admin.slider.getAdd') !!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
              <h3 >
                <a href="{!! URL::route('admin.slider.list') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Quảng cáo</i></a>
                /Thêm mới
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{!! URL::route('admin.slider.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <label>Tên</label>
                <input class="form-control" name="txtSLName" value="{!! old('txtSLName') !!}" placeholder="Tên" />
                <div>
                    {!! $errors->first('txtSLName') !!}
                </div>  
                
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Ảnh</label>
                <input type="file" name="fImage">
                <div>
                    {!! $errors->first('fImage') !!}
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
</form>
@stop