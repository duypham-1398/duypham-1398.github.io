@extends('backend.layout')
@section('content')
    @include('sweet::alert')               
<!-- /.panel-heading -->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách lô hàng | <a href="{{URL::to('themlohang')}}" >Thêm mới</a></b>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="table table-striped table-bordered table-hover" id="dynamic-table">
                            <thead>
                                <tr >
                                    <th>Ký hiệu</th>
                                    <th>Sản phẩm</th>
                                    <th>Ngày nhập</th>
                                    <th>HSD</th>
                                    <th>SL</th>
                                    <th>SL HT</th>
                                    <th>Mua vào</th>
                                    <th>Xóa </th>
                                    <th>Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr class="odd gradeX">
                                        <?php 
                                        // date("Y-m-d H:i", strtotime("$now -$days day"));
                                            $today  = date("Y-m-d"); // Năm/Tháng/Ngày
                                            
                                            $ngaybd =  date("Y-m-d", strtotime("$item->lohang_ngay_nhap")); // Năm/Tháng/Ngày
                                    
                                            $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $item->lohang_han_su_dung  day"));
                                            // echo $ngaykt;
                                            if ((strtotime($today) >= strtotime($ngaybd))&& (strtotime($today) <= strtotime($ngaykt)))
                                            {

                                            }else{
                                            DB::table('lohang')
                                                ->where('id',$item->id)
                                                ->update([
                                                    'lohang_tinh_trang' => 1,
                                                    ]);
                                            }   
                                        ?>
                                
                                    <td>{!! $item->lohang_ky_hieu !!}</td>
                                    <td>
                                        <?php $sanpham = DB::table('sanpham')->where('id',$item->sanpham_id)->first(); ?>
                                        @if (!empty($sanpham->sanpham_ten))
                                            {!! $sanpham->sanpham_ten !!}-{!! $item->sanpham_id !!}
                                        @else
                                            {!! NULL !!}
                                        @endif
                                    </td>
                                
                                    <td>{!! date("d-m-Y",strtotime($ngaybd)) !!}</td>
                                    <td>{!! date("d-m-Y",strtotime($ngaykt)) !!}</td>
                                    <td>{!! $item->lohang_so_luong_nhap !!}</td>
                                    <td>{!! $item->lohang_so_luong_hien_tai !!}</td>
                                    <td>{!! number_format("$item->lohang_gia_mua_vao",0,",",".")  !!}vnđ</td>
                                    <td class="center">
                                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{{URL::to('/xoalohang/'.$item->id)}}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a></td>
                                    <td class="center">
                                    <a href="{{URL::to('/sualohang/'.$item->id)}}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
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
@endsection