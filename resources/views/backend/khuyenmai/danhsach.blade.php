@extends('backend.layout')
@section('content')  
@include('sweet::alert')
<!-- /.panel-heading -->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách tin khuyến mại | <a href="{!! URL::route('admin.khuyenmai.getAdd') !!}">Thêm mới</a></b>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr align="center">
                                    <th>Ảnh</th>
                                    <th>Status</th>
                                    <th>ID</th>
                                    <th>Chủ đề</th>
                                    <th>Tỷ lệ</th>
                                    <th>Thời gian</th>
                                    <th>Xóa</th>
                                    <th>Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                @foreach ($data as $item)
                            <tr class="odd gradeX">
                                    <td>
                                    <img src="{!! asset('resources/upload/khuyenmai/'.$item->khuyenmai_anh) !!}" class="img-responsive img-rounded" alt="Image" style="width: 70px; height: 40px;">
                                    </td>
                                    <td>
                                        <?php 
                                            if ( $item->khuyenmai_tinh_trang == 1 )
                                            {
                                                print_r('Còn KM');
                                            } else{
                                                print_r('Hết KM');
                                            }   
                                        ?> 
                                    </td>
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->khuyenmai_tieu_de !!}</td>
                                    <td>{!! $item->khuyenmai_phan_tram !!}%</td>
                                    <td>{!! $item->khuyenmai_thoi_gian !!} ngày</td>
                                    <td>
                                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{{URL::to('/xoakm/'.$item->id)}}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                                    </td>
                                    <td class="center"><a href="{!! URL::route('admin.khuyenmai.getEdit',$item->id) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
                                    </td>

                                </tr>
                                <?php 
                            // print_r($item->khuyenmai_tinh_trang);
                            if ($item->khuyenmai_tinh_trang == 0 )
                            {
                                $ids = DB::table('sanphamkhuyenmai')->select('sanpham_id')->where('khuyenmai_id',$item->id)->get();
                                // print_r($ids);
                                foreach ($ids as $key => $val) {
                                        // DB::table('sanpham')
                                        //     ->where('id',$val->sanpham_id)
                                        //     ->update([
                                        //             'sanpham_khuyenmai'=> 0,
                                        //         ]);
                                    }
                            }else {
                                $ids = DB::table('sanphamkhuyenmai')->select('sanpham_id')->where('khuyenmai_id',$item->id)->get();
                                // print_r($ids);
                                foreach ($ids as $key => $val) {
                                        // DB::table('sanpham')
                                        //     ->where('id',$val->sanpham_id)
                                        //     ->update([
                                        //             'sanpham_khuyenmai'=> 1,
                                        //         ]);
                                    }
                                    
                            }
                    // print_r($u);
                        ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </section>
            </div>
        </div>
    <!-- /.row -->
@stop
