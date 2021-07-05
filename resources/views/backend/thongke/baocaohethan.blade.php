@extends('backend.layout')
@section('content')  
<!-- /.row -->
<div class="row">
<div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right">
                    @if($tonglo < 10)
                        @if($tonglo > 0)
                        <div class="huge">0{{$tonglo}}</div>
                        @else
                        <div class="huge">0</div>
                        @endif
                    @else
                        <div class="huge">{{$tonglo}}</div>
                    @endif
                        <div>Tổng lô hàng hết hạn</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right">
                    @if($tong->slht > 0)
                        <div class="huge">{{$tong->slht}}</div>
                    @else
                        <div class="huge">0</div>
                    @endif
                        <div>Tổng sản phẩm hết hạn</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <div class="huge">{{number_format($tong->tonthat)}}</div>
                        <div>Tổng giá trị tổn thất</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<!-- /.row -->
    <section class="wrapper" style="margin-top:-20px">
      <!-- page start-->
<div class="row">
      <div class="col-sm-12">
          <section class="panel" >
          <center><a href="{!! URL::route('admin.thongke.congno') !!}"><h2 style="color:red"><b>BÁO CÁO LÔ HÀNG HẾT HẠN</b></h2></a></center><hr>
            <div class="panel-body">
                <div class="adv-table">
                <table >
                  <thead>
                    <tr class="text-center">
                      <td style="border:thin blue solid;" width="10px" ><strong>STT</strong></td>
                      <td style="border:thin blue solid;" width="110px"><strong>Mã lô hàng</strong></td>
                      <td style="border:thin blue solid;" width="200px"><strong>Ngày hết hạn</strong></td>
                      <td style="border:thin blue solid;" width="300px" ><strong>Tên sản phẩm</strong>
                      </td>
                      <td style="border:thin blue solid;" width="150px" ><strong>Giá nhập</strong></td>
                      <td style="border:thin blue solid;" width="90px" ><strong>Số lượng </strong></td>
                      <td style="border:thin blue solid;" width="150px" ><strong>Tổn thất</strong></td>
                    </tr>
                    
                  </thead>
                  <tbody>
                  <?php $count = 0;   ?>
                    @foreach($data as $item)
                    <?php 
                            $ngaybd =  date("Y-m-d", strtotime("$item->lohang_ngay_nhap")); // Năm/Tháng/Ngày
                            $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $item->lohang_han_su_dung  day"));
                            $sanpham = DB::table('sanpham')->where('id',$item->sanpham_id)->first();
                    ?>
                        <tr >
                          <td style="border:thin blue solid;" class="text-center">{!! $count = $count + 1 !!}</td>
                          <td style="border:thin blue solid;">{{$item->lohang_ky_hieu}}</td>
                          <td style="border:thin blue solid;" class="text-right">{{date('d-m-Y',strtotime($ngaybd))}}</td>
                          <td style="border:thin blue solid;" class="text-right">{{$sanpham->sanpham_ten}}</td>
                          <td style="border:thin blue solid;color:red" class="text-right">{{ number_format($item->lohang_gia_mua_vao) }}</td>
                          <td style="border:thin blue solid;color:red" class="text-center">{{$item->lohang_so_luong_hien_tai}}</td>
                          <td style="border:thin blue solid;color:red" class="text-right">{{number_format($item->lohang_so_luong_hien_tai*$item->lohang_gia_mua_vao)}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                  <tr >
                          <td style="border:thin blue solid;color:red"><strong></strong></td>
                          <td style="border:thin blue solid;color:red"><strong>Tổng cộng:</strong></td>
                          <td style="border:thin blue solid;color:red"><strong></strong></td>
                          <td style="border:thin blue solid;color:red" class="text-center"><strong></strong></td>
                          <td style="border:thin blue solid;color:red" class="text-center"><strong></strong></td>
                          @if($tong->slht > 0)
                          <td style="border:thin blue solid;color:red" class="text-center"><strong>{{$tong->slht}}</strong></td>
                          @else
                          <td style="border:thin blue solid;color:red" class="text-center"><strong>0</strong></td>
                          @endif
                          <td style="border:thin blue solid;color:red" class="text-right"><strong>{{number_format($tong->tonthat)}}</strong></td>
                      </tr>
                </table>
                </div>
            </div>
          </section>
<!-- END DATA TABLE-->
@stop
