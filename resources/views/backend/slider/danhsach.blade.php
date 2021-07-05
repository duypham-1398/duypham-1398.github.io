@extends('backend.layout')
@section('content')   
    @include('sweet::alert')                    
<!-- /.panel-heading -->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách slide hiển thị trên trang chủ | <a href="{!! URL::route('admin.slider.getAdd') !!}">Thêm mới</a></b>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr  align="center">
                                    
                                    <th >ID</th>
                                    <th >Tên</th>
                                    <th >Ảnh</th>
                                    <th >Xóa</th>
                                    <th >Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr class="odd gradeX">
                                    
                                    <td>{!! $item->id !!}</td>
                                    
                                    <td>{!! $item->slider_ten !!}</td>
                                    <td>
                                    <img src="{!! asset('resources/upload/slider/'.$item->slider_anh) !!}" class="img-responsive img-rounded" alt="Image" style="width: 300px; height: 40px;">{!! $item->slider_anh !!}
                                    </td>
                                    <td class="center" align="center">
                                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.slider.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a></td>
                                    <td class="center"  align="center"><a href="{!! URL::route('admin.slider.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </section>
            </div>
    <!-- /.row -->
        </div>
@stop
