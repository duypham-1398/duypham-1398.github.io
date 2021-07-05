@extends('backend.layout')
@section('content')  
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <h2><div># đ</div></h2>  
                        <div>Tổng tiền nhập</div> 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right"> 
                        <h2><div >{{number_format($tong)}} vnđ</div></h2>  
                        <div >Tổng tiền thu</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <h2><div># đ</div></h2>  
                        <div >Tổng thu khách tại cửa hàng</div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <?php 
                    $kh = DB::table('khachhang')->count();
                    $km = DB::table('khachmua')->count();
                    $tongkhach = $kh + $km;
                    ?>
                    <div class="col-xs-12 text-right">
                        <h2><div>{{$tongkhach}} khách</div></h2>
                        <div>Tổng khách hàng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /.row -->
    <section class="wrapper" style="margin-top:-20px">
      <!-- page start-->
      <div class="row">
        <div class="col-sm-6">
      <section class="panel">
      <div class="chat-panel panel panel-default">
      <header class="panel-heading" style="background:#60b7a3">
          <b style="color:black">Báo cáo doanh thu tại cửa hàng</b>
      <span class="tools pull-right">
        <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
        <a href="javascript:;" class="fa fa-times" style="color:white"></a>
      </span>
            </header>
            <div class="panel-body">
            <div class="adv-table">
            <table  class="display table table-bordered table-striped" >
            <thead>
          <tr >
              <th>Ngày bán</th>
              <th >Tổng thu dự kiến</th>
              <th >Tổng thu</th>
              <th >Tùy chọn</th>
          </tr>
      </thead>
      @foreach($donban as $item)
      <tbody>
            <td class="text-center bcdtcuahang" style="cursor: pointer;">{{date('d-m-Y',strtotime($item->donban_ngay_ban))}}</td>
              <td>{{number_format($item->tth)}}</td>
              @if(!is_null($item->tt))
              <td>{{number_format($item->tt)}}</td>
              @else
              <td>0 đ</td>
              @endif
              <td>Xem chi tiết</td>
        </tbody>
        @endforeach
        </table>
        </div>
        </div>
        <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                         <a href="{!! URL::route('admin.donban.bcchitietdb') !!}" class="btn btn-default" type="button">Xem chi tiết</a>
                    </span>
                </div>
            </div>
      </section>
        </div>
          <div class="col-sm-6">
            <section class="panel">
            <div class="chat-panel panel panel-default">
            <header class="panel-heading" style="background:#e27575">
                <b style="color:black">Báo cáo nhập hàng</b>
            <span class="tools pull-right">
              <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
              <a href="javascript:;" class="fa fa-times" style="color:white"></a>
            </span>
              </header>
              <div class="panel-body">
              <div class="adv-table">
              <table class="display table table-bordered table-striped">
              <thead>
            <tr >
                <th>Ngày nhập</th>
                <th >Tổng tiền</th>   
                <th >Tùy chọn</th>         
            </tr>
        </thead>
        @foreach($lohangn as $item)
          <tbody>
                <td>{{date('d-m-Y',strtotime($item->lohang_ngay_nhap))}}</td>
                <td>{{number_format($item->tiennh)}} vnd</td>
                <td>Xem chi tiết</a></td>

          </tbody>
          @endforeach
          </table>
          </div>
              </div>
              <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                         <a href="{!! URL::route('admin.nhaphang.bcchitietnh') !!}" class="btn btn-default" type="button">Xem chi tiết</a>
                    </span>
                </div>
            </div>
            </section>
          </div>
        </div>
              <!-- page end-->
      </section>
      <section class="wrapper" style="margin-top:-20px">
      <!-- page start-->
      <div class="row">
        <div class="col-sm-6">
      <section class="panel">
      <div class="chat-panel panel panel-default">
      <header class="panel-heading" style="background:#60b7a3">
          <b style="color:black">Báo cáo doanh thu trên website</b>
      <span class="tools pull-right">
        <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
        <a href="javascript:;" class="fa fa-times" style="color:white"></a>
      </span>
            </header>
            <div class="panel-body">
            <div class="adv-table">
            <table  class="display table table-bordered table-striped" >
            <thead>
          <tr >
              <th>Ngày bán</th>
              <th >Tổng tiền</th>
              <th >Tổng thanh toán</th>
              <th >Tùy chọn</th>
          </tr>
      </thead>
      @foreach($donhang as $item)
      <tbody>
              <td>{{date('d-m-Y',strtotime($item->donhang_ngay_ban))}}</td>
              <td>{{number_format($item->tth)}}</td>
              @if(!is_null($item->tt))
              <td>{{number_format($item->tt)}}</td>
              @else
              <td>0 đ</td>
              @endif
              <td>Xem chi tiết</td>
        </tbody>
        @endforeach
        </table>
        </div>
        </div>
        <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                         <a href="{!! URL::route('admin.donhang.bcchitietdh') !!}" class="btn btn-default" type="button">Xem chi tiết</a>
                    </span>
                </div>
            </div>
      </section>
        </div>
    <div class="modal fade effect-scale" id="modalthu"tabindex="-1"role="dialog" aria-hidden="true"data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body pd-20 pd-sm-30">
                    <div class="panel panel-default">
						<div class="panel-heading">
						<button type="button"  class="close pos-absolute t-15 r-20"  data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                            Danh sách thu theo ngày
						</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
								<tr>
                                    <th class="text-center">Ngày bán</th>
                                    <th class="text-center">TL thanh toán</th>
                                    <th class="text-center">Tổng tiền</th>
                                    <th class="text-center">Đã thanh toán</th>
								</tr>
                            </thead>
                            <tbody id="thuncuahang">
								
                            </tbody>
		                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	function formatNumber(num) {
		return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
	}
	$(function(){
		$('.datepick').datepicker({ dateFormat: 'yy-mm-dd' });
		$('.bcdtcuahang').click(function(){
			$('#thuncuahang').html('');
			var a = $(this).text();
			var i = 0;
			$.get('{{url('chi-tiet-bao-cao-doanh-thu-cua-hang-theo-ngay')}}', {ngayban: a}, function(data){
				data.result.forEach(function(element){
					if(i != 0)
					{
                        $('#thuncuahang').append(
                        '<tr><td class="text-center">'+element.donban_ngay_ban+'</a></td><td class="text-center">'+element.donban_thanh_toan+'</a></td><td class="text-center">'+formatNumber(element.donban_tong_tien)+'</a></td><td class="text-center">'+element.thanh_toan+'</a></td></tr>')
					}
					else{
						i++;
					}

				});

			})
			$('#modalthu').modal("show")
		});
	})
</script>     
@endsection
