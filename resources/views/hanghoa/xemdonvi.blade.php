@extends('layout_ad')
@section('title')
        <h3 class="page-header ">
        Thể tích hàng hóa / 
            <a href="{{URL::to('themdv')}}"  style="margin-top:-8px;" class="fa fa-product-hunt">Thêm mới</a>
        </h3>
@stop

@section('content')                 
<div class="panel panel-default">
    <div class="panel-heading">
        <b><i>Thể tích hàng hóa</i></b>
    </div>
<!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="text-center">Đơn vị tính</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($donvi as $tt)
                    <tr>
                        <td class="text-center">{{$tt->donvitinh_ten}}</td>
                        <td class="text-center">
                            <a href="{{URL::to('/suadv/'.$tt->id)}}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></i></a>
                        </td>
                        <td class="text-center">
                            <a  type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')" href="{{URL::to('/xoadv/'.$tt->id)}}">
                            <i class="fa fa-trash-o  fa-fw"></i>
                            </a>

                        </td>
                        
                    </tr>
                @endforeach									
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection