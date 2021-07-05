@extends('layout')
@section('content')
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
</section>
<div class="cart-main-area ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            @if(session('mua'))
            <div class="col-md-12 col-sm-12">
                <!-- Form Start -->
                <form action="#">
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive mb-45">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Ảnh</th>
                                    <th class="product-name">Tên sản phẩm</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-subtotal">Thành tiền</th>
                                    <th class="product-update">Cập nhật</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(session('mua'))
                            <?php $total = 0 ?>
                                @foreach(session('mua') as $id => $details)
                                <?php $total += $details['price'] * $details['quantity'] ?> 
                                <?php 
                                    $sanpham = DB::table('sanpham')->where('sanpham.id',$id)
                                    ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
                                    ->select(DB::raw('min(lohang.id) as lomoi'),'sanpham.sanpham_url','sanpham.sanpham_anh','lohang.lohang_so_luong_hien_tai')->where('lohang_so_luong_hien_tai','>','0')
                                    ->first();
                                ?>     
                            <form action="" method="POST" accept-charset="utf-8">
                            {{ csrf_field() }}
                                <tr>
                                    <td><a href="{!! url('chi-tiet-san-pham',$sanpham->sanpham_url) !!}"><img src="{!! asset('resources/upload/sanpham/'.$sanpham->sanpham_anh) !!}"  style="width: 45px; height: 50px;"></a></td>
                                    <td class="product-name"><a href="#">{{ $details['name'] }}</a></td>
                                    <td data-th="Quantity">
                                    <input type="number"  value="{{ $details['quantity'] }}" min="1" max="{{$sanpham->lohang_so_luong_hien_tai}}" class="form-control quantity"   style="width:50px"/></td>
                                    <td data-th="Price" >{{number_format($details['price'])}}</td>
                                    <td class="product-subtotal">{{ number_format($details['price'] * $details['quantity']) }}</td>
                                    <td><button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                                </div>
                                    </td>
                                    <td >
                                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button></td>
                                </tr>
                                         
                                @endforeach
                        @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Content Start -->
                    <div class="row">
                        <!-- Cart Button Start -->
                        <div class="col-md-8 col-sm-12">
                            <div class="buttons-cart">
                                <a href="{{URL::to('/')}}">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                        <!-- Cart Button Start -->
                        <!-- Cart Totals Start -->
                        @if(session('mua'))
                        <div class="col-md-4 col-sm-12">
                            <div class="cart_totals float-md-right text-md-right">
                                <h2>Tổng tiền</h2>
                                <br>
                                <table class="float-md-right">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Thành tiền</th>
                                            <td><span class="amount">{{number_format($total)}}</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Tổng tiền</th>
                                            <td>
                                                <strong><span class="amount">{{number_format($total)}}</span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="wc-proceed-to-checkout">
                                @if (Auth::check())
                                    <a href="{!! URL::route('getThanhtoan') !!}">Thanh toán</a>
                                @else
                                <a href="{!! url('login') !!}">Thanh toán</a>
                                @endif
                                </div>
                            </div>
                        </div>
                        <!-- Cart Totals End -->
                    </div>
                    <!-- Row End -->
                <!-- Form End -->

                @endif
                @else
                <div>
                <h3>&emsp;Bạn không có bất cứ sản phẩm nào trong giỏ hàng</h3>&emsp;<br>
                &emsp;&emsp;<a href="{{URL::to('/')}}" class="btn btn-primary btn-lg">Tiếp tục mua sắm</a>
                </div>
            </div>
            @endif
        </div>
            <!-- Row End -->
    </div>
</div>
@include('sweet::alert')
@include('pages.inclu.footer')
<!-- / Footer -->
<script type="text/javascript">
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('update_cart_quantity') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val(), price: ele.parents("tr").find(".price").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("Bạn có chắc muốn xóa")) {
                $.ajax({
                    url: '{{ url('xoa-mua') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection