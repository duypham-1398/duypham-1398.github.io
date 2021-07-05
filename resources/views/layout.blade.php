<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>KSD || Công ty cổ phần xây dựng KSD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{asset('')}}">
    <!-- Favicons -->
    <link rel="shortcut icon" href="resources/upload/sanpham/logojoton.png">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <!-- Ionicons css -->
    <link rel="stylesheet" href="public/css/ionicons.min.css">
    <!-- linearicons css -->
    <link rel="stylesheet" href="public/css/linearicons.css">
    <!-- Nice select css -->
    <link rel="stylesheet" href="public/css/nice-select.css">
    <!-- Jquery fancybox css -->
    <link rel="stylesheet" href="public/css/jquery.fancybox.css">
    <!-- Jquery ui price slider css -->
    <link rel="stylesheet" href="public/css/jquery-ui.min.css">
    <!-- Meanmenu css -->
    <link rel="stylesheet" href="public/css/meanmenu.min.css">
    <!-- Nivo slider css -->
    <link rel="stylesheet" href="public/css/nivo-slider.css">
    <!-- Owl carousel css -->
    <link rel="stylesheet" href="public/css/owl.carousel.min.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="public/css/default.css">
    <!-- Main css -->
    <link rel="stylesheet" href="public/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="public/css/responsive.css">
    <!-- Store CSRF token for AJAX calls -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Modernizer js -->
    <script src="public/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>

