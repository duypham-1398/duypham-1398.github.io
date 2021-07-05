@extends('backend.layout')
@section('content')  
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                <a href="{!! URL::route('admin.donhang.doanhthungay') !!}">
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
                  <a href="{!! URL::route('admin.donhang.dtdonhangtuan') !!}">
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
                  <a href="{!! URL::route('admin.donhang.dtdonhangthang') !!}">
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
      <section >
      <div class="col-sm-12">
      <div class=" panel panel-default" >
      <a href="{!! URL::route('admin.donhang.bcchitietdh') !!}"> <h4 class=" text-center" >Chi tiết doanh thu tại cửa hàng</h4></a>
      @if(isset($hn))
        <div class=" panel panel-default" >&emsp;    
                <h4 class=" text-center" >Ngày: {{date('d-m-Y',strtotime($hn))}} </h4>    
        </div>
            @endif
            @if(isset($bd)&&isset($kt))
            <div class=" panel panel-default" >&emsp;
                <h4 class=" text-center ">Từ: {{date('d-m-Y',strtotime($bd))}}&emsp; Đến: {{date('d-m-Y',strtotime($kt))}}</h4>
                </div>
            @endif
            <hr/><h4 class=" text-center" >&emsp;Có: {{$sodon}} đơn &emsp;Tổng giá trị: {{number_format($tonggt)}} vnđ</h4>
      </div>
      @if($sodon != 0)
<div class="row">
      <div class="col-sm-12">
          <section class="panel" >
          <center><a href="{!! URL::route('admin.thongke.congno') !!}"><h2 style="color:red"><b>BÁO CÁO DOANH THU BÁN HÀNG TRÊN WEBSITE</b></h2></a></center><hr>
            <div class="panel-body">
                <div class="adv-table">
                <table >
                  <thead>
                    <tr class="text-center">
                      <td style="border:thin blue solid;" width="150px" ><strong>Số thứ tự</strong></td>
                      <td style="border:thin blue solid;" width="400px"><strong>Ngày bán</strong></td>
                      <td style="border:thin blue solid;" width="100px"><strong>Mã đơn bán</strong></td>
                      <td style="border:thin blue solid;" width="400px" ><strong>Tổng tiền</strong>
                      </td>
                    </tr>
                    
                  </thead>
                  <tbody>
                  <?php $count = 0; ?>
                    @foreach($dtngay as $item)
                        <tr >
                          <td style="border:thin blue solid;" class="text-center">{!! $count = $count + 1 !!}</td>
                          <td style="border:thin blue solid;color:red" class="text-center"><h4><b>{{date('d-m-Y',strtotime($item->donhang_ngay_ban))}}</b></h4></td>
                          <td style="border:thin blue solid;" class="text-right"></td>
                          <td style="border:thin blue solid;color:red" class="text-right"><h4><b>{{number_format($item->tongt)}}</b></h4></td>
                      </tr>
                      @foreach($doanhthu as $dt)
                        @if($item->donhang_ngay_ban==$dt->donhang_ngay_ban)
                        <tr >
                          <td style="border:thin blue solid;border-top-style:hidden;"></td>
                          <td style="border:thin blue solid;border-top-style:hidden;" ></td>
                          <td style="border:thin blue solid;" class="text-center">{{$dt->id}}</td>
                          <td style="border:thin blue solid;" class="text-right">{{number_format($dt->donhang_tong_tien)}}</td>
                      </tr>
                      @endif
                      @endforeach
                      @endforeach
                  </tbody>
                  <tr >
                          <td style="border:thin blue solid;color:red"><h4><b><strong></strong></h4></b></td>
                          <td style="border:thin blue solid;color:red" ><h4><b><strong>Tổng cộng:</strong></h4></b></td>
                          <td style="border:thin blue solid;color:red"><h4><b><strong>{{$sodon}} đơn</strong></h4></b></td>
                          <td style="border:thin blue solid;color:red" class="text-right"><h4><b><strong>{{number_format($tonggt)}}</strong></td></h4></b>
                      </tr>
                </table>
                </div>
            </div>
          </section>
@endif
        <div class="modal fade effect-scale"
      id="modalkhac" tabindex="-1"  role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width:600px">
          <div class="modal-body pd-20 pd-sm-10">
            <button type="button" @click="close" class="close pos-absolute t-15 r-20" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
            <form action="{!! URL::route('admin.donhang.dtdonhangtuychon') !!}" method="POST">
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
