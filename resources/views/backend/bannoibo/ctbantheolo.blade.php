@extends('backend.layout')
@section('content')   
     <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;margin-bottom:10px">
              <h3 >
                <div style="margin-bottom:10px">Chi tiết đơn bán số {{$donban->id}}</div>
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <!-- <a type="text" style="color:white"class="btn btn-primary"  href="{!! URL::route('admin.donban.list') !!}"> Lưu</a> -->
                <a href="{!! URL::route('admin.donban.list') !!}" ><i class="btn btn-default" >Quay lại</i></a>

            </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="panel panel-default" >
                    <div class="panel-heading" style="background:#a9d86e;">
                        <h2 class="panel-title" style="color:black;"><b>Chi tiết đơn bán</b></h2>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12" >
                            <div class="table-responsive">
                                <table class="table table-hovered" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>ID</th>
                                            <th>Sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 0; ?>
                                        @foreach ($chitietdonban as $val)
                                            <tr>
                                                <td>{!! $count = $count + 1 !!}</td>
                                                <td>{!! $val->id !!}</td>
                                                <td>
                                                    <?php  
                                                        $sp = DB::table('sanpham')->where('id',$val->sanpham_id)->first();
                                                        $lh = $sp->id;
                                                        $splohang = DB::table('lohang')->where('sanpham_id',$lh)->first();
                                                        $lohang = DB::table('lohang')->where('sanpham_id',$lh)->get();
                                                    ?>
                                                    <a href="{!! URL::route('admin.sanphamlo.list', [$sp->id] ) !!}">
                                                    {{$sp->sanpham_ten}}
                                                </a>
                                                </td>
                                            
                                                <td>
                                                {!! number_format($val->chitietdonban_thanh_tien/$val->chitietdonban_so_luong,0,",",".") !!} vnđ 
                                                </td>
                                                <td>{!! $val->chitietdonban_so_luong !!}</td>
                                                <td>{!! number_format("$val->chitietdonban_thanh_tien",0,",",".") !!} vnđ </td>
                                                </td>
                                            
                                            </tr>
                                            
                                        @endforeach
                                        <tr>
                                        <td colspan="5">
                                        <b>Tổng tiền : {!! number_format("$donban->donban_tong_tien",0,",",".") !!} vnđ </b>
                                            
                                        </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading" style="background:#a9d86e;">
        <h2 class="panel-title" style="color:black"><b>Chi tiết bán theo lô</b></h2>
          </div>
          <div class="panel-body">
          <div class="table-responsive">
              <table class="table table-hover">

                  <tbody>
                          <table class="table table-hovered" >
                        <thead>
                            <tr>
                                <th>Lô hàng</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($chitietlo as $ctlo)
                        <?php 
                        $lh = DB::table('lohang')->where('id',$ctlo->lohang_id)->first();
                        ?>
                                <tr>
                                    <td>{{$lh->lohang_ky_hieu}}</td>
                                    <td> {{$ctlo->ctbantheolo_so_luong}} </td>
                                    <td>{{number_format($ctlo->ctbantheolo_thanh_tien)}}</td>
                                </tr>
                        @endforeach
                              
                        </tbody>
                    </table>
                      </tr>
                  </tbody>
              </table>
          </div>
          </div>
        </div> 
    </div>

</section>
</section>

<!-- end customer -->
@stop