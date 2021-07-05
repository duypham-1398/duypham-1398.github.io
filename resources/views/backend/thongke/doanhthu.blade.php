@extends('backend.layout')
@section('content')  
<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    &emsp;<a href="banhang/doanhthu" ><h2 class="title-5 m-b-35" style="color:blue;">Chi tiết doanh thu theo hóa đơn</h2></a>
                    @if(isset($thang))
                    &emsp;&emsp;&emsp;&emsp;<h4 class="title-5 m-b-35">@if(isset($tuan))Tuần {{$tuan}}@endif &ensp; Tháng: {{$thang}}</h4>
                    @endif
                </div>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="row">
                            <div class="rs-select2--light rs-select2--md">
                                <div class="header__navbar" >
                                    <ul class="list-unstyled">
                                        <li class="has-sub">
                                            <div style="padding:7px;background-color: #4ee2ff;border: solid #018795 1px;color:black;border-radius: 3px;">
                                            <i class="fas fa-calendar-alt"></i>&emsp;Lọc theo ngày
                                            </div>
                                            <ul class="header3-sub-list list-unstyled" style="left:50%;"> 
                                                <li><a href="doanhthu-hn"> &emsp;Hôm nay</a></li>
                                                <li><a href="doanhthu-hq"> &emsp;Hôm qua</a></li>
                                                <li><a href="doanhthu-7n"> &emsp;Tuần này</a></li>
                                                <li><a href="doanhthu-tn"> &emsp;Tháng này</a></li>
                                                <li><div class="xemkhac" style="padding: 10px 22px;color: #777777;">&emsp;Lựa chọn khác</div></li>
                                                
                                            </ul>
                                         </li>
                                    </ul>
                                </div>
                            </div>&emsp;
                                @if(isset($hn))
                                    <h4 class="title-5 m-b-0">Ngày: {{$hn}}</h4>
                                @endif
                                @if(isset($bd)&&isset($kt))
                                    <h4 class="title-5 m-b-0">Từ: {{$bd}}&emsp; Đến: {{$kt}}</h4>
                                @endif
                            </div>
                        </div>
                   
                    <div class="table-data__tool-right">
                    </div>
                </div>
                                        <!-- DATA TABLE-->
                <div class=" m-b-40">
                    <div class="row" style="margin-left:60%; font-size:18px; color: red;"><h3>Tổng giá trị: &emsp;</h3><strong>{{number_format($tonggt)}}&ensp;Đồng</strong></div>
                    <div class="row" style="margin-left:60%; margin-top:15px;font-size:18px; color: blue;"><p>Số đơn hàng: &emsp;&emsp;&emsp;{{$sodon}}&ensp;đơn</p></div><br>
                    <table class="table table-borderless table-data2">
                        <thead style="background:#007bff;">
                            <tr>
                                <th>&emsp;Mã</th>
                                <th>&emsp;Ngày bán</th>
                                <th>Người bán</th>
                                <th>Khách hàng</th>
                                <th>Giá trị</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dtngay))
                            @foreach($dtngay as $ngay)
                                <tr style="background-color:#d8fb6d;border-bottom: dotted;">
                                    
                                    <td><h5>{{$ngay->donban_ngay_ban}}</h5></td>
                                    <td ></td>
                                    <td></td>
                                    
                                    <td><h5 style="color:red;">&emsp;{{number_format($ngay->DT)}}&ensp;Đ</h5></td>
                                </tr>
                                @foreach($doanhthu as $dt)
                                @if($ngay->donban_ngay_ban==$dt->donban_ngay_ban)
                                    <tr>
                                        <td style="padding: 12px 40px;">
                                            <a href="giaodich/hoadon/chitiet/{{$dt->id}}"><u>{{$dt->ma}}</u>
                                                
                                            </a>
                                        </td>
                                        <td>{{$dt->updated_at}}</td>
                                        <td>#</td>
                                        <td>#</td>
                                        <form action="doanhthu-ct" method="POST">
                                      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <td>
                                    <input type="hidden" class="form-control" name="tu"value="{{$dt->donban_ngay_ban}}" type="date">
                                    <button type="submit " class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Xem
                                    </button>
                                    </td>
                                 
                                    </form>
                                        <td style="color:red;">&emsp;{{number_format($dt->donban_tong_tien)}}&ensp;Đ</td>
                                    </tr>
                                @endif
                                @endforeach
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {!! $dtngay->links() !!}
                </div>
                <!-- END DATA TABLE                  -->
            </div>
        </div>
    </div>
</section>

<div
      class="modal fade effect-scale"
      id="modalkhac"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
      data-backdrop="static"
      data-keyboard="false"
      
    >
    </style>
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="min-width:600px">
          <div class="modal-body pd-20 pd-sm-10">
            <button
              type="button"
              @click="close"
              class="close pos-absolute t-15 r-20"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
            <form action="doanhthu-khac" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="card">
                    <div class="card-header"><h4>Lựa chọn khác</h4></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row form-group" style="margin-bottom: 1.4rem;">
                                    <div class="col col-md-3">
                                        <label  class=" form-control-label">Từ:</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input class="form-control" name="tu" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row form-group" style="margin-bottom: 1.4rem;">
                                    <div class="col col-md-3">
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
</div>
@endsection