@extends('backend.layout')
@section('content')   
    @include('sweet::alert')                  
<!-- /.panel-heading -->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách tin tức | <a href="{!! URL::route('admin.vechungtoi.getAdd') !!} ">Thêm mới</a></b>
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
                                    
                                    <th >ID</th>
                                    <th >Ảnh</th>
                                    <th >Tiêu đề</th>
                                    <th >Xóa</th>
                                    <th >Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr >
                                    
                                    <td>{!! $item->id !!}</td>
                                    <td>
                                    <img src="{!! asset('resources/upload/vechungtoi/'.$item->vechungtoi_anh) !!}" class="img-responsive img-rounded" alt="Image" style="width: 300px; height: 40px;">{!! $item->vechungtoi_anh !!}
                                    </td>
                                    <td>{!! $item->vechungtoi_tieu_de !!}</td>
                        
                                    <td class="center" align="center">
                                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.vechungtoi.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a></td>
                                    <td class="center"  align="center"><a href="{!! URL::route('admin.vechungtoi.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
                                    </td>
                                </tr>
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
