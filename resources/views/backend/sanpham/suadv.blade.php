@extends('backend.layout')
@section('content')   
@foreach($donvi as $key => $sua)
<form role="form" action="{{URL::to('/capnhatdv/'.$sua->id)}}" method="post">
  {{ csrf_field() }}
  {{method_field('PATCH')}}
  <div class="row" style="margin-top:35px">
    <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
            <h3 >
                <a href="{{URL::to('xemdv')}}" style="color:black;"><i class="fa fa-product-hunt">Đơn vị tính</i></a>
                /<i class="fa fa-product-hunt" style="color:white;">Cập nhật</i>
            </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{URL::to('xemdv')}}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
              <div class="position-center">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Tên danh mục</label>
                      <input type="text" value="{{$sua->donvitinh_ten}}" name="tendv" class="form-control" id="exampleInputEmail1" >
                  </div>
                </form>
            </div>
            @endforeach
        </div>
    </section>
  </div>
</div>
@endsection