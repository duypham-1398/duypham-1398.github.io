@extends('layout')
@section('content')
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li class="active">Thanh toán</li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
</section>
<div class="checkout-area pb-100 pt-15 pb-sm-60">
    <div class="container">
    <form action="{!! route('getThanhtoan') !!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="checkbox-form mb-sm-40">
                    <h3>Chi tiết thanh toán
                    </h3>
                    <div class="row">
                    <input type="hidden" name="" value="{!! Auth::user()->id !!}" />
                      <?php 
                        $khachhang = DB::table('khachhang')->where('user_id',Auth::user()->id)->first();
                        // print_r($khachhang);
                      ?>
                      <input type="hidden" name="txtKHID" value="{!! $khachhang->id !!}" />
                        <div class="col-md-6">
                            <div class="checkout-form-list mb-sm-30">
                                <label>Tên <span class="required">*</span></label>
                                <input type="text" name="txtKHName" value="{{ $khachhang->khachhang_ten }}" placeholder="Họ và tên*" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list mb-30">
                                <label>Số điện thoại <span class="required">*</span></label>
                                <input type="text" name="txtKHPhone" value="{{ $khachhang->khachhang_sdt }}"  placeholder="Số điện thoại*" class="col-md-12">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list mb-30">
                                <label>Email<span class="required">*</span></label>
                                <input type="email" name="txtKHEmail" value="{{ $khachhang->khachhang_email }}"  placeholder="Mail*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Địa chỉ <span class="required">*</span></label>
                                <textarea cols="8" rows="3" name="txtKHAddr"  placeholder="Địa chỉ*" class="col-md-12"> {{ $khachhang->khachhang_dia_chi }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <label>Điền thông tin nhận hàng</label>
                                <input id="ship-box" type="checkbox">
                            </h3>
                        </div>
                        <div id="ship-box-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                        <label>Tên<span class="required">*</span></label>
                                        <input type="text" name="txtNNName"  value="{{ $khachhang->khachhang_ten }}"placeholder="Họ và tên*">
                                        <div>
                                            {!! $errors->first('txtNNName') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                        <label>Email<span class="required">*</span></label>
                                        <input type="email" name="txtNNEmail" value="{{ $khachhang->khachhang_email }}"  placeholder="Email*">
                                        <div>
                                            {!! $errors->first('txtNNEmail') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list mb-30">
                                        <label>Số điện thoại<span class="required">*</span></label>
                                        <input type="text" name="txtNNPhone" value="{{ $khachhang->khachhang_sdt }}"  placeholder="Số điện thoại*" >
                                        <div>
                                            {!! $errors->first('txtNNPhone') !!}
                                        </div>
                                    </div>
                                </div>
                          
                                <div class="col-md-12">
                                    <div class="checkout-form-list mb-30">
                                        <label>Địa chỉ<span class="required">*</span></label>
                                        <textarea cols="8" name="txtNNAddr" rows="3" placeholder="Địa chỉ*"class="col-md-12">{{ $khachhang->khachhang_dia_chi }}</textarea>
                                        <div>
                                            {!! $errors->first('txtNNAddr') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Ghi chú</label>
                                        <textarea cols="8" name="txtNNNote"  rows="3" placeholder="Ghi chú"class="col-md-12"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="your-order">
                    <h3>Đơn hàng của bạn</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Sản phẩm</th>
                                    <th class="product-total">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(session('mua'))
                                <?php $total = 0 ?>
                                @foreach(session('mua') as $id => $details)
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
                                    <th>Tổng tiền thanh toán</th>
                                        @if(session('mua'))
                                        <td><span class=" total amount">{{number_format($total)}} VND</span>
                                        @endif
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-body">
                        <input type="submit" value="Hoàn tất mua hàng" class="customer-btn">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@include('sweet::alert')
@endsection