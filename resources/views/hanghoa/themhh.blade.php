@extends('layout_ad')
@section('content')
<?php
$message = Session::get('message');
if($message){
    echo '<span class="text-alert">'.$message.'</span>';
    Session::put('message',null);
}
?>
<form role="form"  action="{{URL::to('/luuhh')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row" style="margin-top:35px">
    <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
            <h3 >
                <a href="{{URL::to('xemhh')}}" style="color:black;"><i class="fa fa-product-hunt">Sản phẩm</i></a>
                /Thêm mới
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
                                <input type="text" name="id" value="" class="form-control" placeholder="Nếu không nhập, hệ thống sẽ tự sinh">
                            </div>
                            <div class="col-md-4 " style="margin-top: 15px;">
                                <label>Mã hàng hóa</label>
                                <input type="text" name="mahh" class="form-control " placeholder="" required>
                            </div>
                            <div class="col-md-4 " style="margin-top: 15px;">
                                <label>Tên hàng hóa</label>
                                <input type="text" name="tenhh" class="form-control " placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-4">
                                    <label>Danh mục hàng hóa</label>
                                    <select name="iddmhh" class="form-control input-sm m-bot15">
                                        @foreach($danhmuc as $dm)
                                            <option value="{{$dm->id}}">{{$dm->TenDM}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Đơn vị tính</label>
                                    <select name="idncc" class="form-control input-sm m-bot15">
                                        @foreach($donvi as $tt)
                                            <option value="{{$tt->id}}">{{$tt->TenDV}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Slug hàng hóa</label>
                                    <input type="text" name="slughh" value="" class="form-control text-right txtMoney" placeholder="Nhập slug" required>
                                </div>
                            <div class="form-group clearfix">
                                <div class="col-md-4">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="trangthaihh" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>  
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputFile">Hình ảnh</label>
                                    <input type="file" name="HinhHH" class="form-control" id="exampleInputEmail1">
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-lg-12">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" rows="3" name="mota" placeholder="Mô tả..."></textarea>
                                    <script type="text/javascript">CKEDITOR.replace('mota'); </script>

                                </div>
                            </div>
                </div>
            </div>
            </div>
        </div>   
    </div>
</div>
@endsection