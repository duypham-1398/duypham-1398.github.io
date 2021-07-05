@extends('backend.layout')
@section('content')  
<form action="" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
    <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
              <h3 >
                <a href="{!! URL::route('admin.donban.list') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:blue;">Quản lý đơn hàng</i></a>
                /Chi tiết đơn hàng số {{$donban->id}}
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{!! URL::route('admin.donban.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Thông tin khách hàng</h3>
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
        <div class="col-lg-10">
            <div class="form-group">
                <label for="input" >Tỷ lệ thanh thanh toán</label>
                <input type="text" name="tylett"  value="{{$donban->donban_thanh_toan}}" class="form-control" placeholder="VD:50, 60, ... 100" >
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
                          <td>{!! $donban->donban_nguoi_nhan !!}</td>
                      </tr>
                      <tr>
                          <td><b>Số điện thoại</b></td>
                          <td>{!! $donban->donban_nguoi_nhan_sdt !!}</td>
                      </tr>
                      <tr>
                          <td><b>Email</b></td>
                          <td>{!! $donban->donban_nguoi_nhan_email !!}</td>
                      </tr>
                      <tr>
                          <td><b>Địa chỉ</b></td>
                          <td>{!! $donban->donban_nguoi_nhan_dia_chi !!}</td>
                      </tr>
                      <tr>
                          <td><b>Ghi chú</b></td>
                          <td>
                          @if (!asset($donban->donban_ghi_chu))
                            {{ $donban->donban_ghi_chu }}
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
    <div class="row">
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
    </div>
    </div>
    </div>
    </div>
    </form>
@stop