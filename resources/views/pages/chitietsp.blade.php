@extends('layout')
@section('content')
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li><a href="{!! url('nhom-thuc-pham',$nhom->nhom_url) !!}">{!! $nhom->nhom_ten !!}</a></li>
                <li><a href="{!! url('loai-san-pham',$loaisanpham->loaisanpham_url) !!}">{!! $loaisanpham->loaisanpham_ten !!}</a></li>    
                <li class="active">{!! $sanpham->sanpham_ten !!}</li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
</section>
<!-- Product Thumbnail Start -->
<div class="main-product-thumbnail ptb-100 ptb-sm-60">
    <div class="container">
        <div class="thumb-bg">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5 mb-all-40">
                    <!-- Thumbnail Large Image start --> 
                    <div class="tab-content">  
                        <div id="thumb1" class="tab-pane fade show active">
                        <a href="{!! asset('resources/upload/sanpham/'.$sanpham->sanpham_anh) !!}" data-fancybox="images" title="Nhấn để phóng to ">
                        <img src="{!! asset('resources/upload/sanpham/'.$sanpham->sanpham_anh) !!}" style="width: 300px; height: 350px;" alt="product-view"></a> 
                        </div>
                    </div>
                    <!-- Thumbnail Large Image End -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7">
                    <div class="thubnail-desc fix">
                        <h3 class="product-header">{!! $sanpham->sanpham_ten !!}</h3>
                        <div class="rating-summary fix mtb-10">
                            <div class="rating-feedback">
                              <p>Loại sản phẩm: 
                                <a href="{!! url('loai-san-pham',$loaisanpham->loaisanpham_url) !!}">{!! $sanpham->loaisanpham_ten !!}</a></p>
                            </div>
                        </div>
                        <div class="pro-price mtb-30">
                                <p class="d-flex align-items-center"><span class="price">{!! number_format("$sanpham->sanpham_gia_ban",0,",",".") !!}vnđ</span></p>
                        </div>
                        <p class="mb-20 pro-desc-details"></p>
                        <div class="product-size mb-20 clearfix">
                          <p class="aa-product-avilability"><b>Đơn vị tính</b> : <span>{!! $sanpham->donvitinh_ten !!}</span></p>
                        </div>
                        <!-- <div class="color clearfix mb-20">
                            <label>Màu sắc</label>
                            <ul class="color-list">
                                <li>
                                    <a class="orange active" href="#"></a>
                                </li>
                                <li>
                                    <a class="paste" href="#"></a>
                                </li>
                            </ul>
                        </div> -->
                        
                        <div class="box-quantity d-flex hot-product2">
                            <div class="pro-actions">
                                <div class="actions-primary">
                                <a class="aa-add-to-cart-btn" href="{!! url('mua-hang',[$sanpham->id,$sanpham->sanpham_url]) !!}" data-original-title="Thêm vào giỏ hàng">+ Thêm vào giỏ hàng</a>
                                </div>
                                </form>
                                <div class="actions-secondary">
                                    <a href="{!! url('switchToWishlist',$sanpham->id) !!}" title="" data-original-title="Yêu thích"><i class="lnr lnr-heart"></i> <span>Thêm vào yêu thích</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="pro-ref mt-20">
                            <p><span class="in-stock"><i class="ion-checkmark-round"></i>Còn {!! $sanpham->sl !!} sản phẩm</span></p>
                        </div>
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail End -->
<!-- Product Thumbnail Description Start -->
<div class="thumnail-desc pb-100 pb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="main-thumb-desc nav tabs-area" role="tablist">
                    <li><a class="active" data-toggle="tab" href="#dtail">Mô tả sản phẩm</a></li>
                    <li><a data-toggle="tab" href="#review">Đánh giá</a></li>
                </ul>
                <!-- Product Thumbnail Tab Content Start -->
                <div class="tab-content thumb-content border-default">
                    <div id="dtail" class="tab-pane fade show active">
                        <p>{!! $sanpham->sanpham_mo_ta !!}</p>
                    </div>
                    <div id="review" class="tab-pane fade">
                        <!-- Reviews Start -->
                        <div class="review border-default universal-padding">
                            <div class="group-title">
                                <h2>Đánh giá của khách hàng</h2>
                            </div>
                            @if ($binhluan != null)
                              @foreach ($binhluan as $item)
                            <h4 class="review-mini-title"><strong>{!! $item->binhluan_ten !!}</strong> - <span>{!! date("d-m-Y",strtotime($item->created_at)) !!}</span></h4>
                            <p>{!! $item->binhluan_noi_dung !!}</p>
                            @endforeach
                            @endif
                        </div>
                        <!-- Reviews End -->
                        <!-- Reviews Start -->
                        <div class="review border-default universal-padding mt-30">
                          
                            <h2 class="review-title mb-30">Đánh giá: <span>{!! $sanpham->sanpham_ten !!}</span></h2>
                            <p class="comment-notes">
                              Địa chỉ mail của các bạn sẽ không hiện lên và nội dung bình luận sẽ được kiểm tra trước khi phát hành <span class="required">*</span>
                            </p>
                            <form action="{!! url('binh-luan') !!}"  class="aa-review-form" method="POST">
                            <p class="review-mini-title">Đánh giá của bạn</p>
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <input type="hidden" name="txtID" value="{!! $sanpham->id !!}" />
                            <!-- Reviews Field Start -->
                            <div class="riview-field mt-40">
                                <form autocomplete="off" action="#">
                                    <div class="form-group">
                                        <label class="req" for="sure-name">Tên *</label>
                                        <input type="text" class="form-control" name="txtName" id="name" required="required" placeholder="Tên của bạn">
                                        <div>
                                            {!! $errors->first('txtName') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="req" for="sure-name">Email *</label>
                                        <input type="email" class="form-control"  name="txtEmail" id="email" placeholder="example@gmail.com" required="required" />
                                        <div>
                                            {!! $errors->first('txtEmail') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="req" for="comments">Nội dung</label>
                                        <textarea class="form-control" name="txtContent" rows="3" id="message" required="required"></textarea>
                                        <div>
                                            {!! $errors->first('txtContent') !!}
                                        </div>
                                    </div>
                                    <button type="submit" class="customer-btn">Gửi đánh giá</button>
                                </form>
                            </div>
                            <!-- Reviews Field Start -->
                        </div>
                        <!-- Reviews End -->
                    </div>
                </div>
                <!-- Product Thumbnail Tab Content End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail Description End -->
<!-- Realted Products Start Here -->

<div class="hot-deal-products off-white-bg pt-100 pb-90 pt-sm-60 pb-sm-50">
    <div class="container">
        <!-- Product Title Start -->
        <div class="post-title pb-30">
            <h2>Sản phẩm liên quan</h2>
        </div>
        <!-- Product Title End -->
        <!-- Hot Deal Product Activation Start -->
        <div class="hot-deal-active owl-carousel">
            <!-- Single Product Start -->
            @foreach($splienquan as $lienquan)
            <div class="single-product">
                <!-- Product Image Start -->
                <div class="pro-img">
                  <a class="primary-img" href="{!! url('chi-tiet-san-pham',$lienquan->sanpham_url) !!} "><img src="{!! asset('resources/upload/sanpham/'.$lienquan->sanpham_anh) !!}" style="width: 200px; height: 200px;"></a>
                </div>
                <!-- Product Image End -->
                <!-- Product Content Start -->
                <div class="pro-content">
                    <div class="pro-info">
                        <h4><a href="product.html">{{$lienquan->sanpham_ten}}</a></h4>
                        @if ($lienquan->sanpham_khuyenmai == 1) 
                        @if(!is_null($khuyenmai))
                        <?php 
                            $tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
                            $giakm = ($lienquan->sanpham_gia_ban - ($tylegia[0]->khuyenmai_phan_tram*$lienquan->sanpham_gia_ban * 0.01));
                            $tyle = $tylegia[0]->khuyenmai_phan_tram;
                            ?> 
                            <p><span class="price">{!! number_format($giakm,0,",",".") !!} vnđ</span><del class="prev-price">{!! number_format("$lienquan->sanpham_gia_ban",0,",",".") !!} vnđ</del></p>
                            <div class="label-product l_sale">{{$tyle}}<span class="symbol-percent">%</span></div>
                            @else
                            <span class="price">
                        {!! number_format("$lienquan->sanpham_gia_ban",0,",",".") !!} vnđ
                        </span>
                        @endif
                        @endif
                    </div>
                    <div class="pro-actions">
                        <div class="actions-primary">
                            <a href="{!! url('mua-hang',[$lienquan->id,$lienquan->sanpham_url]) !!}" title="Add to Cart"> + Thêm vào giỏ hàng</a>
                        </div>
                        <div class="actions-secondary">
                            <a href="{!! url('switchToWishlist',$lienquan->id) !!}" title="WishList"><i class="lnr lnr-heart"></i> <span>Thêm vào yêu thích</span></a>
                        </div>
                    </div>
                </div>
                <!-- Product Content End -->
                <span class="sticker-new">Mới</span>
            </div>
            <!-- Single Product End --> 
            @endforeach
        </div>                
        <!-- Hot Deal Product Active End -->

    </div>
    <!-- Container End -->
</div>
</div>
@include('sweet::alert')
<!-- Realated Products End Here -->
    @endsection