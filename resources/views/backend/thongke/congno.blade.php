@extends('backend.layout')
@section('content')  
<!-- /.row -->
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right">
                    <?php 
                        $kw = DB::table('khachhang')->select(DB::raw('khachhang_tonno_ck as tn'),DB::raw('khachhang_tonco_ck as tc'))->get();
                        $kc = DB::table('khachmua')->select(DB::raw('khachmua_tonno_ck as tn'),DB::raw('khachmua_tonco_ck as tc'))->get();
                        $t = $kw->sum('tn') + $kc->sum('tn');
                        $tc = $kw->sum('tc') + $kc->sum('tc');
                    ?>
                        <h2><div>{{number_format($t)}} đ</div></h2>  
                        <div>Tổng tiền khách còn nợ</div> 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right"> 
                        <h2><div >{{number_format($tc)}} đ</div></h2>  
                        <div >Tổng tiền còn nợ khách</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <?php 
                    $kh = DB::table('khachhang')->count();
                    $km = DB::table('khachmua')->count();
                    $tongkhach = $kh + $km;
                    ?>
                    <div class="col-xs-12 text-right">
                        <h2><div>{{$tongkhach}} người</div></h2>
                        <div>Tổng khách hàng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /.row -->
    <section class="wrapper" style="margin-top:-20px">
              <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#60b7a3">
                    <a href="{!! URL::route('admin.thongke.tonghopcongno') !!}"><b style="color:black">Công nợ khách mua hàng trên website</b></a>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr >
                                    <th>ID</th>
                                    <th >Tên</th>
                                    <th >Tồn nợ dk</th>
                                    <th >Tồn có dk</th>
                                    <th >Phát sinh nợ</th>
                                    <th >Phát sinh có</th>
                                    <th >Tồn nợ ck</th>
                                    <th >Tồn có ck</th>
                                    <th >Tùy chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr >
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->khachhang_ten !!}</td>
                                    <td class="text-center">{!! number_format($item->khachhang_tonno_dk) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachhang_tonco_dk) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachhang_phat_sinh_no) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachhang_phat_sinh_co) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachhang_tonno_ck) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachhang_tonco_ck) !!}</td>
                                    <td class="text-center">
                                    <a href="{!! URL::route('admin.phieuthu.getkhachhang', $item->id ) !!}" 
                                        type="button" class="btn btn-default" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="Tạo phiếu thu" style="background:#a9d86e">
                                        <i class="fa fa-plus"></i>
                                        </a>
                                    <!-- Tạo phiếu thu -->
                                    <!-- <div class="modal fade" id="create-ptkh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel" style="text-transform: uppercase;"><i class="fa fa-plus"></i>
                                                        Tạo phiếu thu khách trên website</h4>
                                                </div>
                                                <div class="modal-body form-horizontal">
                                                        <div class="form-group">
                                                            <div class="col-sm-3">
                                                                <label>Tiền thu từ khách</label>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="tienthu" class="form-control" value="0" placeholder="Nhập số tiền thu từ khách">
                                                                <span style="color: red; font-style: italic;" class="error error-manv"></span>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-3">
                                                                <label >Lý do thu tiền</label>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <select name="lydo"  class="form-control">
                                                                    <option >Thu nợ khách hàng</option>
                                                                    <option >Tiền khách thanh toán</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer" >
                                                    <button type="button" class="btn btn-primary btn-sm btn-crnv" onclick="cms_cruser()"><i
                                                            class="fa fa-check"></i> Lưu
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-sm btn-close" data-dismiss="modal"><i
                                                            class="fa fa-undo"></i> Bỏ qua
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- end tạo phiếu thu -->
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
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading" style="background:#e27575">
                    <b style="color:black">Công nợ khách mua hàng tại cửa hàng</b>
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
                                    <th >Tên</th>
                                    <th >Tồn nợ dk</th>
                                    <th >Tồn có dk</th>
                                    <th >Phát sinh nợ</th>
                                    <th >Phát sinh có</th>
                                    <th >Tồn nợ ck</th>
                                    <th >Tồn có ck</th>
                                    <th >Tùy chọn</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($khachmua as $item)
                                <tr >
                                <td>{!! $item->id !!}</td>
                                    <td>{!! $item->khachmua_ten !!}</td>
                                    <td class="text-center">{!! number_format($item->khachmua_tonno_dk) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachmua_tonco_dk) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachmua_phat_sinh_no) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachmua_phat_sinh_co) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachmua_tonno_ck) !!}</td>
                                    <td class="text-center">{!! number_format($item->khachmua_tonco_ck) !!}</td>
                                    <td class="text-center">

                                    <a href="{!! URL::route('admin.phieuthu.getkhachmua', $item->id ) !!}" 
                                        type="button" class="btn btn-default" 
                                        data-toggle="tooltip" data-placement="left" 
                                        title="Tạo phiếu thu" style="background:#a9d86e">
                                        <i class="fa fa-plus"></i>
                                        </a>
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
@stop
