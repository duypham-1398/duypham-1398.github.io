@extends('backend.layout')
@section('content')  
@include('sweet::alert')            
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách nhân viên | <a href="{!! URL::route('admin.nhanvien.getAdd') !!} ">Thêm mới</a></b>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr >
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>CMND</th>
                                    <th>SĐT</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày vào làm</th>
                                    <th>Email</th>
                                    <th>Tên tài khoản</th>
                                    <th>Loại người dùng</th>
                                    
                                    <th >Tùy chọn</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $item)
                                <tr >
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->nhanvien_ten !!}</td>
                                    <td>{!! $item->nhanvien_cmnd !!}</td>
                                    <td>{!! $item->nhanvien_sdt !!}</td>
                                    <td>{!! $item->nhanvien_dia_chi !!}</td>
                                    <td>{!! $item->nhanvien_ngay_vao_lam !!}</td>
                                    <td>{!! $item->email !!}</td>
                                    <td>{!! $item->name !!}</td>
                                    <td>
                                        <?php $loainguoidung = DB::table('loainguoidung')->where('id',$item->loainguoidung_id)->first(); ?>
                                        @if (!empty($loainguoidung->loainguoidung_ten))
                                            {!! $loainguoidung->loainguoidung_ten !!}
                                        @else
                                            {!! NULL!!}
                                        @endif
                                    </td>
                                    <td class="center">
                                    <a href="{!! URL::route('admin.nhanvien.getDelete', $item->id ) !!}" onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                                     <a href="{!! URL::route('admin.nhanvien.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                </section>
            </div>
        </div>
    <!-- /.row -->
@stop