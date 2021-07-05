@extends('backend.layout')
@section('content')
<!--main content start-->
    @include('sweet::alert')
<!-- page start-->
<div class="panel panel-default">
<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">
                <h3>Chọn sản phẩm</h3><hr />
            </header>
            <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dynamic-table">
                <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Loại</th>
                    <th>ĐVT</th>
                    <th>Giá SP</th>
                    <th>KM</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)     
                                
                <tr>
                    <td>
                    <img src="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}" class="img-responsive img-rounded" alt="Image" style="width: 70px; height: 40px;">
                    </td>
                    <td><a href="{{URL::to('AddBan/'.$item->id)}}">{!! $item->sanpham_ten !!}</a></td>
                    <td>
                        <?php $loaisanpham = DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first(); ?>
                        @if (!empty($loaisanpham->loaisanpham_ten))
                            {!! $loaisanpham->loaisanpham_ten !!}
                        @else
                            {!! NULL !!}
                        @endif
                    </td>
                    <td>
                        <?php $donvitinh = DB::table('donvitinh')->where('id',$item->donvitinh_id)->first(); ?>
                        @if (!empty($donvitinh->donvitinh_ten))
                            {!! $donvitinh->donvitinh_ten !!}
                        @else
                            {!! NULL !!}
                        @endif
                    </td>
                    <td> {!! number_format("$item->sanpham_gia_ban",0,",",".") !!}</td>
                    @if (!is_null($khuyenmai))
                    @if($item->sanpham_khuyenmai == 1)
                    <?php 
                        $tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
                        $tyle = $tylegia[0]->khuyenmai_phan_tram;
                        ?> 
                    <td>{!! $tyle !!} %</td>
                    @endif
                    @else
                    <td>0 %</td>
                    
                    @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
    <div class="col-sm-6">
        <section class="panel">
        
            @if(session('ban'))
            <header class="panel-heading">
                <h3>Sản phẩm đã chọn : {{ count((array) session('ban')) }} sản phẩm</h3><hr/>
                
            </header>
            @else
            <header class="panel-heading">
            <h3>Sản phẩm đã chọn: 0 sản phẩm</h3>
            </header>
            @endif
            <table class="table table-striped">
            @if(session('ban'))
                <thead>
                <tr>
                    <th class="product-name"style="width: 350px;">Tên sản phẩm</th>
                    <th class="product-quantity" >SL</th>
                    <th class="product-price"style="width: 200px;">Giá</th>
                    <th class="product-subtotal"style="width: 200px;">Thành tiền</th>
                    <th class="product-remove" style="width:160px">Cập nhật</th>
                    <th class="product-remove">Xóa</th>
                </tr>
                </thead>
            @endif
                <tbody>
                @if(session('ban'))
                    <?php $total = 0 ?>
                        @foreach(session('ban') as $id => $details)
                        <?php $total += $details['price'] * $details['quantity'] ?> 
                        <?php 
                            $sanpham = DB::table('sanpham')->where('sanpham.id',$id)
                            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
                            ->select(DB::raw('min(lohang.id) as lomoi'),'sanpham.sanpham_url','sanpham.sanpham_anh','lohang.lohang_so_luong_hien_tai')->where('lohang_so_luong_hien_tai','>','0')
                            ->first();
                        ?>     
                        <tr>
                            <td class="product-name"><a href="#">{{ $details['name'] }}</a></td>
                            <td data-th="Quantity">
                            <input type="number"  value="{{ $details['quantity'] }}" min="1" max="{{$sanpham->lohang_so_luong_hien_tai}}" class="form-control quantity"   style="width:50px"/></td>
                            <td data-th="Price" >{{number_format($details['price'])}}</td>
                            <td class="product-subtotal">{{ number_format($details['price'] * $details['quantity']) }}</td>
                            <td><button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>

                            <div class="ajax-success-ct"></div>
                        </div>
                            </td>
                            <td >
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button></td>
                        </tr>
                                    
                        @endforeach
                @endif
                </tbody>
            </table> <hr  />
            @if(session('ban'))
                <div><h3>Tổng tiền: {{number_format($total)}}</h3><br>
            
                    <a href="{{URL::to('thanh-toan-don')}}" 
                    type="button" class="btn btn-danger" 
                    data-toggle="tooltip" data-placement="left" 
                    title="Lưu">
                        <i class="fa fa-credit-card"></i> Thanh toán
                    </a>
                    
                </div>
                @endif
                
        </section>
        
    </div>
</div>
<!-- page end-->

<!--main content end-->
<script type="text/javascript">
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('cap-nhat-ban') }}',
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
                    url: '{{ url('xoa-ban') }}',
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