<body>
        <header>
        <div class="header-top-area">
                <div class="container">
                    <!-- Header Top Start -->
                    <div class="header-top">
                        <ul>
                            <li><a href="#">Công ty cổ phần xây dựng KSD</a></li>
                            <li><a href="{{URL::to('gio-hang')}}">Giỏ</a></li>
                            <li> @if (Auth::check())
                            <a href="{!! URL::route('getThanhtoan') !!}" class="aa-cart-view-btn">Thanh Toán</a>
                            @else
                                <a href="{!! url('login') !!}" class="aa-cart-view-btn">Thanh Toán</a>
                            @endif
                            </li>
                        </ul>
                        <ul>                                          
                            <li><a href="#">Tài khoản của tôi<i class="lnr lnr-chevron-down"></i></a>
                                <!-- Dropdown Start -->
                                <ul class="ht-dropdown">
                                @if (Auth::check())
                            <li><a href="#">{{ Auth::user()->name }}<i class="lnr lnr-chevron-down"></i></a>
                                <!-- Dropdown Start -->
                                <ul class="ht-dropdown">
                                    <li><a href="{{ url('/logout') }}">Đăng xuất</a></li>
                                    <li> <button type="button" class="return-customer-btn" data-toggle="modal" data-target="#create-cust">
                                        Đổi mật khẩu ?
                                        </button></li>
                                </ul>
                                <!-- Dropdown End -->
                            </li> 
                            @else
                            <li><a href="#">Tài khoản<i class="lnr lnr-chevron-down"></i></a>
                                <!-- Dropdown Start -->
                                <ul class="ht-dropdown">
                                    <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
                                    <li><a href="{{ url('/register') }}">Đăng ký</a></li>
                                </ul>
                                <!-- Dropdown End -->
                            </li> 
                            @endif
                                </ul>
                                <!-- Dropdown End -->
                            </li> 
                        </ul>
                    </div>
                    <!-- Header Top End -->
                </div>
                <!-- Container End -->
            </div>
            <div class="header-middle ptb-15" style="border-bottom: 1px solid #d8d0d0;">
                <div class="container">
                    <div class="row align-items-center no-gutters">
                        <div class="col-lg-3 col-md-12">
                            <div class="logo mb-all-30">
                                <a href="#"><img src="public/img/Untitled.png" alt="logo-image" height="100px"></a>
                            </div>
                        </div>
                        <!-- Categorie Search Box Start Here -->
                        <div class="col-lg-4 col-md-8 ml-auto mr-auto col-10">
                            <div class="categorie-search-box">
                                <form action="{!! route('getTimkiem') !!}" method="POST">
                                    {{csrf_field()}}
                                <div class="search_box pull-right">
                                    <input type="text" name="timkiem" placeholder="Tìm kiếm"/>
                                    <button><i class="lnr lnr-magnifier"></i></button>

                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- Categorie Search Box End Here -->
                        <!-- Cart Box Start Here -->
                        <div class="col-lg-4 col-md-12">
                            <div class="cart-box mt-all-30">
                                <ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
                                    <li><a href="{{URL::to('gio-hang')}}"><i class="lnr lnr-cart"></i><span class="my-cart">
                                    @if(session('mua'))
                                    <span class="total-pro">{{ count((array) session('mua')) }}</span>
                                    @else
                                    <span class="total-pro">0</span>
                                    @endif
                                    <span>Giỏ</span></span></a>
                                    </li>
                                    <li><a href="{{URL::to('wishlist')}}"><i class="lnr lnr-heart"></i><span class="my-cart"><span>Yêu</span><span>thích ({{ Cart::instance('wishlist')->count(false) }})</span></span></a>
                                    </li>
                                    <li><img src="public/img/ksd.png" alt="logo-image" height="100px">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Cart Box End Here -->
                    </div>
                    <!-- Row End -->
                    <form class="form-horizontal" method="POST" action="{{URL::to('doi-mat-khau') }}">
                        {{ csrf_field() }}
                        <div class="modal fade" id="create-cust" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Đổi mật khẩu</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="form-group" style="margin-top:15px">
                                            <label class="col-md-4"><b>Mật khẩu cũ</b></label>
                                            <div class="col-md-12">
                                            <input class="form-control"  type="password" name="txtOldPass" placeholder="Nhập mật khẩu cũ" required/>
                                            </div>
                                        <div>
                                            {!! $errors->first('txtOldPass') !!}
                                        </div>  
                                    </div>
                                    <div class="form-group"style="margin-top:15px">
                                        <label class="col-md-4 control-label"><b>Mật khẩu mới</b></label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="password" name="txtPass" placeholder="Mật khẩu  mới" required/>
                                        </div>
                                        <div>
                                            {!! $errors->first('txtPass') !!}
                                        </div>   
                                    </div>
                                    <div class="form-group"style="margin-top:15px">
                                        <label class="col-md-12 control-label"><b>Nhập lại mật khẩu mới</b></label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="password" name="txtRePass" placeholder="Nhập lại mật khẩu mới" required/>
                                        </div>
                                        <div>
                                            {!! $errors->first('txtRePass') !!}
                                        </div>   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-sm btn-crnv"><i
                                                class="fa fa-check"></i>Lưu
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
            <!-- Header Bottom Start Here -->
           @include('pages.inclu.mnngang')
            <!-- Header Bottom End Here -->
        </header>
        <!-- Main Header Area End Here -->
        <!-- Categorie Menu & Slider Area Start Here -->
        <div class="main-page-banner home-3">
            <div class="container">
                <div class="row">
                    <!-- Vertical Menu Start Here -->
                    @include('pages.inclu.menu')
                    <!-- Vertical Menu End Here -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->           
        </div>
        <!-- Categorie Menu & Slider Area End Here -->
        @yield('content')
        <!-- Footer Area Start Here -->
        @include('pages.inclu.footer')
        <!-- Footer Area End Here -->
    </div>
    <!-- Main Wrapper End Here -->
    <!-- Countdown js -->
    <script src="public/js/jquery.countdown.min.js"></script>
    <!-- Mobile menu js -->
    <script src="public/js/jquery.meanmenu.min.js"></script>
    <!-- ScrollUp js -->
    <script src="public/js/jquery.scrollUp.js"></script>
    <!-- Nivo slider js -->
    <script src="public/js/jquery.nivo.slider.js"></script>
    <!-- Fancybox js -->
    <script src="public/js/jquery.fancybox.min.js"></script>
    <!-- Jquery nice select js -->
    <script src="public/js/jquery.nice-select.min.js"></script>
    <!-- Jquery ui price slider js -->
    <script src="public/js/jquery-ui.min.js"></script>
    <!-- Owl carousel -->
    <script src="public/js/owl.carousel.min.js"></script>
    <!-- Bootstrap popper js -->
    <script src="public/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="public/js/bootstrap.min.js"></script>
    <!-- Plugin js -->
    <script src="public/js/plugins.js"></script>
    <!-- Main activaion js -->
    <script src="public/js/main.js"></script>
    <!-- <script src="public/js/myscript.js"></script> -->
    
</body>

</html>