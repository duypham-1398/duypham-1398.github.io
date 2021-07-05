<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/flatlab/lock_screen.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:47:41 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{asset('public/backends/img/favicon.html')}}">

    <title>Đăng nhập vào hệ thống</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/backends/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/backends/css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('public/backends/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('public/backends/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/backends/css/style-responsive.css')}}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="lock-screen" onload="startTime()">

    <div class="lock-wrapper">

        <div id="time"></div>


        <div class="lock-box text-center" >
            <img src="{{asset('public/add.jpg')}}" alt="lock avatar" style="width: 90px; height: 90px;"/>
            <h1 style="color:red"><b>Đăng nhập vào hệ thống</b></h1>
            <div class="panel-body">
                <form action="{!! URL::route('admin.login.getLogin')!!}" method="post">
                    {{ csrf_field() }}
                <div class="form-group col-lg-12" style="background: #9ac70fb5;">
                    <input type="text"  name="username" value="{!! old('username') !!}" class="form-control "placeholder="Nhập tên người dùng">
                    <div>
                        {!! $errors->first('username') !!}
                    </div> 
                </div>
                <div class="form-group col-lg-12" style="background: #9ac70fb5;">
                    <input  placeholder="Nhập mật khẩu" name="password" type="password" class="form-control "value="" />
                    <div>
                        {!! $errors->first('password') !!}
                    </div> 
                </div>
                <div class="form-group col-lg-12" style="background: #ff0000c9;">
                    <input type="submit" value="Đăng nhập" class="form-control"  name="login">
                </form>
                </div>
                <a href="{{ url('/login') }}"><h1 style="color:black"><u>Quên mật khẩu?</u></h1></a>
        </div>
    </div>
    <script>
        function startTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('time').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
</body>

<!-- Mirrored from thevectorlab.net/flatlab/lock_screen.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:47:41 GMT -->
</html>
