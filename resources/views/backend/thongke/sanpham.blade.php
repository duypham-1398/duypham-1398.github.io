@extends('backend.layout')
@section('content')    
    @include('sweet::alert')                    
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
            <header class="panel-heading" style="background:#a9d86e">
                @if(isset($data2))
                <b style="color:black">Danh sách sản phẩm đã bán</b>
                @elseif(isset($data3))
                <b style="color:black">Danh sách sản phẩm hiện có</b>
                @elseif(isset($data4))
                <b style="color:black">Danh sách sản phẩm đổi trả</b>
                @else
                <b style="color:black">Danh sách sản phẩm đã nhập</b>
                @endif
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
                <th>Lô hàng</th>
                <th>Giá mua vào</th>
                <th>Giá bán ra</th>
                <th>Nhập vào</th>
                <th>Đã bán</th>
                <th>Hiện tại</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr class="odd gradeX" align="left">
                <td>{!! $item->sanpham_ky_hieu !!}</td>
                <td>{!! $item->sanpham_ten !!}</td>
                <td>
                    <?php $loaisanpham = DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first(); ?>
                    @if (!empty($loaisanpham->loaisanpham_ten))
                        {!! $loaisanpham->loaisanpham_ten !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td>
                    <?php $donvitinh = DB::table('donvitinh')->where('id',$item->donvitinh_id)->first(); ?>
                    @if (!empty($donvitinh->donvitinh_ten))
                        {!! $donvitinh->donvitinh_ten !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td>{!! $item->lohang_ky_hieu !!}</td>
                <td>{!! number_format($item->lohang_gia_mua_vao) !!}</td>
                <td>{!! number_format($item->sanpham_gia_ban) !!}</td>
                <td>{!! $item->lohang_so_luong_nhap !!}</td>
                <td>{!! $item->lohang_so_luong_da_ban !!}</td>
                <td>{!! $item->lohang_so_luong_hien_tai !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <!-- /.row -->
</div>
</div>

@stop
