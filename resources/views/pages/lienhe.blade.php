@extends('layout')
@section('content')
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li class="active">Liên hệ</li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
</section>
  <!-- start contact section -->
 <section id="aa-contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
       <div class="sidebar-post-content">
            <h3 class="sidebar-lg-title">Công Ty Cổ Phần Xây Dựng KSD</h3>
            <ul class="post-meta d-sm-inline-flex">
                <li><span>Chất lượng hàng đầu</span></li>
                <li><span class="fa fa-phone">&emsp;0123456789</span></li>
                <span class="fa fa-envelope"></span>&emsp;huyennguyenhn9595@gmail.com
            </ul>
        </div>
        <div class="aa-contact-top" style="margin-top:20px" >
             <h2 style="font:30px tahoma, sans-serif; color:green;">Chúng tôi đang chờ để được hỗ trợ bạn</h2>
           </div>&emsp;<hr style="height:1px;border-width:0;color:green;background-color:green">
        <div class="aa-contact-address" style="margin-top:20px; margin-bottom:100px">
             <div class="row">
               <div class="col-md-4">
                 <div class="aa-contact-address-left">
                   <form class="comments-form contact-form" action="" method="POST">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">                        
                          <input type="text" name="txtName" placeholder="Họ và tên" class="form-control">
                        </div>
                        <div class="form-group">                        
                          <input type="email" name="txtMail" placeholder="Email" class="form-control">
                        </div>                 
                    <div class="form-group">                        
                      <textarea class="form-control" name="txtContent" rows="3" placeholder="Lời nhắn"></textarea>
                    </div>
                    <button class="customer-btn">Gửi</button>
                  </form>
                 </div>
               </div class="col-md-8">         
                  <!-- contact map -->
                  <div class="aa-contact-map" >
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3730.7718623519536!2d106.33080061437381!3d20.760038902274715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135920e572e1395%3A0xfcbd415995b5798f!2zxJDDqiB0aMO0biBYdXnDqm4gSOG7rSwgTmluaCBHaWFuZywgSOG6o2kgRMawxqFuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1593526222789!5m2!1svi!2s" width="800px" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
                  </div>
                  <!-- Contact address -->
                </div>
               <div>
               </div>
             </div>
           </div>
       </div>
     </div>
   </div>
 </section>
<!-- Footer -->
@include('sweet::alert')
@endsection