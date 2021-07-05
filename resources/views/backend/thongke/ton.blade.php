@extends('backend.layout')
@section('content')    
    @include('sweet::alert')                    
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
            <header class="panel-heading" style="background:#a9d86e">
                <a href="{!! URL::route('admin.thongke.list') !!}"><b>Kho hàng</b></a><b style="color:black"> / @if(isset($data1))Danh sách lô hàng chưa được bán @elseif(isset($data2)) Danh sách sản phẩm bán chạy @else Danh sách tồn sản phẩm @endif</b>
            <span class="tools pull-right">
            <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
            <a href="javascript:;" class="fa fa-times" style="color:white"></a>
            </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table class="table table-striped table-bordered table-hover " id="dynamic-table">
        <thead>
            <tr align="center">
                <th>Ký hiệu</th>
                <th>Tên</th>
                <th>Loại</th>
                <th>ĐVT</th>
                <th>Nhập vào</th>
                <th>Đã bán</th>
                <th>Hiện tại</th>
                @if(isset($data1) or isset($data2))
                <th>Ngày hết hạn</th>
                @endif
                <th>Nhập hàng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr class="odd gradeX" align="left">
            <?php  
                $sanpham = DB::table('sanpham')->where('id',$item->sanpham_id)->first();
                $ngaybd =  date("Y-m-d", strtotime("$item->lohang_ngay_nhap")); // Năm/Tháng/Ngày
                $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $item->lohang_han_su_dung  day"));
            ?>
                <td>{!! $sanpham->sanpham_ky_hieu !!}</td>
                <td>{!! $sanpham->sanpham_ten !!}</td>
                <td>
                    <?php $loaisanpham = DB::table('loaisanpham')->where('id',$sanpham->loaisanpham_id)->first(); ?>
                    @if (!empty($loaisanpham->loaisanpham_ten))
                        {!! $loaisanpham->loaisanpham_ten !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td>
                    <?php $donvitinh = DB::table('donvitinh')->where('id',$sanpham->donvitinh_id)->first(); ?>
                    @if (!empty($donvitinh->donvitinh_ten))
                        {!! $donvitinh->donvitinh_ten !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td>{!! $item->nhap !!}</td>
                <td>{!! $item->ban !!}</td>
                <td>{!! $item->ton !!}</td>
                @if(isset($data1) or isset($data2))
                <td>{{date('d-m-Y',strtotime($ngaykt))}}</td>
                @endif
                <td class="center">
                <a href="{!! URL::route('lohang.getNhaphang', [$item->sanpham_id] ) !!}" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <!-- /.row -->
</div>
</div>
@stop
