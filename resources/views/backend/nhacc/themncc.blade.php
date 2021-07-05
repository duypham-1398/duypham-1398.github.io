@extends('backend.layout')
@section('content')  
<form role="form" action="{{URL::to('luuncc')}}" method="post">
    {{ csrf_field() }}
<div class="row" style="margin-top:35px">
    <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
            <h3 >
                <a href="{{URL::to('xemncc')}}"><i class="fa fa-product-hunt" style="color:black;">Danh sách nhà cung cấp</i></a>
                /<i class="fa fa-product-hunt" style="color:white;">Thêm mới</i>
            </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" name="themncc" class="btn btn-primary">Lưu</button>
                
                <a href="{{URL::to('xemncc')}}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
                <div class="position-center">
                        <div class="form-group">
                        <label for="exampleInputEmail1">ID</label>
                        <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="Điền id nếu không hệ thống sẽ tự tăng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                            <input type="text" name="tenncc" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp">
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" name="diachincc" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ nhà cung cấp">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="sdtncc" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại nhà cung cấp">
                        </div>               
                       
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection