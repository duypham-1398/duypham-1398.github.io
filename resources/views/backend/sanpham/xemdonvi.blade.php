@extends('backend.layout')
@section('content')                 
    @include('sweet::alert')           
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách đơn vị tính | <a href="{{URL::to('themdv')}}" >Thêm mới</a></b>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
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
                </section>
            </div>
        </div>
@endsection