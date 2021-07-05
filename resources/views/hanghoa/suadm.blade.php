@extends('layout_ad')
@section('content')
<style type="text/css" media="screen">
    .icon_del{
        position: relative;
        top: -200px;
        left: 150px;
    }
</style>
<?php
$message = Session::get('message');
if($message){
    echo '<span class="text-alert">'.$message.'</span>';
    Session::put('message',null);
}
?>
@foreach($danhmuc as $key => $sua)
<form role="form" action="{{URL::to('/capnhatdm/'.$sua->id)}}" method="post">
  {{ csrf_field() }}
  {{method_field('PATCH')}}
  <div class="row" style="margin-top:35px">
    <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
            <h3 >
                <a href="{{URL::to('xemdm')}}" style="color:black;"><i class="fa fa-product-hunt">Danh mục hàng hóa</i></a>
                /<i class="fa fa-product-hunt" style="color:white;">Cập nhật</i>
            </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{URL::to('xemdm')}}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
              <div class="position-center">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Tên danh mục</label>
                      <input type="text" value="{{$sua->TenDM}}" name="tendm" class="form-control" id="exampleInputEmail1" >
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Slug danh mục</label>
                      <input type="text" value="{{$sua->SlugDM}}" name="slugdm" class="form-control" id="exampleInputEmail1" >
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Mô tả danh mục</label>
                      <textarea class="form-control" rows="3" name="mota">{{$sua->MoTa}}</textarea>
                      <script type="text/javascript">CKEDITOR.replace('mota'); </script>
                  </div> 
                  <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="trangthaidm" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                    
                            </select>
                        </div>
                </form>
            </div>
            @endforeach
        </div>
    </section>
  </div>
</div>
@endsection