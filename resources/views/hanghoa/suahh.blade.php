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
@foreach($hanghoa as $key => $hh)
<form role="form"  action="{{URL::to('/capnhathh/'.$hh->id)}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
<div class="row" style="margin-top:35px">
    <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
            <h3 >
                <a href="{{URL::to('xemhh')}}" style="color:black;"><i class="fa fa-product-hunt">Sản phẩm</i></a>
                /Cập nhật
            </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{URL::to('xemhh')}}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                        <div class="form-group clearfix">
                            <div class="col-md-4" style="margin-top: 15px;">
                                <label>ID</label>
                                <input type="text" name="id" value="{{$hh->id}}" class="form-control">
                            </div>
                            <div class="col-md-4 " style="margin-top: 15px;">
                                <label>Mã hàng hóa</label>
                                <input type="text" name="mahh"  value="{{$hh->MaHH}}"class="form-control " >
                            </div>
                            <div class="col-md-4 " style="margin-top: 15px;">
                                <label>Tên hàng hóa</label>
                                <input type="text" name="tenhh" value="{{$hh->TenHH}}" class="form-control " placeholder="Nếu không nhập, hệ thống sẽ tự sinh.">
                            </div>
                            
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-4">
                                    <label>Danh mục hàng hóa</label>
                                    <select name="iddmhh" class="form-control input-sm m-bot15">
                            
                                        @foreach($danhmuc as $key =>$dm)
                                    
                                            @if($dm->id==$hh->id_DMHH)
                                                <option value="{{$dm->id}}">{{$dm->TenDM}}</option>
                                            @else
                                                <option value="{{$dm->id}}">{{$dm->TenDM}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-4">
                                    <label>Slug hàng hóa</label>
                                    <input type="text" name="slughh" value="{{$hh->SlugHH}}" class="form-control text-right txtMoney" placeholder="Nhập slug">
                                </div>
                                <div class="col-md-4">
                                    <label>Đơn vị tính</label>
                                    <select name="idncc" class="form-control input-sm m-bot15">
                                        @foreach($donvi as $key =>$tt)
                                            @if($dm->id==$hh->id_DMHH)
                                                <option value="{{$tt->id}}">{{$tt->TenDV}}</option>
                                            @else
                                                <option value="{{$tt->id}}">{{$tt->TenDV}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                           
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-lg-7">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" rows="3" name="mota">{{$hh->MoTa}}</textarea>
                                    <script type="text/javascript">CKEDITOR.replace('mota'); </script>

                                </div>
                              
                                <div class="col-md-3">
                                    <label for="exampleInputFile">Hình ảnh</label>
                                    <input type="file" name="HinhHH" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$hh->HinhHH)}}" height="100" width="100">
                                </div>
                                <div class="col-md-2">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="trangthaihh" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection   
                         