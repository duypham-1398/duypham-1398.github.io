@extends('layout')
@section('content')
<section id="aa-catg-head-banner">
  <!-- Breadcrumb Start -->
  <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{!! url('/') !!}">Trang chủ</a></li>
                <li class="active">Yêu thích</li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
</section>
<div class="cart-main-area wish-list ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if (sizeof(Cart::instance('wishlist')->content()) > 0)
                <!-- Form Start -->
                <form action="#">
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Ảnh</th>
                                    <th class="product-name"style="width: 350px;">Tên sản phẩm</th>
                                    <th class="product-price"style="width: 200px;">Giá</th>
                                    <th class="product-qty">Số lượng hiện tại</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach (Cart::instance('wishlist')->content() as $item)
                            <?php 
                                      $sanpham = DB::table('sanpham')->where('sanpham.id',$item->id)
                                      ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
                                      ->select(DB::raw('SUM(lohang_so_luong_hien_tai) as sl'),'sanpham.sanpham_url','sanpham.sanpham_anh','lohang.lohang_so_luong_hien_tai')
                                      ->first();
                            ?>
                                <tr>
                                    <td class="product-thumbnail">
                                    <a href="{!! url('chi-tiet-san-pham',$sanpham->sanpham_url) !!}"><img src="{!! asset('resources/upload/sanpham/'.$sanpham->sanpham_anh) !!}"  style="width: 45px; height: 50px;" alt="cart-image"></a>
                                    </td>
                                    <td class="product-name"><a href="{!! url('chi-tiet-san-pham',$sanpham->sanpham_url) !!}">{!!  $item->name !!}</a></td>
                                    <td class="product-price"><span class="amount">{!! number_format("$item->price",0,",",".") !!}vnđ</span></td>
                                    <td> Còn {{$sanpham->sl}} sản phẩm
                                    </td>
                                    <!-- <td>
                                    <form action="{{ url('switchToCart', [$item->id]) }}" method="POST" class="side-by-side">
                                        {!! csrf_field() !!}
                                        <input type="submit" class="btn btn-danger btn-lg" value="Thêm vào giỏ hàng" style="width: 200px;">
                                    </form>
                                    </td>  -->
                                    <td>
                                    <form action="{{ url('wishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-danger btn-sm" value="Xóa" style="width: 50px;">
                                    </form>
                                  </td>
                                  

                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Content Start -->
                </form>    
                <div style="float:right">
                    <form action="{{ url('/emptyWishlist') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-danger btn-lg" value="Xóa toàn bộ yêu thích" style="margin-top: 50px;">
                    </form>
                </div>
                <!-- Form End -->
                @else
                <h3>Bạn không có sản phẩm yêu thích nào</h3>&emsp;<br>
                <a href="{{URL::to('/')}}" class="btn btn-primary btn-lg">Tiếp tục khám phá</a>
                @endif
            </div>
        </div>
        <!-- Row End -->
    </div>
</div>
@include('sweet::alert')
@endsection