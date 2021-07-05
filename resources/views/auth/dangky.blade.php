@extends('layout')
@section('content')
<div class="register-account ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="register-title">
                    <h3 class="mb-10">Đăng ký tài khoản</h3>
                    <p class="mb-10">Nếu bạn đã có tài khoản, đăng nhập <u><a href="{{ url('/login') }}">Tại đây</a></u>.</p>
                </div>
            </div>
        </div>
        <!-- Row End -->
        <div class="row">
            <div class="col-sm-12">
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
                    <fieldset>
                        <legend>Thông tin cá nhân của bạn</legend>
                        <div class="form-group{{ $errors->has('txtname') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2" for="l-name"><span class="require">*</span>Tên</label>
                            <div class="col-md-10">
                              <input type="text" class="form-control" name="txtname" value="{{ old('txtname') }}"placeholder="Nhập tên">
                                @if ($errors->has('txtname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('txtname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('txtphone') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2" for="number"><span class="require">*</span>Số điện thoại</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="txtphone" value="{{ old('txtphone') }}"placeholder="Số điện thoại">
                                  @if ($errors->has('txtphone'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('txtphone') }}</strong>
                                      </span>
                                  @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('txtadr') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2" ><span class="require">*</span>Địa chỉ</label>
                            <div class="col-md-10">
                            <textarea name="txtadr"  rows="3"class="col-md-12"></textarea>
                              @if ($errors->has('txtadr'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('txtadr') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Thông tin tài khoản</legend>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label class="control-label col-md-2" for="pwd"><span class="require">*</span>Tài khoản</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"placeholder="Tên người dùng">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label class="control-label col-md-2" for="pwd"><span class="require">*</span>E-Mail</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"placeholder="Email đăng nhập">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2" for="pwd"><span class="require">*</span>Mật khẩu:</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2" for="pwd-confirm"><span class="require">*</span>Xác nhận mật khẩu</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận lại mật khẩu">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                    </fieldset>
                    <div class="terms">
                        <div class="float-md-right">
                            <span>Tôi đã đọc và đồng ý với <a href="{{URL::to('chinh-sach-bao-mat')}}" class="agree"><b>Chính sách bảo mật</b></a></span>
                            <input type="checkbox" require> &nbsp;
                            <div class="form-group">
                                  <button type="submit" class="return-customer-btn">
                                      <i class="fa fa-btn fa-user"></i> Đăng kí
                                  </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
@endsection