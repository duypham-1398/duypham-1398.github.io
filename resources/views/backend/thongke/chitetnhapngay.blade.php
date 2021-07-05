@extends('backend.layout')
@section('content')  
<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="panel panel-primary">
						<div class="panel-body" style=" max-height: 600px; overflow: hidden; overflow-y: scroll;">
							<table class="table table-bordered table-striped">
							<div>
							<div class="col-md-6 padd-right-0" style="background-color:#bde492;">
								<div class="report-box">
										<div class="infobox-icon" style="color:black;">
												<i class="fa fa-calendar" style="font-size: 30px;" aria-hidden="true"></i>
										</div>
										<div class="infobox-data" style="color:black;">
										<p> <input type="text" class="datepick" id="date_1" > <span style="font-size: 14px; color: #555;">Ngày</span></p>
										</div>
								</div>
        				</div>
								<div class="col-md-6 padd-right-0" style="background-color:#d4e200ba;">
									<div class="report-box">
											<div class="infobox-icon">
													<i class="fa fa-money" style="font-size: 30px;"></i>
											</div>
											<div class="infobox-data">
													<h3 class="infobox-title cred tongdoanhthu" style="font-size: 25px;">{{number_format($tongdt)}} VND</h3>
													<span class="infobox-data-number text-center" style="font-size: 14px; color: #555;">Tổng doanh thu</span>
											</div>
									</div>
							</div>
						</div>
								<thead>
								<tr>
										<th class="text-center" style="color:black;">Ngày thu</th>
										<th class="text-center" style="color:black;">Thành tiền</th>
								</tr>
								</thead>
								<tbody>
										@foreach($thu as $row)
												<tr>
														<td class="text-center thutgdt" style="cursor: pointer;">{{$row->donban_ngay_ban}}</td>
														<td class="text-center" >{{number_format($row->tt)}} VND</td>
													
												</tr>
										@endforeach
													
								</tbody>
						</table>
					</div>
					</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="panel panel-primary">
						<div class="panel-body" style=" max-height: 600px; overflow: hidden; overflow-y: scroll;">
							<table class="table table-bordered table-striped">
							<div>
							<div class="col-md-6 padd-right-0" style="background-color:#bde492;">
								<div class="report-box">
										<div class="infobox-icon" style="color:black;">
												<i class="fa fa-calendar" style="font-size: 30px;" aria-hidden="true"></i>
										</div>
										<div class="infobox-data" style="color:black;">
										<p> <input type="text" class="datepick" id="date_2"> <span style="font-size: 14px; color: #555;">Ngày</span></p>
										</div>
								</div>
        				</div>
								<div class="col-md-6 padd-right-0" style="background-color:#d4e200ba;">
									<div class="report-box">
											<div class="infobox-icon">
													<i class="fa fa-money" style="font-size: 30px;"></i>
											</div>
											<div class="infobox-data">
													<h3 class="infobox-title cred tongchiphi" style="font-size: 25px;">{{number_format($tongchi)}} VND</h3>
													<span class="infobox-data-number text-center" style="font-size: 14px; color: #555;">Tổng chi phí nhập hàng</span>
											</div>
									</div>
							</div>
						</div>
								<thead>
								<tr>
										<th class="text-center" style="color:black;">Ngày nhập</th>
										<th class="text-center" style="color:black;">Thành tiền</th>
								</tr>
								</thead>
								<tbody>
										@foreach($nhap as $row)
												<tr>
														<td class="text-center thutg" style = "cursor:pointer;">{{$row->lohang_ngay_nhap}}</a></td>
														<td class="text-center" >{{number_format($row->tt)}} VND</td>
													
												</tr>
										@endforeach
													
								</tbody>
						</table>
					</div>
					</div>
			</div>
	</div>
	<div class="modal fade effect-scale" id="modalNhap"tabindex="-1"role="dialog" aria-hidden="true"data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body pd-20 pd-sm-30">
						<div class="panel panel-default">
						<div class="panel-heading">
						<button
              type="button"
              class="close pos-absolute t-15 r-20"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
						
								Danh sách nhập theo ngày
						</div>
						<div class="panel-body">
								<table class="table table-bordered table-striped">
								<thead>
								<tr>
										<th class="text-center">Mã PN</th>
										<th class="text-center">Nhân viên</th>
										<th class="text-center">Nhà cung cấp</th>
										<th class="text-center">Tổng tiền</th>
										<th class="text-center">Ngày nhập<br>______________</th>
								</tr>
								</thead>
								<tbody class="nhapntg">
								@foreach($nhapn as $row)
												<tr>
														<td class="text-center">#</a></td>
														<td class="text-center" >#</td>
														<td class="text-center">#</a></td>
														<td class="text-center">{{number_format($row->lohang_gia_mua_vao*$row->lohang_so_luong_nhap)}}</a></td>
														<td class="text-center">{{$row->lohang_ngay_nhap}}</a></td>
													
												</tr>
										@endforeach
								</tbody>
								</table>
            </div>
          </div>
        </div>
      </div>
    </div>


    </div>
		<div class="modal fade effect-scale" id="modalthu"tabindex="-1"role="dialog" aria-hidden="true"data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body pd-20 pd-sm-30">
						<div class="panel panel-default">
						<div class="panel-heading">
						<button type="button"  class="close pos-absolute t-15 r-20"  data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
						
								Danh sách thu theo ngày
						</div>
						<div class="panel-body">
								<table class="table table-bordered table-striped">
								<thead>
								<tr>
										<th class="text-center">Mã HD</th>
										<th class="text-center">Nhân viên bán</th>
										<th class="text-center">Khách hàng</th>
										<th class="text-center">Thành tiền</th>
										<th class="text-center">Ngày bán<br>______________</th>
								</tr>
								</thead>
								<tbody id="thuntg">
								
								</tbody>
		            </table>
            </div>
          </div>
        </div>
      </div>
      <script>
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
$(function(){
	$('.datepick').datepicker({ dateFormat: 'yy-mm-dd' });
	//thutgdt
	$('.thutgdt').click(function(){
		$('#thuntg').html('');
		var a = $(this).text();
		var i = 0;
		$.get('{{url('thutheongay')}}', {ngayban: a}, function(data){
			data.result.forEach(function(element){
				if(i != 0)
				{
					$('#thuntg').append(
				'	<tr><td class="text-center">'+formatNumber(element.donban_tong_tien)+'</a></td><td class="text-center">'+element.donban_ngay_ban+'</a></td></tr>'
			)
				}
				else{
					i++;
				}

			});

		})
		$('#modalthu').modal("show")
	});
	$('.thutg').click(function(){
		$('.nhapntg').html('');
		var a = $(this).text();
		var i = 0;
		$.get('{{url('theongay')}}', {ngaynhap: a}, function(data){
	
			data.result.forEach(function(element){
				if(i != 0)
				{
					$('.nhapntg').append(
				'	<tr><td class="text-center">'+element.MaPN+'</a></td><td class="text-center" >'+element.NV+'</td><td class="text-center">'+element.NCC+'</a></td><td class="text-center">'+formatNumber(element.TongTien)+'</a></td><td class="text-center">'+element.NgayNhap+'</a></td></tr>'
			)
				}
				else{
					i++;
				}

			});

		})
		$('#modalNhap').modal("show")
	});
	$('#date_1').change(function(){
		if($(this).val() == '')
		{
			$('.tongdoanhthu').html(formatNumber({{$tongdt}}) + " VND");
		}
		else{
			$.get('{{url('tongthutheongay')}}', {ngayban: $(this).val()}, function(data){
				$('.tongdoanhthu').html(formatNumber(data.result) + " VND");
			})
		}

	});
	$('#date_2').change(function(){
		if($(this).val() == '')
		{
			$('.tongchiphi').html(formatNumber({{$tongchi}}) + " VND");
		}
		else{
			$.get('{{url('tongtheongay')}}', {ngaynhap: $(this).val()}, function(data){
				$('.tongchiphi').html(formatNumber(data.result) + " VND");
			})
		}

	});
})
</script>

@endsection

