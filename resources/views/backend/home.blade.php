@extends('backend.bieudo.layout')
@section('content')
@include('sweet::alert') 
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="value">
                    <?php 
                            $kh = DB::table('khachhang')->count();
                            $km = DB::table('khachmua')->count();
                            $tongkhach = $kh + $km;
                            ?>
                        <h1 >
                            {{$tongkhach}}
                        </h1>
                        <p>Tổng khách hàng</p>
                    </div>
                </section>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 >
                            {{$sanpham}}
                        </h1>
                        <p>Sản phẩm</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="value">
                        <h1 >
                        {{$donhang}}
                        </h1>
                        <p>Đơn hàng mới</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4">
                        {{$luotbinhluan}}
                        </h1>
                        <p>Bình luận mới</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
        <div class="row">
            <div class="col-lg-12" style="margin-bottom:60px">
                <div style="background:white;">
                    <button type="button" class="btn btn-success xemkhac">
                        <i class="fa fa-dot-circle-o"></i>Tùy chọn xem
                    </button>
                </div>
                <figure class="highcharts-figure">
                    <div id="duong"></div>
                </figure>
                <!--custom chart end-->
            </div>
            
        </div>
        <div class="row" style="margin-bottom:60px">
            <div class="col-lg-12">
                <div style="background:white;">
                    <button type="button" class="btn btn-success" type="button" data-toggle="modal" data-target="#create-kh" >
                        <i class="fa fa-dot-circle-o"></i>Tùy chọn xem
                    </button>
                </div>
                    <figure class="highcharts-figure">
                        <div id="noibo"></div>
                    </figure>
                <!--custom chart end-->
            </div>
            
        </div>
        <div class="row" style="margin-bottom:60px">
            <div class="col-lg-7">
                <figure class="highcharts-figure">
                            <div id="abc"></div>
                </figure>
            </div>
        @include('backend.doanhthu.khach')
        @include('backend.doanhthu.doanhthu')
        </div>
      </div>
</div>

<div class="modal fade" id="create-kh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:black">Tùy chọn thời gian</h4>
            </div>
            <div class="modal-body form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="customer_name">Từ</label>
                        </div>
                        <div class="col-sm-9 tu">
                            <input type="text" class="datepick form-control" id="date_noibo1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="customer_name">Đến</label>
                        </div>
                        <div class="col-sm-9 den">
                            <input type="text"  class="datepick form-control" id="date_noibo2">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="kqtuden btn btn-success" ><i
                        class="fa fa-check"></i>Kết quả
                </button>
                <button type="button" class="btn btn-default btn-sm btn-close" data-dismiss="modal"><i
                        class="fa fa-undo"></i> Bỏ qua
                </button>
            </div>
        </div>
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
                <div class="card">
                    <div class="card-header"><h4>Chọn thời gian</h4></div>
                    <div class ="dttheongay">
                    <div class="tu" style="color:black;">
                        <p><span style="font-size: 14px; color: #555;">Từ<span> <input type="text" class="datepick form-control" id="date_1web" > </p>
                    </div>
                    <div class="den" style="color:black;">
                        <p> <span style="font-size: 14px; color: #555;">Đến<span> <input type="text" class="datepick form-control" id="date_2web" ></p>
                    </div>
                    <button class="kqtuden btn btn-success">kết quả</button>
                </div>
                </div>
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
<!-- END DATA TABLE-->
    </section>
</section>
<!--main content end-->
@endsection