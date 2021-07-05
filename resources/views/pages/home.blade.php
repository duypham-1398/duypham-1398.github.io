@extends('layout')
@section('content')
<div class="wrapper">
    <!-- Banner Popup Start -->
    <div class="popup_banner" style="background:#87d695">
        <span class="popup_off_banner" style="color:red">×</span>
        <div class="banner_popup_area">
                <img src="public/img/banner/jotonson.png" alt="">
        </div>
    </div>
    <!-- Banner Popup End -->  
</div>
<!-- Shop Page Start -->
<div class="main-shop-page pt-100 pb-100 ptb-sm-60">
    <div class="container">
        <!-- Row End -->
        <div class="row">
            <!-- Sidebar Shopping Option Start -->
            @include('pages.inclu.banchay')
            <!-- Sidebar Shopping Option End -->
            <!-- Product Categorie List Start -->
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="main-categorie mb-all-40">
                    <!-- Grid & List Main Area End -->
                    <div class="tab-content fix">
                        <div id="grid-view" class="tab-pane fade show active">
                            <div class="row">
                            @foreach ($sanpham as $item)
                                <?php 
                                $sanphamkhuyenmai = DB::select('select* from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1');
                                ?>
                                <!-- Single Product Start -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a class="aa-product-img" href="{!! url('chi-tiet-san-pham',$item->sanpham_url) !!}"><img src="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}"  style="width: 250px; height: 300px;" title="xem chi tiết sản phẩm"></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{!! url('san-pham',$item->sanpham_url) !!}">{!! $item->sanpham_ten !!}</a></h4>
                                                @if(!is_null($khuyenmai))
                                                @if($item->sanpham_khuyenmai == 1)
                                                <?php 
                                                    $tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 '); 
                                                    $giakm = ($item->sanpham_gia_ban - ($tylegia[0]->khuyenmai_phan_tram*$item->sanpham_gia_ban * 0.01));
                                                    $tyle = $tylegia[0]->khuyenmai_phan_tram;
                                                    ?> 
                                                    <p><span class="price">{!! number_format($giakm,0,",",".") !!} vnđ</span><del class="prev-price">{!! number_format("$item->sanpham_gia_ban",0,",",".") !!} vnđ</del></p>
                                                    <div class="label-product l_sale">{{$tyle}}<span class="symbol-percent">%</span></div>
                                                    @endif
                                                    @else
                                                    <span class="price">
                                                    {!! number_format("$item->sanpham_gia_ban",0,",",".") !!} vnđ
                                                    </span>                                                  
                                                    @endif   
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="{!! url('mua-hang',[$item->id,$item->sanpham_url]) !!}" title="Thêm vào giỏ hàng"> + Thêm vào giỏ hàng</a>
                                                </div>
                                                <div class="actions-secondary">

                                                    <a href="{!! url('switchToWishlist',$item->id) !!}" title="Yêu thích"><i class="lnr lnr-heart"></i> <span>Thêm vào yêu thích</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                </div>
                                <!-- Single Product End -->
                            
                            @endforeach
                        </div>
                            <!-- Row End -->
                        </div>                          
                        <!-- Product Pagination Info -->
                        @include('pages.inclu.phantrang')
                    </div>
                    <!-- Grid & List Main Area End -->
                </div>
            </div>
            <!-- product Categorie List End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
@include('sweet::alert')
<!-- Shop Page End -->
@endsection