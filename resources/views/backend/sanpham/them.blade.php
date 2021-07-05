@extends('backend.layout')
@section('content')
<form action="{!! route('admin.sanpham.getAdd') !!}" method="POST"  enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
<div class="row">
<div class="col-lg-12 ">
<div class="panel panel-green">
    <div class="panel-heading" style="height:60px;">
      <h3 >
        <a href="{!! URL::route('admin.sanpham.list') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Sản phẩm</i></a>
        /Thêm mới
      </h3>
    <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{!! URL::route('admin.sanpham.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
    </div>
    </div>
    <div class="panel-body">
        <div class="col-lg-7">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Ký hiệu</label>
                    <input class="form-control" name="txtSPSignt" value="{!! old('txtSPSignt') !!}" placeholder="Ký hiệu..." />
                    <div>
                        {!! $errors->first('txtSPSignt') !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Tên</label>
                    <input class="form-control" name="txtSPName" value="{!! old('txtSPName') !!}" placeholder="Nhập tên sản phẩm..." />
                    <div>
                        {!! $errors->first('txtSPName') !!}
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" rows="3" name="txtSPIntro" placeholder="Mô tả..."> {!! old('txtSPIntro') !!}</textarea>
                    <script type="text/javascript">CKEDITOR.replace('txtSPIntro'); </script>
                    <div>
                        {!! $errors->first('txtSPIntro') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
           <div class="col-lg-12">
                <div class="form-group">
                    <label>Loại sản phẩm</label>
                    <div >
                        <select name="txtSPCate" id="input" class="form-control">
                            <option >--Chọn loại sản phẩm--</option>
                            <?php Select_Function($cate); ?>
                        </select>
                    </div>
                    <div>
                        {!! $errors->first('txtSPCate') !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Đơn vị tính</label>
                    <div >
                        <select name="txtSPUnit" id="input" class="form-control">
                            <option >--Chọn đơn vị tính--</option>
                            <?php Select_Function($unit); ?>
                        </select>
                    </div>
                    <div>
                        {!! $errors->first('txtSPUnit') !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Giá bán</label>
                    <input class="form-control" name="txtSPSalePrice" value="{!! old('txtSPSalePrice') !!}" placeholder="Nhập giá bán sản phẩm" />
                    <div>
                        {!! $errors->first('txtSPSalePrice') !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Hình ảnh </label>
                    <input type="file" name="txtSPImage" value="{!! old('txtSPImage') !!}" >
                    <div>
                        {!! $errors->first('txtSPImage') !!}
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