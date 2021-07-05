<div class="support-area bdr-top">
    <div class="container">
        <div class="d-flex flex-wrap text-center">
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-rocket"></i>
                </div>
                <div class="support-desc">
                    <h6>Giao hàng tận nơi</h6>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="fa fa-truck"></i>
                </div>
                <div class="support-desc">
                    <h6>Miễn phí vận chuyển</h6>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-lock"></i>
                </div>
                <div class="support-desc">
                    <h6>Thanh toán an toàn</h6>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-users"></i>
                </div>
                <div class="support-desc">
                    <h6>Hỗ trợ 24/7</h6>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                <img src="public/img/ksd.png" alt="logo-image" height="130px">
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
</div>
<footer class="off-white-bg2 pt-95 bdr-top pt-sm-55">
    <!-- Footer Top Start -->
    <div class="footer-top">
        <div class="container">
            <!-- Signup Newsletter Start -->
            <div class="row mb-60">
                  <div class="col-xl-7 col-lg-7 ml-auto mr-auto col-md-8">
                    <div class="news-desc text-center mb-30">
                          <h3>Đăng ký nhận tư vấn</h3>
                          <p><a href="{{URL::to('lien-he')}}">Để hiểu rõ về sản phẩm. Đăng ký nhận tư vấn ngay hôm nay</a></p>
                      </div>
                      <!-- <div class="newsletter-box">
                          <form action="#">
                              <input class="subscribe" placeholder="Địa chỉ email của bạn" name="email" id="subscribe" type="text">
                              <button type="submit" class="submit">Đăng ký !</button>
                          </form>
                      </div> -->
                  </div>
            </div> 
            <!-- Signup-Newsletter End -->                   
            <div class="row">
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Thông tin</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="{{URL::to('gioi-thieu')}}">Về chúng tôi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Dịch vụ khách hàng</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="{!! url('lien-he') !!}">Liên hệ chúng tôi</a></li>
                                <li><a href="{{URL::to('chinh-sach-bao-mat')}}">Chính sách bảo mật</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Thông tin của bạn</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="{{URL::to('gio-hang')}}">Giỏ hàng của bạn</a></li>
                                @if (Auth::check())
                                <li><a  href="{!! URL::route('khachhang.History', Auth::user()->id ) !!}">Lịch sử đặt hàng</a></li>
                                @endif
                                <li><a href="{{URL::to('wishlist')}}">Danh sách yêu thích</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Địa chỉ liên hệ</h3>
                        <div class="footer-content">
                            <ul class="footer-list address-content">
                                <li><i class="lnr lnr-map-marker" ></i> <a href="{{URL::to('dia-chi')}}">Địa chỉ: Thôn Xuyên Hử, Xã Đông Xuyên, Huyện Ninh Giang, Hải Dương.</a></li>
                                <li><i class="lnr lnr-envelope"></i><a href="#"> Email: huyennguyenhn9595@gmail.com </a></li>
                                <li>
                                    <i class="lnr lnr-phone-handset"></i> Điện thoại: (+84) 0981587886
                                </li>
                            </ul>                               
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Top End -->
    <!-- Footer Bottom Start -->
    <div class="footer-bottom pb-30">
        <div class="container">

              <div class="copyright-text text-center">                    
                <p>Bản quyền © 2020 <a target="_blank" href="#">KSD</a> Đã đăng ký bản quyền.</p>
              </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Bottom End -->
</footer>