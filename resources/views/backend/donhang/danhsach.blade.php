@extends('backend.layout')
@section('content')
    @include('sweet::alert')              
    <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách đơn hàng trên website</b>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">

                        <table class="table table-striped table-bordered table-hover" id="dynamic-table">
                            <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Tình trạng</th>
                                    <th>Xử lý đơn hàng theo lô</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="even gradeC" align="center">
                                        <td>{!! $item->id !!}</td>
                                        <td>
                                        <?php  
                                            $kh = DB::table('khachhang')->where('id',$item->khachhang_id)->first();
                                            print_r($kh->khachhang_ten);
                                        ?> 
                                        </td>
                                        <td>{!! date("d-m-Y", strtotime("$item->created_at")) !!}</td>
                                        <td>{!! number_format("$item->donhang_tong_tien",0,",",".") !!} vnđ </td>
                                        <td>
                                        <?php  
                                            $tt = DB::table('tinhtranghd')->where('id',$item->tinhtranghd_id)->first();
                                            print_r($tt->tinhtranghd_ten);
                                        ?>  
                                        </td>
                                        <td class="center">
                                        @if($item->donhang_xu_ly !== 1)
                                        <a href="{!! URL::route('admin.donhang.chitiet', $item->id ) !!}" 
                                        type="button" class="btn btn-primary" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="Xem chi tiết và tạo đơn theo lô">Xử lý đơn hàng theo lô
                                        </a>
                                        @else
                                        <a href="{{URL::to('chi-tiet-don-hang-theo-lo',$item->id)}}"><b style="color:red">Đã xử lý đơn hàng theo lô</b></a></td>
                                        @endif
                                        </td>
                                        <td class="center">
                                        <a href="{!! URL::route('admin.donhang.getEdit1', $item->id ) !!}" 
                                        type="button" class="btn btn-primary" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="Cập nhât Thông tin Giao hàng">
                                            <i class="fa fa-crosshairs"></i>
                                        </a>
                                        @if($item->donhang_xu_ly !== 1)
                                        <a href="{!! URL::route('admin.donhang.getEdit2', $item->id ) !!}" 
                                        type="button" class="btn btn-danger" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="Cập nhât Thông tin Thanh toán">
                                            <i class="fa fa-credit-card"></i>
                                        </a>
                                        @endif
                                        @if($item->donhang_xu_ly == 1)
                                        <a href="{!! URL::route('admin.donhang.getEdit', $item->id ) !!}" 
                                        type="button" class="btn btn-warning" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="Cập nhât Tình trạng đơn hàng">
                                            <i class="fa fa-exchange"></i>
                                        </a>
                                        @endif
                                        <a href="{!! URL::route('admin.donhang.pdf', $item->id ) !!}" 
                                        type="button" class="btn btn-default" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="In hóa đơn">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
    <!-- /.row -->
                    </div>
                </section>
            </div>
        </div>
@stop
