<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:42:50 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="public/backends/img/favicon.html">

    <title>KSD - Công ty cổ phần xây dựng KSD</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/backends/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/backends/css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('public/backends/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backends/assets/advanced-datatable/media/css/demo_page.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backends/assets/advanced-datatable/media/css/demo_table.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/backends/assets/data-tables/DT_bootstrap.css')}}" />
    <link href="{{asset('public/backends/assets/xchart/xcharts.css" rel="stylesheet')}}" />

    <link href="{{asset('public/backends/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{asset('public/backends/css/owl.carousel.css')}}" type="text/css">

      <!--right slidebar-->
      <link href="{{asset('public/backends/css/slidebars.css')}}" rel="stylesheet">
          <!-- Bootstrap Core CSS -->
    <link href="{{ url('public/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('public/backend/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('public/backend/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('public/backend/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{ url('public/backend/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ url('public/backend/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="public/backend/dist/css/mai.css"> -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ek+Mukta">
    <script src="{{ url('public/backend/js/ckeditor/ckeditor.js') }}"></script>

    <!-- Custom styles for this template -->
    <link href="{{asset('public/backends/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/backends/css/style-responsive.css')}}" rel="stylesheet" />
    <script src="{{ url('public/backend/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/templates/js/ajax.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo">K<span>SD</span></a>
            <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/add.jpg')}}" style="width: 30px; height: 30px;">
                            <span class="username">{{Auth::user()->name}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#">{{Auth::user()->email}}</a></br><a href="#" type="button"  data-toggle="modal" data-target="#create-cust"><i class="fa fa-cog"></i>Đổi mật khẩu</a></li>
                            <li><a href="{{url('logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <form class="form-horizontal" method="POST" action="{{URL::to('doi-mat-khau-ad') }}">
                        {{ csrf_field() }}
                        <div class="modal fade" id="create-cust" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Đổi mật khẩu</h4>
                                    </div>
                                    <div class="modal-body form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-3">Mật khẩu cũ</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="password" name="txtOldPass" placeholder="Nhập mật khẩu cũ" required/>
                                            </div>
                                            <div>
                                            {!! $errors->first('txtOldPass') !!}
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="col-md-3">Mật khẩu mới</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="password" name="txtPass" placeholder="Mật khẩu mới" required/>
                                            </div>
                                            <div class="text-center">
                                                {!! $errors->first('txtPass') !!}
                                            </div>   
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3">Nhập lại mật khẩu mới</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="password" name="txtRePass" placeholder="Nhập lại mật khẩu mới" required/>
                                            </div>
                                            <div class="text-center">
                                                {!! $errors->first('txtRePass') !!}
                                            </div>   
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm btn-crnv" ><i
                                                    class="fa fa-check"></i>Lưu
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm btn-close" data-dismiss="modal"><i
                                                    class="fa fa-undo"></i> Bỏ qua
                                            </button>
                                        </div>
                                    </div>
                            </div>
                        </div>

                </form>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="{!! URL('admin-home')!!}">
                          <i class="fa fa-dashboard"></i>
                          <span>Tổng quan</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-laptop"></i>
                          <span>Quản lý hàng hóa</span>
                      </a>
                      <ul class="sub">
                            <li>
                                    <a href="{!! URL::route('admin.sanpham.list') !!}">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.loaisanpham.list') !!}">Loại sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('xemnhom')}}">Nhóm sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('xemdv')}}">Đơn vị tính</a>
                                </li>
                                
                                <li>
                                    <a href="{{URL::to('xemncc')}}">Nhà cung cấp</a>
                                </li>
                                    <li>
                                        <a href="{{URL::to('lohang')}}">Lô hàng</a>
                                    </li>
                                </li>
                                </ul>
                            </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                      <i class="fa fa-users"></i>
                          <span>Quản lý khách hàng</span>
                      </a>
                      <ul class="sub">
                        <li>
                            <a href="{!! URL::route('admin.khachhang.list')!!}">Khách website</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.khachmua.list')!!}">Khách nội bộ</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.thongke.tonghopcongno') !!}">Công nợ khách hàng</a>
                        </li>
                        <!-- <li>
                            <a href="{!! URL::route('admin.thongke.congnongay') !!}">Công nợ khách hàng xem theo ngày</a>
                        </li> -->
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                      <i class="fa fa-file-text"></i>
                          <span>Quản lý bán hàng</span>
                      </a>
                      <ul class="sub">
                        <li>
                            <a href="{!! URL::route('admin.bannoibo.list') !!}"><i class="fa fa-bullhorn"></i>Bán hàng</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.donhang.list')!!}">Đơn đặt hàng</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.donban.list') !!}"></i>Đơn bán hàng</a>
                        </li>
                      </ul>
                  </li>
                        <li>
                            <a href="{!! URL::route('admin.user.list') !!}"><i class="fa fa-user"></i></i>Người dùng</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.nhanvien.list') !!}"><i class="fa fa-user"></i></i>Nhân viên </a>
                        </li>

                        <li>
                       
                        <li>
                            <a href="{!! URL::route('admin.thongke.list') !!}"><i class=" fa fa-barcode"></i>Kho hàng</a>
                        </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Báo cáo, thống kê</span>
                      </a>
                      <ul class="sub">
                        <li>
                            <a href="{!! URL::route('admin.donban.bcchitietdb') !!}">Doanh thu tại cửa hàng</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.donhang.bcchitietdh') !!}">Doanh thu trên website</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.nhaphang.bcchitietnh') !!}">Báo cáo nhập hàng</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.thongke.baocaohethan') !!}">Báo cáo lô hàng hết hạn</a>
                        </li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                        <i class="fa fa-magic"></i>
                          <span>Tin tức</span>
                      </a>
                      <ul class="sub">
                        <li>
                            <a href="{!! URL::route('admin.vechungtoi.list') !!}"></i>Tin tức</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.slider.list') !!}">Slider</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.khuyenmai.list') !!}">Khuyến mại</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('binhluan.danhsach') !!}"><i class="fa fa-comments-o"></i> Bình luận khách hàng</a>
                        </li>
                      </ul>
                  </li>
                  <li>
                    <a href="{{url('logout')}}">
                          <i class="fa fa-user"></i>
                          <span>Đăng xuất</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
