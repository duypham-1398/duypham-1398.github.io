@extends('layout')
@section('content')
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li class="active">Tìm kiếm</li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
</section>
</div><!--features_items--> 
        <!--/recommended_items-->
        <div class="main-shop-page pt-100 pb-100 ptb-sm-60" style="padding-top: 10px;padding-bottom: 20px;margin-top:20px">
        
				<div class="container">
						<!-- Row End -->
						<div class="row">
								<!-- Sidebar Shopping Option Start -->
								@include('pages.inclu.banchay')
                <!-- Sidebar Shopping Option End -->
                @if (!is_null($sanpham))
								<!-- Product Categorie List Start -->
								<div class="col-lg-9 order-1 order-lg-2">
									<!-- Grid & List Main Area End -->
										<div class="tab-content fix">
												<div id="grid-view" class="tab-pane fade show active">
														<div class="row">
                            @foreach ($sanpham as $item)
																<!-- Single Product Start -->
																<div class="col-lg-4 col-md-4 col-sm-6 col-6">
																		<div class="single-product">
																				<!-- Product Image Start -->
																				<div class="pro-img">
                                        <a class="aa-product-img" href="{!! url('san-pham',$item->sanpham_url) !!}"><img src="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}"  style="width: 250px; height: 300px;"></a>
																						<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="" data-original-title="Quick View"><i class="lnr lnr-magnifier"></i></a>
																				</div>
																				<!-- Product Image End -->
																				<!-- Product Content Start -->
																				<div class="pro-content">
																						<div class="pro-info">
																								<h4><a href="product.html">{!! $item->sanpham_ten !!}</a></h4>
                                                @if (!is_null($khuyenmai)) 
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
																										<a href="{!! url('mua-hang',[$item->id,$item->sanpham_url]) !!}" title="" data-original-title="Thêm vào giỏ hàng"> + Thêm vào giỏ hàng</a>
																								</div>
																								<div class="actions-secondary">
																										<a href="wishlist.html" title="" data-original-title="Yêu thích"><i class="lnr lnr-heart"></i> <span>Thêm vào yêu thích</span></a>
																								</div>
																						</div>
																				</div>
																				<!-- Product Content End -->
																		</div>
																</div>
																<!-- Single Product End -->
															@endforeach
                      @else()
                      <div>
                      <p><i>Rất tiếc! Chúng tôi không tìm thấy sản phẩm bạn đang cần.</i></p>
                        </div>
                        @endif
												
														<!-- Row End -->
												</div>
										</div>
								</div>
								<!-- product Categorie List End -->
								@include('pages.inclu.phantrang')
						</div>
						<!-- Row End -->
				</div>
				<!-- Container End -->
</div>
@include('sweet::alert')
@endsection