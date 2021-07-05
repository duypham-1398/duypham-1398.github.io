@extends('backend.layout')
@section('content')  
    @include('sweet::alert')              
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#60b7a3">
                    <b style="color:black">Danh sách khách hàng trên website</b>
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
                                    <th>ID</th>
                                    <th >Tên</th>
                                    <th >SĐT</th>
                                    <th >Email</th>
                                    <th >Địa chỉ</th>
                                    <th width="70px">Khách nợ</th>
                                    <th width="70px">Nợ khách</th>
                                    <th width="160px">Tùy chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr >
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->khachhang_ten !!}</td>
                                    <td>{!! $item->khachhang_sdt !!}</td>
                                    <td>{!! $item->khachhang_email !!}</td>
                                    <td>{!! $item->khachhang_dia_chi !!}</td>
                                    <td class="text-right">{!! number_format($item->khachhang_tonno_ck) !!}</td>
                                    <td class="text-right">{!! number_format($item->khachhang_tonco_ck) !!}</td>
                                    <td class="center">
                                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.khachhang.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                                    <a href="{!! URL::route('admin.khachhang.getHistory', $item->id ) !!}" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="Xem lịch sử mua hàng"><i class="fa fa-history"></i></a>
                                    <a href="{!! URL::route('admin.phieuthu.getkhachhang', $item->id ) !!}" 
                                        type="button" class="btn btn-default" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="Tạo phiếu thu" style="background:#a9d86e">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="{!! URL::route('admin.khachhang.phieuthu', $item->id) !!}"
                                        type="button" class="btn btn-default" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="Xem danh sách phiếu thu của khách hàng" style="background:#a9d86e">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    <!-- /.row -->
                </section>
            </div>
        </div>
@stop