@extends('layout')
@section('content')
@if(isset($data))
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li class="active">Tin tức</li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
@endif
<!-- Breadcrumb End -->
</section>
    <!-- Main Wrapper Start Here -->
    <div class="wrapper">
			@if(isset($data))
        <!-- Blog Page Start Here -->
        <div class="blog ptb-100  ptb-sm-60">
            <div class="container">
                <div class="main-blog">
                    <div class="row">
                        <!-- Single Blog Start -->
                        @foreach($data as $item)
                        <div class="col-lg-6 col-sm-12">
                           <div class="single-latest-blog">
                               <div class="blog-img">
                                   <a href="{!! url('chi-tiet-tin-tuc',$item->vechungtoi_url) !!}"><img src="{!! asset('resources/upload/vechungtoi/'.$item->vechungtoi_anh) !!}" alt="blog-image" style="width: 220px; height: 250px;"></a>
                               </div>
                               <div style="margin-left:15px">
                                   <h4><a href="{!! url('chi-tiet-tin-tuc',$item->vechungtoi_url) !!}">{!! $item->vechungtoi_tieu_de !!}</a></h4>
                                    <ul class="list">
                                        <li>{!! $item->vechungtoi_noi_dung !!}</li>
                                    </ul>
                                    <ul style="margin-top:15px">
                                    <a class="readmore" href="{!! url('chi-tiet-tin-tuc',$item->vechungtoi_url) !!}">Xem thêm</a>
                                    </ul>
                               </div>
                               <div class="blog-date">
                                    <span>{{date('d',strtotime($item->vechungtoi_ngay_tao))}}</span>
                                    {{date('M',strtotime($item->vechungtoi_ngay_tao))}}
                                </div>
                           </div>
                        </div>
                        @endforeach
                        <!-- Single Blog End -->
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </div>
				<!-- Blog Page End Here -->
			@endif
@if(isset($chitiet))
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li><a href="{!! url('tin-tuc') !!}">Tin tức</a></li>
                <li class="active">{!! $chitiet->vechungtoi_tieu_de !!}</li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
        <!-- Single Blog Page Start Here -->
        <div class="single-blog ptb-100  ptb-sm-60" style="margin-top:-90px">
            <div class="container">
                <div class="row">
                    <!-- Single Blog Sidebar Description Start -->
                    <div class="col-lg-12 order-1 order-lg-2">
                        <div class="single-sidebar-desc mb-all-40">
                            <div class="sidebar-post-content">
                                <h3 class="sidebar-lg-title">{{$chitiet->vechungtoi_tieu_de}}</h3>
                                <ul class="post-meta d-sm-inline-flex">
                                    <li><span>Đăng bởi</span>&emsp;KSD</li>
                                    <li><span>{{date('M-d-Y',strtotime($chitiet->vechungtoi_ngay_tao))}}</span></li>
                                </ul>
                            </div>
                            <div class="sidebar-img">
                                <img src="{!! asset('resources/upload/vechungtoi/'.$chitiet->vechungtoi_anh) !!}" alt="single-blog-img" style="width: 1160px; height: 350px;">
                            </div>
                      
                            <div class="sidebar-desc mb-50">
                                <p>{!! $chitiet->vechungtoi_noi_dung !!}</p>
                                <blockquote class="mtb-30"> <p>{!! $chitiet->vechungtoi_tieu_de !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Blog Sidebar Description End -->
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Single Blog Page End Here -->
				
			@endif
    </div>
		<!-- Main Wrapper End Here -->
<script>
$(function(){
    $.fn.limit = function($n){
        this.each(function(){
            var allText   = $(this).html();
            var tLength   = $(this).html().length;
            var startText = allText.slice(0,$n);
            if(tLength >= $n){
                $(this).html(startText+'...');
            }else {
                $(this).html(startText);
            };
        });
        
        return this;
    }
    $('.list li').limit(100);
});
</script>
@endsection