@extends('backend.layout')
@section('content')  
    @include('sweet::alert')              
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#60b7a3">
                    <b style="color:black">Danh sách khách tại cửa hàng</b> | <button type="button" data-toggle="modal" data-target="#create-kh" class="btn btn-primary"> +KH Mới</button>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
<!-- /.panel-heading -->
                <div class="panel-body ">
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
                                <?php 
                                $hh = DB::table('donban')->select('tinhtranghd_id',DB::raw('SUM(donban_tong_tien) as tth'))->where('khachmua_id',$item->id)->first();
                                ?>

                                <tr >
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->khachmua_ten !!}</td>
                                    <td>{!! $item->khachmua_sdt !!}</td>
                                    <td>{!! $item->khachmua_email !!}</td>
                                    <td>{!! $item->khachmua_dia_chi !!}</td>
                                    <td class="text-right">{!! number_format($item->khachmua_tonno_ck) !!}</td>
                                    <td class="text-right">{!! number_format($item->khachmua_tonco_ck) !!}</td>
                                    <td class="center">
                                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.khachmua.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                                    <a href="{!! URL::route('admin.khachmua.getHistory', $item->id ) !!}" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="Xem lịch sử mua hàng"><i class="fa fa-history"></i></a>
                                    <a href="{!! URL::route('admin.phieuthu.getkhachmua', $item->id ) !!}" 
                                            type="button" class="btn btn-default" 
                                            data-toggle="tooltip" data-placement="left" 
                                            title="Tạo phiếu thu" style="background:#a9d86e">
                                            <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="{!! URL::route('admin.khachmua.phieuthu', $item->id) !!}"
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
                </div>
            </div>
            <form role="form" method="post" action="{{URL::to('them-khach-mua')}}">
                {{ csrf_field() }}
                <div class="modal fade" id="create-kh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel" >Tạo mới khách hàng</h4>
                            </div>
                            <div class="modal-body form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="customer_name">Mã khách hàng</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="id" class="form-control" value=""
                                                placeholder="Mã khách hàng(tự sinh nếu bỏ trống)">
                                            <span style="color: red; font-style: italic;" class="error error-customer_code"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="customer_name">Tên Khách hàng</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="customer_name" name="khachmuaten" class="form-control" value=""
                                                placeholder="Nhập tên khách hàng( bắc buộc )">
                                            <span style="color: red; font-style: italic;" class="required"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="customer_phone">Số điện thoại</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="khachmuasdt"
                                                class="form-control" value="" placeholder="Nhập số điện thoại">
                                            <span style="color: red; font-style: italic;" class="required"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="customer_email">Email</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="khachmuaemail" class="form-control" value=""
                                                placeholder="Nhập email khách hàng ( ví dụ: kh10@gmail.com )">
                                            <span style="color: red; font-style: italic;" class="required"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="customer_addr">Địa chỉ</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text"  name="khachmuadiachi" class="form-control"
                                                value="" placeholder="Nhập địa chỉ">
                                            <span style="color: red; font-style: italic;" class="required"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="customer_addr">Tồn nợ đầu kỳ</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" value="0" name="tonnodk" class="form-control"
                                            value="" placeholder="">
                                        <span style="color: red; font-style: italic;" class="required"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="customer_addr">Tồn có đầu kỳ</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" value="0" name="toncodk" class="form-control"
                                            value="" placeholder="">
                                        <span style="color: red; font-style: italic;" class="required"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm btn-crcust" ><i
                                        class="fa fa-check"></i> Lưu
                                </button>
                                <button type="button" class="btn btn-default btn-sm btn-close" data-dismiss="modal"><i
                                        class="fa fa-undo"></i> Bỏ qua
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@stop