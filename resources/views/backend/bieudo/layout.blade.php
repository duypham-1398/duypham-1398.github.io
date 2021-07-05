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
    <link href="{{asset('public/backends/css/jquery.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('public/backends/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('public/backends/css/bootstrap-datepicker.css')}}" rel="stylesheet"> -->
    <!--external css-->
    <link href="{{asset('public/backends/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/backends/css/owl.carousel.css')}}" type="text/css">

      <!--right slidebar-->
      <link href="{{asset('public/backends/css/slidebars.css')}}" rel="stylesheet">
          <!-- Bootstrap Core CSS -->
    
    <!-- Custom CSS -->
    <link href="{{ url('public/backend/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('public/backends/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/backends/css/style-responsive.css')}}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
    $( function() {
        $( "#datepicker" ).datepicker();
    } );
    </script>
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
                            <a href="{!! URL::route('binhluan.danhsach') !!}"><i class="fa fa-comments-o"></i>Bình luận khách hàng</a>
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
@yield('content')

  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{asset('public/backends/js/jquery.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery-ui-1.9.2.custom.min.js')}}"></script>
    <script src="{{asset('public/backends/js/bootstrap.min.js')}}"></script>
    <script class="include" type="text/javascript" src="{{asset('public/backends/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/backends/js/owl.carousel.js')}}" ></script>

    <script src="{{asset('public/backends/js/common-scripts.js')}}"></script>
    <script src="{{asset('public/backends/js/jquery.datetimepicker.full.js')}}"></script>
    <!-- <script src="{{asset('public/backends/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('public/backends/js/bootstrap-datepicker.vi.min.js')}}"></script> -->
    <script src="{{ url('public/backend/js/myscript.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
/////////////////////////////
    $('.datepick').datetimepicker();
    Highcharts.chart('abc', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        exporting: {
            buttons: {
                contextButton: {
                    enabled: false
                }
            }
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Hàng bán chạy'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Số lượng bán',
            data: [
                @foreach($bdban as $sp)['{{$sp->sanpham_ten}}', {{$sp->soluong }}],
                @endforeach
            ]
        }]
    });
    Highcharts.chart('duong', {
        chart: {
            zoomType: 'xy'
        },
        exporting: {
            buttons: {
                contextButton: {
                    enabled: false
                }
            }
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Doanh thu bán hàng trên website'
        },
        subtitle: {
            text: ''
        },
        xAxis: [{

            categories: [@foreach($hoadon as $hd)
                '{{$hd->donhang_ngay_ban}}',
                @endforeach
                ],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            // tickAmount: 1,
            labels: {
                format: '{value} đơn',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Số đơn',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            // tickAmount: 4,
            title: {
                text: 'Tổng tiền',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value} VND',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],

        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || // theme
                'rgba(255,255,255,0.25)'
        },
        series: [{
            name: 'Tổng tiền',
            type: 'column',
            yAxis: 1,
            data: [@foreach($hoadon as $hd) {{$hd->DT}},
                @endforeach
            ],
            tooltip: {
                valueSuffix: ' VNĐ'
            }

        }, {
            name: 'Đơn hàng',
            type: 'spline',
            data: [
                @foreach($hoadon as $hd) {{$hd->SD}},
                @endforeach
            ],
            tooltip: {
                valueSuffix: ' Đơn'
            }
        }]
    });
    Highcharts.chart('noibo', {
        chart: {
            zoomType: 'xy'
        },
        exporting: {
            buttons: {
                contextButton: {
                    enabled: false
                }
            }
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Doanh thu bán hàng tại cửa hàng'
        },
        subtitle: {
            text: ''
        },
        xAxis: [{

            categories: [@foreach($hoadnban as $hd)
                '{{$hd->donban_ngay_ban}}',
                @endforeach
                ],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            // tickAmount: 1,
            labels: {
                format: '{value} đơn',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Số đơn',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            // tickAmount: 4,
            title: {
                text: 'Tổng tiền',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value} VND',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],

        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || // theme
                'rgba(255,255,255,0.25)'
        },
        series: [{
            name: 'Tổng tiền',
            type: 'column',
            yAxis: 1,
            data: [@foreach($hoadnban as $hd) {{$hd->DT}},
                @endforeach
            ],
            tooltip: {
                valueSuffix: ' VNĐ'
            }

        }, {
            name: 'Đơn bán',
            type: 'spline',
            data: [
                @foreach($hoadnban as $hd) {{$hd->SD}},
                @endforeach
            ],
            tooltip: {
                valueSuffix: ' Đơn'
            }
        }]
    });
    
    $('.kqtuden').click(function(){
    $('#duong').html('');
    $.get('{{url('theongayindex')}}', {tu: $('#date_1web').val(), den: $('#date_2web').val()}, function(data){
        var dt = [];
        var don = [];
        var ngayban = [];
        data.result.forEach(function(e){
            dt.push(e.DT);
            don.push(e.SD);
            ngayban.push(e.donhang_ngay_ban);
        })
        Highcharts.chart('duong', {
    chart: {
        zoomType: 'xy'
    },
    exporting: {
        buttons: {
            contextButton: {
                enabled: false
            }
        }
    },
    credits: {
        enabled: false
    },
    title: {
        text: 'Doanh thu bán hàng trên website'
    },
    subtitle: {
        text: ''
    },
    xAxis: [{

        categories: ngayban,
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        // tickAmount: 1,
        labels: {
            format: '{value} đơn',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Số đơn',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        // tickAmount: 4,
        title: {
            text: 'Tổng tiền',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value} VND',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],

    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || // theme
            'rgba(255,255,255,0.25)'
    },
    series: [{
        name: 'Tổng tiền',
        type: 'column',
        yAxis: 1,
        data:dt,
        tooltip: {
            valueSuffix: ' VNĐ'
        }

    }, {
        name: 'Đơn hàng',
        type: 'spline',
        data: don,
        tooltip: {
            valueSuffix: ' Đơn'
        }
    }]
});
    })
    $('#noibo').html('');
    $.get('{{url('theongaynoibo')}}', {tu: $('#date_noibo1').val(), den: $('#date_noibo2').val()}, function(data){
        var dt = [];
        var don = [];
        var ngayban = [];
        data.result.forEach(function(e){
            dt.push(e.DT);
            don.push(e.SD);
            ngayban.push(e.donban_ngay_ban);
        })
        Highcharts.chart('noibo', {
    chart: {
        zoomType: 'xy'
    },
    exporting: {
        buttons: {
            contextButton: {
                enabled: false
            }
        }
    },
    credits: {
        enabled: false
    },
    title: {
        text: 'Doanh thu bán hàng tại cửa hàng'
    },
    subtitle: {
        text: ''
    },
    xAxis: [{

        categories: ngayban,
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        // tickAmount: 1,
        labels: {
            format: '{value} đơn',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Số đơn',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        // tickAmount: 4,
        title: {
            text: 'Tổng tiền',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value} VND',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],

    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || // theme
            'rgba(255,255,255,0.25)'
    },
    series: [{
        name: 'Tổng tiền',
        type: 'column',
        yAxis: 1,
        data:dt,
        tooltip: {
            valueSuffix: ' VNĐ'
        }

    }, {
        name: 'Đơn bán',
        type: 'spline',
        data: don,
        tooltip: {
            valueSuffix: ' Đơn'
        }
    }]
});
    })
    
})
</script>

  </body>

<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:43:32 GMT -->
</html>
