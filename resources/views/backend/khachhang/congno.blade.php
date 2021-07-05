@extends('backend.layout')
@section('content')  

<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                <a href="{!! URL::route('admin.donban.doanhthungay') !!}">
                  <div class="panel-footer">
                      <span class="pull-left">Doanh thu hôm nay</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
               </a>
                    
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                  <a href="{!! URL::route('admin.donban.dtdonbantuan') !!}">
                    <div class="panel-footer">
                        <span class="pull-left">Doanh thu tuần @if(isset($tuan)){{$tuan}}@endif tháng @if(isset($thang)){{$thang}}@endif</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                  </a>  
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                  <a href="{!! URL::route('admin.donban.dtdonbanthang') !!}">
                    <div class="panel-footer">
                        <span class="pull-left">Doanh thu tháng @if(isset($thang)){{$thang}} @endif</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                  </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                  <div style="cursor:pointer;" class="xemkhac">
                    <div class="panel-footer">
                        <span class="pull-left" style="color:red">Tùy chọn xem theo ngày</span>
                        <span class="pull-right"style="color:red"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
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
          <center><a href="{!! URL::route('admin.thongke.congno') !!}"><h2 style="color:red"><b>BÁO CÁO CÔNG NỢ THEO NGÀY CỦA KHÁCH HÀNG</b></h2></a></center><hr>
          @if(isset($hn))  
                <h4 class=" text-center" >Ngày: {{date('d-m-Y',strtotime($hn))}} </h4>    
            @endif
            @if(isset($bd)&&isset($kt))
                <h4 class=" text-center ">Từ: {{date('d-m-Y',strtotime($bd))}}&emsp; Đến: {{date('d-m-Y',strtotime($kt))}}</h4>
            @endif
            @if(isset($khachmuatuychon))
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
                        @foreach ($khachmuatuychon as $km)
                        <tr >
                          <td style="border:thin blue solid;border-style:dashed;">{!! $count = $count + 1 !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;">KM-0{!! $km->id !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;">{!! $km->khachmua_ten !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($km->khachmua_tonno_dk) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($km->khachmua_tonco_dk) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($km->tt) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($km->khachmua_phat_sinh_co) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($km->khachmua_tonno_ck) !!}</td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right">{!! number_format($km->khachmua_tonco_ck) !!}</td>
                      </tr>
                        @endforeach
                  </tbody>
                      <tr>
                        <td style="border:thin solid;"></td>
                        <td style="border:thin solid;"></td>
                        <td style="border:thin solid;">Cộng: </td>
                        <td style="border:thin solid;" class="text-right"></td>
                        <td style="border:thin solid;" class="text-right"></td>
                        <td style="border:thin solid;" class="text-right"></td>
                        <td style="border:thin solid;" class="text-right"></td>
                        <td style="border:thin solid;" class="text-right"></td>
                        <td style="border:thin solid;" class="text-right"></td>
                      </tr>
                </table>
                </div>
            </div>
          </section>
        </section>
        </div>
        </div>
            @endif
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
      </section>
        </div>
        </div>
      
        <div class="modal fade effect-scale"
      id="modalkhac" tabindex="-1"  role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width:600px">
          <div class="modal-body pd-20 pd-sm-10">
            <button type="button" @click="close" class="close pos-absolute t-15 r-20" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
            <form action="{!! URL::route('admin.thongke.congnotuychon') !!}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <header class="panel-heading" style="background:#60b7a3">
                      <b style="color:black">Tùy chọn xem theo ngày</b>
                </header>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row form-group" >
                                    <div class="col col-md-3 text-center">
                                        <label  class=" form-control-label t">Từ:</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input class="form-control" name="tu" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row form-group" >
                                    <div class="col col-md-3 text-center">
                                        <label  class=" form-control-label">Đến:</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input class="form-control" name="den" type="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Xem
                        </button>
                        <button class="btn btn-primary btn-sm" type="button" @click="close"data-dismiss="modal"aria-label="Close">
                            <i class="fa fa-mail-reply-all"></i> Trở về
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
      </div>
</div>

<!-- END DATA TABLE-->
<script>
$(function(){
    $('.xemkhac').click(function(){
        $('#modalkhac').modal('show');
    })
})
</script>   
@stop
