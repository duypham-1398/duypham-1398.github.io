@extends('backend.layout')
@section('content')                
<div class="panel panel-default" style=" background:#d0f5a1">
<div class="panel-heading"style=" background:#d0f5a1">
<h3 class="page-header ">
        Lịch sử mua hàng của khách hàng: <b><i>{{$khachmua->khachmua_ten}}</i></b>
        
    </h3>
</div>               
<div class="panel panel-default">
<div class="panel-heading"style=" background:#a9d86e">
    <b><i>Danh sách đơn bán</i></b> | 
    <a href="{!! URL::route('admin.khachmua.list') !!}" class="btn btn-default">Quay lại</a>
</div>
<!-- .panel-heading -->
<div class="panel-body">
    <div class="panel-group" id="accordion">
        @foreach ($donban as $item)
        <?php 
             
            switch ($item->tinhtranghd_id) {
                case '1':
                    $color = "red";
                    break;
                case '2':
                    $color = "primary";
                    break;
                case '3':
                    $color = "yellow";
                    break;
                case '4':
                    $color = "green";
                    break;
                default:
                    $color = "btn-default";
                    break;
            }
        ?>
        <div class="panel panel-{{$color}}">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <?php
                    $tt = DB::table('tinhtranghd')->where('id', $item->tinhtranghd_id)->first();  
                    ?>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" ><p style="color:white;"><b>Đơn bán số {{ $item->id }} | <i>Tình trạng:</i> {{$tt->tinhtranghd_ten}}</b></p></a>

                </h4>
            </div>
            <div id="collapse{{$item->id}}" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">
                    <div class="col-lg-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Thông tin khách mua hàng nội bộ</h3>
                      </div>
                      <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-hover">
                              <tbody>
                                  <tr>
                                      <td><b>Tên khách hàng</b></td>
                                      <td>{!! $khachmua->khachmua_ten !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Số điện thoại</b></td>
                                      <td>{!! $khachmua->khachmua_sdt !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Email</b></td>
                                      <td>{!! $khachmua->khachmua_email !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Địa chỉ</b></td>
                                      <td>{!! $khachmua->khachmua_dia_chi !!}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>    
                    </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Thông tin giao hàng</h3>
                      </div>
                      <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-hover">

                              <tbody>
                                  <tr>
                                      <td><b>Người nhận hàng</b></td>
                                      <td>{!! $item->donban_nguoi_nhan !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Số điện thoại</b></td>
                                      <td>{!! $item->donban_nguoi_nhan_sdt !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Email</b></td>
                                      <td>{!! $item->donban_nguoi_nhan_email !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Địa chỉ</b></td>
                                      <td>{!! $item->donban_nguoi_nhan_dia_chi !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Ghi chú</b></td>
                                      <td>
                                      @if (!asset($item->donban_ghi_chu))
                                        {{ $item->donban_ghi_chu }}
                                      @else
                                        Không có ghi chú
                                      @endif
                                        
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      </div>
                    </div> 
                    </div>
                    </div>
                    <?php 
                        $chitiet = DB::table('chitietdonban')->where('donban_id',$item->id)->get();
                    ?>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="panel panel-default" >
                          <div class="panel-heading">
                            <h2 class="panel-title" ><b>Danh sách sản phẩm</b></h2>
                          </div>
                          <div class="panel-body">
                            <div class="col-lg-12" >
                                <div class="table-responsive">
                                    <table class="table table-hovered" >
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Sản phẩm</th>
                                                <th>Đơn giá</th>
                                                <th>Số lượng</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 0; ?>
                                            @foreach ($chitiet as $val)
                                                <tr>
                                                    <td>{!! $count = $count + 1 !!}</td>
                                                    <td>
                                                        <?php  
                                                            $sp = DB::table('sanpham')->where('id',$val->sanpham_id)->first();
                                                            print_r($sp->sanpham_ten);
                                                        ?>
                                                    </td>
                                                    <td>
                                                    {!! number_format($val->chitietdonban_thanh_tien/$val->chitietdonban_so_luong,0,",",".") !!} vnđ 
                                                    </td>
                                                    <td>{!! $val->chitietdonban_so_luong !!}</td>
                                                    <td>{!! number_format("$val->chitietdonban_thanh_tien",0,",",".") !!} vnđ </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                            <td colspan="5">
                                            <b>Tổng tiền : {!! number_format("$item->donban_tong_tien",0,",",".") !!} vnđ </b>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- .panel-body -->
</div>

@stop