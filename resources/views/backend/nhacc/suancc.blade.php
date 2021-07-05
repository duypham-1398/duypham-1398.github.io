@extends('backend.layout')
@section('content')
@foreach($nhacc as $key => $ncc)
<div class="position-center">
  <form role="form" action="{{URL::to('/capnhatncc/'.$ncc->id)}}" method="post">
  {{ csrf_field() }}
  {{method_field('PATCH')}}
  <div class="row" style="margin-top:35px">
    <div class="col-lg-12 ">
      <div class="panel panel-green">
        <div class="panel-heading" style="height:60px;">
        <h3 >
            <a href="{{URL::to('xemncc')}}" style="color:black;"><i class="fa fa-product-hunt">Nhà cung cấp</i></a>
            /<i class="fa fa-product-hunt" style="color:white;">Cập nhật</i>
        </h3>
        <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{URL::to('xemncc')}}" ><i class="btn btn-default" >Hủy</i></a>
        </div>
        </div>
        <div class="panel-body">
          <div class="position-center">
                <div class="form-group">
                  <label for="exampleInputEmail1">ID</label>
                  <input type="text" value="{{$ncc->id}}" name="id" class="form-control" id="exampleInputEmail1" >
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                  <input type="text" value="{{$ncc->nhacungcap_ten}}" name="tenncc" class="form-control" id="exampleInputEmail1" >
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Địa chỉ</label>
                  <input type="text" value="{{$ncc->nhacungcap_dia_chi}}" name="diachincc" class="form-control" id="exampleInputEmail1" >
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Số điện thoại</label>
                  <input type="text" value="{{$ncc->nhacungcap_sdt}}" name="sdtncc" class="form-control" id="exampleInputEmail1" >
              </div>
              
            </form>
        </div>
       
      </div>
    </section>
  </div>
</div>
@endforeach
@endsection