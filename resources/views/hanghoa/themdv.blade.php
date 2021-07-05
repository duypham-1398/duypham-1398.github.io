@extends('layout_ad')
@section('content')
<form role="form"  action="{{URL::to('/luudv')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row" style="margin-top:35px">
    <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
            <h3 >
                <a href="{{URL::to('xemdv')}}"><i class="fa fa-product-hunt" style="color:black;">Danh mục sản phẩm</i></a>
                /<i class="fa fa-product-hunt" style="color:white;">Thêm mới</i>
            </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{URL::to('xemdv')}}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
                <div class="position-center">
                        <div class="form-group">
                        <label for="exampleInputEmail1">ID</label>
                        <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="Nếu không nhập hệ thống sẽ tự sinh">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đơn vị tính</label>
                            <input type="text" name="tendv" class="form-control" id="exampleInputEmail1" placeholder="Đơn vị tính">
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection