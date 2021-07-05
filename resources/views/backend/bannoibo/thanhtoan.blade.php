@extends('backend.layout')
@section('content')

        <form role="form" method="post" action="{{URL::to('thanh-toan-don-ban')}}">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-12">
                <!-- <section class="panel"> -->
                    <div class="col-lg-6 col-md-6" style="background:white;">
                        <div class="checkbox-form mb-sm-40" >
                            <h3>Thông tin khách hàng</h3><hr/>
                            <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="input" >Chọn khách mua hàng</label>
                                    <div>
                                        <select id="input" name="txtKHID"  class="form-control">
                                            <option value="">--Chọn khách hàng--</option>
                                            @foreach($khachmua as $cs)
                                                <option value="{{$cs->id}}">{{$cs->khachmua_ten}}- sdt: {{$cs->khachmua_sdt}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div>
                                        {!! $errors->first('txtKHID') !!}
                                    </div>                            
                                </div> 
                            </div>
                            <div class="col-md-3">
                            <div class="col-lg-4">
                                
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-sm-30">
                                    <button type="button" data-toggle="modal" data-target="#create-khm" class="btn btn-primary"> +KH Mới</button>
                                    </div>
                                </div>
                            </div>
                        </div><hr />
                        <div class="checkbox-form mb-sm-40">
                            <h3>Điền thông tin nhận hàng</h3><hr />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-sm-30">
                                        <label>Tên<span class="required">*</span></label>
                                        <input type="text" name="txtNNName"   class="form-control"placeholder="Họ và tên*">
                                        <div>
                                            {!! $errors->first('txtNNName') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                    <label>Email<span class="required">*</span></label>
                                        <input type="email" name="txtNNEmail"  class="form-control" placeholder="Email*">
                                        <div>
                                            {!! $errors->first('txtNNEmail') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                    <label>Số điện thoại<span class="required">*</span></label>
                                        <input type="text" name="txtNNPhone"  class="form-control" placeholder="Số điện thoại*" >
                                        <div>
                                            {!! $errors->first('txtNNPhone') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                    <label>Địa chỉ<span class="required">*</span></label>
                                    <textarea cols="8" name="txtNNAddr"  class="form-control"rows="3" placeholder="Địa chỉ*"class="col-md-12"></textarea>
                                    <div>
                                        {!! $errors->first('txtNNAddr') !!}
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:10px">
                                    <div class="checkout-form-list mtb-30">
                                    <label>Ghi chú</label>
                                        <textarea cols="8" name="txtNNNote" class="form-control rows="3" placeholder="Ghi chú"class="col-md-12"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <section class="panel">
                            <div class="panel panel-success" >
                                <header class="panel-heading">
                                   <h3> Đơn hàng</h3>
                                </header>  
                            </div>
                            <div class="table table-striped table-bordered table-hover">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr class="panel panel-success">
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(session('ban'))
                                    <?php $total = 0 ?>
                                        @foreach(session('ban') as $id => $details)
                                        <?php $total += $details['price'] * $details['quantity'] ?>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                            {{ $details['name'] }}<span class="product-quantity"> × {{ $details['quantity'] }}</span>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount">{{ number_format($details['price'] * $details['quantity']) }} VND</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                        <tr class="order-total">
                                            <th>Tổng hóa đơn bán</th>
                                            @if(session('ban'))
                                            <td><span class=" total amount">{{number_format($total)}} VND</span>
                                            @endif
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <section class="panel">
                            <div class="panel panel-success" >
                                <header class="panel-heading">
                                    <h4> Thu tiền</h4>
                                </header>  
                            </div>
                            <div class="panel-body">
                                <div class="modal-body form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <label>Tiền thu từ khách</label>
                                            </div>
                                            <div class="col-sm-9">
                                                @if(session('ban'))
                                                <input type="text" name="tienthu" class="form-control" value="{{$total}}"
                                                    placeholder="Nhập số tiền thu từ khách">
                                                <span style="color: red; font-style: italic;" class="error error-manv"></span>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <label >Lý do thu tiền</label>
                                            </div>
                                            <div class="col-sm-9">
                                            <select  name="lydo"  class="form-control">
                                                <option value="">--Chọn lý do thu--</option>
                                                @foreach($lydo as $ld)
                                                    <option value="{{$ld->id}}">{{$ld->mo_ta}}</option>
                                                @endforeach 
                                            </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <input type="submit" value="Hoàn tất đơn hàng" class="btn btn-primary active">
                            </div>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
            </div>
        </div>
    <form role="form" method="post" action="{{URL::to('them-khach-mua')}}">
      {{ csrf_field() }}
        <div class="modal fade" id="create-khm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        </form>
@endsection