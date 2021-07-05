@extends('backend.layout')
@section('content')
    <form action="" method="POST"  enctype="multipart/form-data" name="frmEditPro">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
    <div class="row">
<div class="col-lg-12 ">
<div class="panel panel-green">
    <div class="panel-heading" style="height:60px;">
      <h3 >
        <a href="{!! URL::route('admin.sanpham.list') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Sản phẩm</i></a>
        /Cập nhật
      </h3>
    <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{!! URL::route('admin.sanpham.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
    </div>
    </div>
    <div class="panel-body">
        <div class="col-lg-7">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Ký hiệu</label>
                <input class="form-control" name="txtSPSignt" value="{!! $sanpham->sanpham_ky_hieu !!}" />
                <div>
                    {!! $errors->first('txtSPSignt') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Tên</label>
                <input class="form-control" name="txtSPName" placeholder="Nhập tên sản phẩm..." value="{!! $sanpham->sanpham_ten !!}"  />
                <div>
                    {!! $errors->first('txtSPName') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Giá bán</label>
                <input class="form-control" name="txtSPSalePrice" placeholder="Nhập giá bán sản phẩm..." value="{!! $sanpham->sanpham_gia_ban !!}"  />
                <div>
                    {!! $errors->first('txtSPSalePrice') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Loại sản phẩm</label>
                <div >
                    <select name="txtSPCate" id="input" class="form-control">
                        <option value="">--Chọn loại sản phẩm--</option>
                        <?php Select_Function($cate,$sanpham->loaisanpham_id); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Đơn vị tính</label>
                <div >
                    <select name="txtSPUnit" id="input" class="form-control">
                        <option value="">--Chọn đơn vị tính--</option>
                        <?php Select_Function($unit,$sanpham->donvitinh_id); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" rows="3" name="txtSPIntro" placeholder="Mô tả...">{!! $sanpham->sanpham_mo_ta !!}</textarea>
                <script type="text/javascript">CKEDITOR.replace('txtSPIntro'); </script>
                <div>
                    {!! $errors->first('txtSPIntro') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Hình ảnh </label>
                <br>
                <img src="{!! asset('resources/upload/sanpham/'.$sanpham->sanpham_anh) !!}" class="img-responsive img-rounded" alt="Image" style="width: 150px; height: 200px;">
                <input type="hidden" name="fImageCurrent" value="{!! $sanpham->sanpham_anh !!}">

                <br>
                <input type="file" name="fImage" >
            </div>
        </div>
       </div>
        </div>
    </div>
</div>   
</div>
</form>
@stop