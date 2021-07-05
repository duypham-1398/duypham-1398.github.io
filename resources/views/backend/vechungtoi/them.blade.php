@extends('backend.layout')
@section('content')  
    <form action="{!! route('admin.vechungtoi.getAdd') !!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
              <h3 >
                <a href="{!! URL::route('admin.vechungtoi.list') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Tin tức</i></a>
                /Thêm mới
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{!! URL::route('admin.vechungtoi.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input class="form-control" name="txtVCTTD" value="{!! old('txtVCTTD') !!}" placeholder="Nhập tiêu đề..." />
                    <div>
                        {!! $errors->first('txtVCTTD') !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea class="form-control" rows="3" name="txtVCTND" placeholder="Nội dung..."> {!! old('txtVCTND') !!}</textarea>
                    <script type="text/javascript">CKEDITOR.replace('txtVCTND'); </script>
                    <div>
                        {!! $errors->first('txtVCTND') !!}
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