@include('sweet::alert')
<section id="main-content">
    <section class="wrapper">
@yield('content')
</section>
</section>
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{asset('public/backends/js/jquery.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery-ui-1.9.2.custom.min.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{asset('public/backends/js/bootstrap.min.js')}}"></script>
    <script class="include" type="text/javascript" src="{{asset('public/backends/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('public/backends/assets/data-tables/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{asset('public/backends/assets/advanced-datatable/media/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{('public/backends/assets/data-tables/DT_bootstrap.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery.sparkline.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/backends/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
    <script src="{{asset('public/backends/js/owl.carousel.js')}}" ></script>
    <script src="{{asset('public/backends/js/jquery.customSelect.min.js')}}" ></script>
    <script src="{{asset('public/backends/js/respond.min.js')}}" ></script>
    <script src="{{asset('public/backends/assets/xchart/d3.v3.min.js')}}"></script>
    <script src="{{asset('public/backends/assets/xchart/xcharts.min.js')}}"></script>

    <!--right slidebar-->
    <script src="{{asset('public/backends/js/slidebars.min.js')}}"></script>
    <script src="{{asset('public/backends/js/dynamic_table_init.js')}}"></script>
    <!--common script for all pages-->
    <script src="{{asset('public/backends/js/common-scripts.js')}}"></script>
    <script src="{{asset('public/backends/js/editable-table.js')}}"></script>

    <!--script for this page-->
    <script src="{{asset('public/backends/js/sparkline-chart.js')}}"></script>
    <script src="{{asset('public/backends/js/easy-pie-chart.js')}}"></script>
    <script src="{{asset('public/backends/js/count.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('public/backend/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Chart js -->
    <script src="{{ url('public/backend/bower_components/Chart.js-1.1.1/Chart.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('public/backend/dist/js/sb-admin-2.js') }}"></script>

    <script src="{{ url('public/backend/js/myscript.js') }}"></script>

  <script>
      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

      //custom select box

        $(function(){
            $('select.styled').customSelect();
            });
            jQuery(document).ready(function() {
            EditableTable.init();
            });
        
  </script>
  </body>

<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:43:32 GMT -->
</html>
