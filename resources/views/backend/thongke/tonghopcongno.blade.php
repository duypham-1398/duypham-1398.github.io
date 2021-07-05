@extends('backend.layout')
@section('content')  
    <div class="row">
      <div class="col-sm-12">
          <section class="panel" >
          <div style="margin-left:10px;margin-top:25px;font-size:16px;color:blue">
            <b ><span >Công ty cổ phần xây dựng KSD</span></b><br>
            Thành phố Hải Dương<br>
            Số điện thoại: 0123456789<br>
            Website: http://localhost/congtycophanxaydungKSD/
          </div><hr>
          <center><a href="{!! URL::route('admin.thongke.congno') !!}"><h2 style="color:blue"><b>BẢNG TỔNG HỢP CÔNG NỢ PHẢI THU KHÁCH HÀNG</b></h2></a></center><hr>
            <div class="panel-body">
                <div class="adv-table">
                <table >
                  <thead>
                    <tr class="text-center">
                      <td style="border:thin solid;" width="10px" rowspan="2"><strong>STT</strong></td>
                      <td style="border:thin solid;" width="70px" rowspan="2"><strong>Mã số</strong></td>
                      <td style="border:thin solid;" width="200px" rowspan="2"><strong>Tên khách hàng</strong></td>
                      <td style="border:thin solid;" width="300px" colspan="2"><strong>Số dư đầu kỳ</strong>
                      </td>
                      <td style="border:thin solid;" width="300px" colspan="2"><strong>Số phát sinh trong kỳ</strong></td>
                      <td style="border:thin solid;" width="300px" colspan="2"><strong>Số dư cuối kỳ</strong></td>
                    </tr>
                    <tr class="text-center">
                      <td style="border:thin solid;" width="150px">Nợ</td>
                      <td style="border:thin solid;" width="150px">Có</td>
                      <td style="border:thin solid;"width="150px">Nợ</td>
                      <td style="border:thin solid;"width="150px">Có</td>
                      <td style="border:thin solid;"width="150px">Nợ</td>
                      <td style="border:thin solid;"width="150px">Có</td>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php $count = 0; ?>
                        @foreach ($khachhang as $val)
                        <tr >
                          <td style="border:thin blue solid;border-style:dashed;">{!! $count = $count + 1 !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;">KH-0{!! $val->id !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;">{!! $val->khachhang_ten !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($val->khachhang_tonno_dk) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($val->khachhang_tonco_dk) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($val->khachhang_phat_sinh_no) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($val->khachhang_phat_sinh_co) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($val->khachhang_tonno_ck) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($val->khachhang_tonco_ck) !!}</td>
                      </tr>
                        @endforeach
                     
                        @foreach ($khachmua as $k)
                        <tr >
                          <td style="border:thin blue solid;border-style:dashed;">{!! $count = $count + 1 !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;">KM-0{!! $k->id !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;">{!! $k->khachmua_ten !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($k->khachmua_tonno_dk) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($k->khachmua_tonco_dk) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($k->khachmua_phat_sinh_no) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($k->khachmua_phat_sinh_co) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($k->khachmua_tonno_ck) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($k->khachmua_tonco_ck) !!}</td>
                      </tr>
                        @endforeach
                  </tbody>
                      <tr>
                        <td style="border:thin solid;"></td>
                        <td style="border:thin solid;"></td>
                        <?php
                        $km = DB::table('khachmua')->select(DB::raw('SUM(khachmua_tonno_dk) as tndk'),DB::raw('SUM(khachmua_tonco_dk) as tcdk'),DB::raw('SUM(khachmua_phat_sinh_no) as psn'),DB::raw('SUM(khachmua_phat_sinh_co) as psc'),DB::raw('SUM(khachmua_tonno_ck) as tnck'),DB::raw('SUM(khachmua_tonco_ck) as tcck'))->get();
                        $kh = DB::table('khachhang')->select(DB::raw('SUM(khachhang_tonno_dk) as tndk'),DB::raw('SUM(khachhang_tonco_dk) as tcdk'),DB::raw('SUM(khachhang_phat_sinh_no) as psn'),DB::raw('SUM(khachhang_phat_sinh_co) as psc'),DB::raw('SUM(khachhang_tonno_ck) as tnck'),DB::raw('SUM(khachhang_tonco_ck) as tcck'))->get();
                        $tongnodk = $km->sum('tndk') + $kh->sum('tndk');
                        $tongcodk = $km->sum('tcdk') + $kh->sum('tcdk');
                        $tongpsno = $km->sum('psn') + $kh->sum('psn');
                        $tongpsco= $km->sum('psc') + $kh->sum('tnpscdk');
                        $tongnock = $km->sum('tnck') + $kh->sum('tnck');
                        $tongcock = $km->sum('tcck') + $kh->sum('tcck');
                        ?>
                        <td style="border:thin solid;">Cộng: </td>
                        <td style="border:thin solid;" class="text-right">{!! number_format($tongnodk)  !!}</td>
                        <td style="border:thin solid;" class="text-right">{!! number_format($tongcodk)  !!}</td>
                        <td style="border:thin solid;" class="text-right">{!! number_format($tongpsno)  !!}</td>
                        <td style="border:thin solid;" class="text-right">{!! number_format($tongpsco)  !!}</td>
                        <td style="border:thin solid;" class="text-right">{!! number_format($tongnock)  !!}</td>
                        <td style="border:thin solid;" class="text-right">{!! number_format($tongcock)  !!}</td>
                      </tr>
                </table>
                </div>
            </div>
          </section>
@endsection