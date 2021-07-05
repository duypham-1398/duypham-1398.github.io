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
                <a href="{{URL::to('xemdm')}}"><i class="fa fa-product-hunt" style="color:black;">Danh mục sản phẩm</i></a>
                /<i class="fa fa-product-hunt" style="color:white;">Thêm mới</i>
            </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{URL::to('xemdm')}}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('luudm')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <label for="exampleInputEmail1">ID</label>
                        <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="tendm" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục</label>
                            <input type="text" name="slugdm" class="form-control" id="exampleInputEmail1" placeholder="Slug danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="trangthaidm" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                    
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea class="form-control" rows="3" name="mota" placeholder="Mô tả..."></textarea>
                                    <script type="text/javascript">CKEDITOR.replace('mota'); </script>
                        </div> 
                                    
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection