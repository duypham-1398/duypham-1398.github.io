@extends('layout')
@section('content')
        <!-- Main Header Area End Here -->
        
        <!-- Categorie Menu & Slider Area Start Here -->
        <div class="main-page-banner black-bg2 home-3">
            <!-- Slider Area Start Here -->
            <div class="slider_box">
                <div class="slider-wrapper theme-default">
                    <!-- Slider Background  Image Start-->
                    <div id="slider" class="nivoSlider ">
                    @foreach($slider as $item)
                    <div id="slider" class="nivoSlider">
                        <a href="shop.html"><img style="width: 200px; height: 560px;" src="{!! asset('resources/upload/slider/'.$item->slider_anh) !!}" data-thumb="{!! asset('resources/upload/slider/'.$item->slider_anh) !!}" alt="" title="#htmlcaption"  /></a>
                        
                    </div>
                    @endforeach
                    </div>
                    <!-- Slider Background  Image Start-->
                </div>
            </div>
            <!-- Slider Area End Here -->            
        </div>
        <!-- Categorie Menu & Slider Area End Here -->
        @if (!is_null($khuyenmai))
        <!-- Hot Deal Products Start Here -->
        <div class="hot-deal-products">
            <div class="container">
                <div class="all-border">
                    <!-- Product Title Start -->
                    <div class="section-ttitle mb-30">
                        <h2>Siêu khuyến mãi</h2>
                    </div>
                    <!-- Product Title End -->
                    <!-- Hot Deal Product Activation Start -->
                    <div class="hot-deal-active3 owl-carousel">
                    @foreach ($sanpham as $item)
                        @if (!is_null($khuyenmai))
                        @if($item->sanpham_khuyenmai==1)
                        <div class="row">
                            <!-- Main Thumbnail Image Start -->
                            <div class="col-lg-6 mb-all-40 hot-product2 center" >
                                <!-- Thumbnail Large Image start -->
                                <div class="tab-content">
                                    <div id="thumb1" class="tab-pane fade show active">
                                        <a data-fancybox="images" href="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}"><img src="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}" style="width: 250px; height: 300px;" alt="product-view"></a>
                                        
                                    </div>
                                    
                                </div>
                                <!-- Thumbnail Large Image End -->
                            </div>
                            <!-- Main Thumbnail Image End -->
                            <!-- Thumbnail Description Start -->
                            <div class="col-lg-6 hot-product2">
                                <div class="thubnail-desc fix">
                                @if (!is_null($khuyenmai))
                                    <?php 
                                        $ngaybd =  date("Y-m-d", strtotime("$khuyenmai->created_at")); // Năm/Tháng/Ngày
                                        $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $khuyenmai->khuyenmai_thoi_gian  day"));
                                    ?>
                                    <div class="countdown" data-countdown="{{date('Y-m-d',strtotime($ngaykt))}}"></div>
                                @endif
                                    <h3><a href="{!! url('chi-tiet-san-pham',$item->sanpham_url) !!}">{{$item->sanpham_ten}}</a></h3>
                                    <div class="pro-price mtb-30">
                                    <?php 
                                    $tyle = $khuyenmai->khuyenmai_phan_tram*0.01;
                                    $phantram = $khuyenmai->khuyenmai_phan_tram;
                                    $giakm = ($item->sanpham_gia_ban - ($item->sanpham_gia_ban * $tyle));
                                    ?> 
                                        <p><span class="price">{!! number_format($giakm,0,",",".") !!} vnđ</span><del class="prev-price">{!! number_format("$item->sanpham_gia_ban",0,",",".") !!} vnđ</del></p>
                                        <div class="label-product l_sale">{{$phantram}}<span class="symbol-percent">%</span></div>
                                    </div>
                                    <!-- <p class="mb-30 pro-desc-details">{!! $item->sanpham_mo_ta !!}</p> -->
                                    <div class="pro-actions"  style="margin-top:50px">
                                        <div class="actions-primary">
                                            <a href="{!! url('mua-hang',[$item->id,$item->sanpham_url]) !!}" title="Add to Cart"> + Thêm vào giỏ</a>
                                        </div>
                                        <div class="actions-secondary">
                                            <a href="{!! url('switchToWishlist',$item->id) !!}" title="Yêu thích"><i class="lnr lnr-heart"></i> <span>Thêm vào yêu thích</span></a>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                            <!-- Thumbnail Description End -->                        
                        </div>
                        @endif
                        @endif
                    @endforeach
                    </div>
                    <!-- Hot Deal Product Active End -->
                </div>
            </div>
        </div>
            <!-- Hot Deal Products End Here --> 
        @endif
</div>
        <!-- Trending Products End Here -->
        <div class="trendig-product pb-10 off-white-bg"  style="margin-top:50px">
            <div class="container">        &emsp;
                &emsp;
            <h1 class="section-ttitle2 mb-30" >Khám phá sản phẩm</h1>
            @foreach($nhom as $nhom)
            <?php 
            $hihi = DB::table('loaisanpham')->join('sanpham','sanpham.loaisanpham_id','=','loaisanpham.id')
            ->select('sanpham.sanpham_url','sanpham.sanpham_anh','sanpham.sanpham_gia_ban','sanpham.sanpham_mo_ta','sanpham.sanpham_khuyenmai','sanpham.sanpham_ten','sanpham.id')
            ->where('nhom_id',$nhom->id)->get();
            ?>
                <div class="trending-box">
                <div class="title-box">
                    <h2>{!! $nhom->nhom_ten !!}</h2>
                </div>
              
                <div class="product-list-box">
                    <!-- Arrivals Product Activation Start Here -->
                    <div class="trending-pro-active owl-carousel">
                    @foreach($hihi as $hihi)
                        <!-- Single Product Start -->
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a class="aa-product-img" href="{!! url('chi-tiet-san-pham',$hihi->sanpham_url) !!}"><img src="{!! asset('resources/upload/sanpham/'.$hihi->sanpham_anh) !!}"  style="width: 200px; height: 230px;" title="xem chi tiết sản phẩm"></a>
                            </div>
                            <!-- Product Image End -->
                                  <!-- Product Content Start -->
                    <div class="pro-content">
                        <div class="pro-info">
                            <h4><a href="{!! url('chi-tiet-san-pham',$hihi->sanpham_url) !!}">{!! $hihi->sanpham_ten !!}</a></h4>
                            @if (!is_null($khuyenmai))
                            @if($hihi->sanpham_khuyenmai == 1)
                            <?php 
                                $tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
                                $giakm = ($hihi->sanpham_gia_ban - ($tylegia[0]->khuyenmai_phan_tram*$hihi->sanpham_gia_ban * 0.01));
                                $tyle = $tylegia[0]->khuyenmai_phan_tram;
                                ?> 
                                <p><span class="price">{!! number_format($giakm,0,",",".") !!} vnđ</span><del class="prev-price">{!! number_format("$hihi->sanpham_gia_ban",0,",",".") !!} vnđ</del></p>
                                <div class="label-product l_sale">{{$tyle}}<span class="symbol-percent">%</span></div>
                                @endif
                                @else
                                <span class="price">
                            {!! number_format("$hihi->sanpham_gia_ban",0,",",".") !!} vnđ
                            </span>
                            @endif
                        </div>
                        <div class="pro-actions">
                            <div class="actions-primary">
                                <a href="{!! url('mua-hang',[$hihi->id,$hihi->sanpham_url]) !!}" title="Thêm vào giỏ hàng"> + Thêm vào giỏ hàng</a>
                            </div>
                            <div class="actions-secondary">
                                <a href="{!! url('switchToWishlist',$hihi->id) !!}" title="Yêu thích"><i class="lnr lnr-heart"></i> <span>Thêm vào yêu thích</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- Product Content End -->
                        </div>
                        <!-- Single Product End -->
                        @endforeach
                    </div>
                    <!-- Arrivals Product Activation End Here -->                    
                </div>
                <!-- main-product-tab-area-->
                </div>       
                 @endforeach
            </div>
            <!-- Container End -->
        </div>
        <!-- Trending Products End Here -->

</div>
        <!-- Latest Blog Area Start Here -->
        <div class="blog-area ptb-95 off-white-bg ptb-sm-55">
            <div class="container">
                <div class="like-product-area"> 
                    <h2 class="section-ttitle2 mb-30">Tin tức</h2>
               <!-- Latest Blog Active Start Here -->
               <div class="latest-blog-active owl-carousel">
                   <!-- Single Blog Start -->
                   @foreach($tintuc as $tintuc)
                   <div class="single-latest-blog">
                       <div class="blog-img">
                           <a href="single-blog.html"><img src="{!! asset('resources/upload/vechungtoi/'.$tintuc->vechungtoi_anh) !!}" style="width: 220px; height: 150px;" alt="blog-image"></a>
                       </div>
                       <div class="blog-desc">
                            <h4><a href="single-blog.html">{!! $tintuc->vechungtoi_tieu_de !!}</a></h4>
                            <ul class="list">
                                <li><a href="#">{!! $tintuc->vechungtoi_noi_dung !!}</a></li>
                            </ul>
                            <a  class="readmore" href="{!! url('chi-tiet-tin-tuc',$tintuc->vechungtoi_url) !!}">Xem thêm</a>
                       </div>
                       <div class="blog-date">
                            <span>{{date('d',strtotime($tintuc->vechungtoi_ngay_tao))}}</span>
                            {{date('M',strtotime($tintuc->vechungtoi_ngay_tao))}}
                        </div>
                   </div>
                   <!-- Single Blog End -->
                   @endforeach
               </div>
               <!-- Latest Blog Active End Here -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Latest Blog s Area End Here -->   
        @include('sweet::alert')
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
    $('.list li').limit(30);
});
</script>
@endsection