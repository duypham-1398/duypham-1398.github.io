@extends('layout')
@section('content')
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li class="active">Địa chỉ</li>
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
            <div class="aa-contact-area">
                <div class="aa-contact-map" style="margin-top:20px;margin-bottom:20px">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3730.7718623519536!2d106.33080061437381!3d20.760038902274715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135920e572e1395%3A0xfcbd415995b5798f!2zxJDDqiB0aMO0biBYdXnDqm4gSOG7rSwgTmluaCBHaWFuZywgSOG6o2kgRMawxqFuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1593526222789!5m2!1svi!2s" width="1170" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection