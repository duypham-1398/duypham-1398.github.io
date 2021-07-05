    <!-- Quick View Content Start -->
    @foreach($sanpham as $item)
    <?php 
    $sanphamkhuyenmai = DB::select('select* from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1');
    ?>
    <div class="main-product-thumbnail quick-thumb-content">
          <div class="container">
              <!-- The Modal -->
              <div class="modal fade" id="myModal">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                              <div class="row">
                                  <!-- Main Thumbnail Image Start -->
                                  <div class="col-lg-5 col-md-6 col-sm-5">
                                        <!-- Thumbnail Large Image start --> 
                                        <div class="tab-content">  
                                            <div id="thumb1" class="tab-pane fade show active">
                                            <a href="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}" data-fancybox="images" title="Nhấn để phóng to">
                                            <img src="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}" style="width: 250px; height: 300px;" alt="product-view"></a> 
                                            </div>
                                        </div>
                                        <!-- Thumbnail Large Image End -->
                                  </div>
                                  <!-- Main Thumbnail Image End -->
                                  <!-- Thumbnail Description Start -->
                                  <div class="col-lg-7 col-md-6 col-sm-7">
                                      <div class="thubnail-desc fix mt-sm-40">
                                          <h3 class="product-header">{!! $item->sanpham_ten !!}</h3>
                                          <div class="pro-price mtb-30">
                                          @if ($item->sanpham_khuyenmai == 1) 
                                                <?php 
                                                    $tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
                                                    $giakm = ($item->lohang_gia_ban_ra - ($tylegia[0]->khuyenmai_phan_tram*$item->lohang_gia_ban_ra * 0.01));
                                                    $tyle = $tylegia[0]->khuyenmai_phan_tram;
                                                    ?> 
                                                    <p><span class="price">{!! number_format($giakm,0,",",".") !!} vnđ</span><del class="prev-price">{!! number_format("$item->lohang_gia_ban_ra",0,",",".") !!} vnđ</del></p>
                                                    <div class="label-product l_sale">{{$tyle}}<span class="symbol-percent">%</span></div>
                                                    @else
                                                    <span class="aa-product-price">
                                                {!! number_format("$item->lohang_gia_ban_ra",0,",",".") !!} vnđ
                                                </span>
                                                @endif
                                          </div>
                                          <p class="mb-20 pro-desc-details"></p>
                                          <div class="box-quantity d-flex">
                                              <form action="#">
                                                  <input class="quantity mr-40" type="number" min="1" value="1">
                                              </form>
                                              <a class="add-cart" href="cart.html">Thêm vào giỏ hàng</a>
                                          </div>
                                          <div class="pro-ref mt-15">
                                              <p><span class="in-stock"><i class="ion-checkmark-round"></i> trong kho</span></p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Thumbnail Description End -->
                              </div>
                          </div>
                          <!-- Modal footer -->
                          <div class="custom-footer">
                              <div class="socila-sharing">
                                  <ul class="d-flex">
                                      <li>Chia sẻ</li>
                                      <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                      <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                      <li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
                                      <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </div>
    @endforeach
        <!-- Quick View Content End -->