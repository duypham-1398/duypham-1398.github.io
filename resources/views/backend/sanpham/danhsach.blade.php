@extends('backend.layout')
@section('content')   
    @include('sweet::alert')       
<!-- /.panel-heading -->
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading" style="background:#a9d86e">
            <b style="color:black">Danh sách sản phẩm | <a href="{!! URL::route('admin.sanpham.getAdd') !!}"  >Thêm mới</a></b>
        <span class="tools pull-right">
        <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
        <a href="javascript:;" class="fa fa-times" style="color:white"></a>
        </span>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <table class="table table-striped table-bordered table-hover" id="dynamic-table">
                    <thead>
                        <tr>
                        <th>ID</th>
                            <th>Ảnh</th>
                            <th>Ký hiệu</th>
                            <th>Tên</th>
                            <th>Loại</th>
                            <th>ĐVT</th>
                            <th>Giá bán</th>
                            <th>Xóa</th>
                            <th>Sửa</th>
                            <th>Nhập hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr class="odd gradeX" align="left">
                        <td>{{$item->id}}</td>

                            <td>
                            <img src="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}" class="img-responsive img-rounded" alt="Image" style="width: 70px; height: 40px;">
                            </td>
                            <td class="text-center thutg" style = "cursor:pointer;">{!! $item->sanpham_ky_hieu !!}</td>
                            <td><a href="{!! URL::route('admin.sanphamlo.list', [$item->id] ) !!}">{!! $item->sanpham_ten !!}</a></td>
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
                            <td>{!! number_format($item->sanpham_gia_ban) !!}</td>
                            <td class="center">
                            <a href="{!! URL::route('admin.sanpham.getDelete', $item->id ) !!}" onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a></td>
                            </td>
                            <td class="center" > <a href="{!! URL::route('admin.sanpham.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a></td>
                            <td class="center">
                            <a href="{!! URL::route('lohang.getNhaphang', [$item->id] ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
<!-- /.row -->
        </div>
    </div>
@stop



