@extends('backend.layout')
@section('content')
    @include('sweet::alert')            
<!-- /.panel-heading -->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách loại sản phẩm | <a href="{!! URL::route('admin.loaisanpham.getAdd') !!}"  >Thêm mới</a></b>
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
                                    <th>Ảnh</th>
                                    <th>ID</th>
                                    <th>Loại sản phẩm</th>
                                    <th>Nhóm</th>
                                    <th>Xóa</th>
                                    <th>Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr class="odd gradeX">
                                    <td>
                                    <img src="{!! asset('resources/upload/loaisanpham/'.$item->loaisanpham_anh) !!}" class="img-responsive img-rounded" alt="Image" style="width: 70px; height: 40px;">
                                    </td>
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->loaisanpham_ten !!}</td>
                                    <td>
                                        <?php $nhom = DB::table('nhom')->where('id',$item->nhom_id)->first(); ?>
                                        @if (!empty($nhom->nhom_ten))
                                            {!! $nhom->nhom_ten !!}
                                        @else
                                            {!! NULL !!}
                                        @endif
                                    </td>
                                    <td class="center">
                                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.loaisanpham.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                                    <td class="center"><a href="{!! URL::route('admin.loaisanpham.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
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
