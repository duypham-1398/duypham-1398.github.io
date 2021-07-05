@extends('backend.layout')
@section('content')  
    @include('sweet::alert')                 
<!-- /.panel-heading -->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách tuyển dụng | <a href="{!! URL::route('admin.tuyendung.getAdd') !!} ">Thêm mới</a></b>
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
                                    <th>Ảnh</th>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Mô tả</th>
                                    <th>Ngày HH</th>
                                    <th>Liên hệ</th>
                                    <th>Xóa</th>
                                    <th>Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $item)
                                <tr class="odd gradeX">
                                <td>
                                    <img src="{!! asset('resources/upload/tuyendung/'.$item->tuyendung_anh) !!}" class="img-responsive img-rounded" alt="Image" style="width: 70px; height: 40px;">
                                    </td>
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->tuyendung_tieu_de !!}</td>
                                    <td>{!! $item->tuyendung_mo_ta !!}</td>
                                    <td>{!! date("d - m - Y",strtotime("$item->created_at + $item->tuyendung_thoi_gian days"))  !!}</td>
                                    <td>{!! $item->tuyendung_lien_he !!}</td>
                                    <td class="center">
                                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.tuyendung.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a></td>
                                    <td class="center"><a href="{!! URL::route('admin.tuyendung.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    <!-- /.row -->
                </section>
            </div>
        </div>
@stop