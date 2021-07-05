@extends('layout')
@section('content')
@include('sweet::alert') 
<div class="log-in ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <!-- New Customer Start -->
            <div class="col-md-6">
                <div class="well mb-sm-30">
                    <div class="new-customer">
                        <h3 class="custom-title">Khách hàng mới</h3>
                        <p class="mtb-10"><strong>Đăng ký</strong></p>
                        <p>Bằng cách tạo tài khoản, bạn sẽ có thể mua sắm nhanh hơn, cập nhật trạng thái của đơn hàng và theo dõi các đơn hàng bạn đã thực hiện trước đó</p>
                        <a class="customer-btn" href="{{ url('/register') }}">Tiếp tục</a>
                    </div>
                </div>
            </div>
            <!-- New Customer End -->
            <!-- Returning Customer Start -->
            <div class="col-md-6">
                <div class="well">
                    <div class="return-customer">
                        <h3 class="mb-10 custom-title">Khách hàng cũ</h3>
                        <p class="mb-10"><strong>Tôi là một khách hàng cũ</strong></p>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                          {!! csrf_field() !!}
                          <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Email <span class="require">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Nhập địa chỉ email của bạn...">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>Mật khẩu <span class="require">*</span></label>
                                <input type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="customer-btn">
                                    <i class="fa fa-btn fa-sign-in"></i> Đăng nhập
                                </button>
                                <button type="button" class="return-customer-btn" data-toggle="modal" data-target="#create-cust">
                                Quên mật khẩu ?
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Returning Customer End -->
        </div>
        <!-- Row End -->
<form class="form-horizontal" method="POST" action="{{URL::to('mat-khau') }}">
    {{ csrf_field() }}
    <div class="modal fade" id="create-cust" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                     <h4 class="modal-title" id="myModalLabel">Nhập email lấy lại mật khẩu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Địa chỉ email</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Nhập địa chỉ email mà bạn đã đăng ký ở đây">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm btn-crnv"><i
                            class="fa fa-check"></i> Gửi link đặt lại mật khẩu
                    </button>
                    <button type="button" class="btn btn-default btn-sm btn-close" data-dismiss="modal"><i
                            class="fa fa-undo"></i> Bỏ qua
                    </button>
            </div>
        </div>
    </div>

</form>
    </div>
    <!-- Container End -->
</div>

@endsection