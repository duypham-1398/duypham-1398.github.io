@extends('backend.layout')
@section('content')  
    @include('sweet::alert')       <!-- page start-->
        <div class="row">
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Chọn lô hàng</h3><hr />
                    </header>

                    <table class="table table-striped table-bordered table-hover" id="dynamic-table">
                        <thead>
                        <tr >
                            <th>Ký hiệu</th>
                            <th>Sản phẩm</th>
                            <th>Ngày</th>
                            <th>HSD</th>
                            <th>SL Hiện tại</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                        <tr >
                                <?php 
                                // date("Y-m-d H:i", strtotime("$now -$days day"));
                                    $today  = date("Y-m-d"); // Năm/Tháng/Ngày
                                    
                                    $ngaybd =  date("Y-m-d", strtotime("$item->created_at")); // Năm/Tháng/Ngày
                                    
                                    // strtotime(date("Y-m-d", $ngaybd,"+ "+$item->khuyenmai_thoi_gian +" days"));
                                    $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $item->lohang_han_su_dung  day"));
                                    // echo $ngaykt;
                                    if ((strtotime($today) >= strtotime($ngaybd))&& (strtotime($today) <= strtotime($ngaykt)))
                                    {

                                    }else{
                                    DB::table('lohang')
                                        ->where('id',$item->id)
                                        ->update([
                                            'lohang_tinh_trang' => 1,
                                            ]);
                                    }
                                    
                                ?>
                        
                            <td><a href="{{URL::to('chon-lo-san-pham/'.$item->id)}}">{!! $item->lohang_ky_hieu !!}</a></td>
                            <td>
                                <?php $sanpham = DB::table('sanpham')->where('id',$item->sanpham_id)->first(); ?>
                                @if (!empty($sanpham->sanpham_ten))
                                    {!! $sanpham->sanpham_ten !!}
                                @else
                                    {!! NULL !!}
                                @endif
                            </td>
                        
                            <td>{!! date("d-m-Y",strtotime($ngaybd)) !!}</td>
                            <td>{!! date("d-m-Y",strtotime($ngaykt)) !!}</td>
                            <td>{!! $item->lohang_so_luong_hien_tai !!}
                            </td>
                        </tr>
                        @endforeach
              
                        </tbody>
                    </table>
                </section>
                
            </div>
            <div class="col-sm-6">
                <section class="panel">
                <form role="form" method="post" action="{{URL::to('luu-sanpham-theo-lo')}}">
                {{ csrf_field() }}
                    @if(session('chonlo'))
                    <header class="panel-heading">
                        <h3>Số lượng SP đã chọn theo lô</h3><hr/>
                    <div class="navbar-right" style="margin-right:10px;margin-top:-90px;">
                        <div class="panel-body">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                    </header>
                    @else
                    <header class="panel-heading">
                    <h3>Lô hàng đã chọn: 0 lô</h3>
                    </header>
                    @endif
                    <table class="table table-striped">
                    @if(session('chonlo'))
                        <thead>
                        <tr>
                            <th class="product-name">Lô hàng</th>
                            <th class="product-quantity" >Số lượng</th>
                            <th class="product-remove" >Cập nhật</th>
                            <th class="product-remove">Xóa</th>
                        </tr>
                        </thead>
                    @endif
                        <tbody>
                        @if(session('chonlo'))
                                @foreach(session('chonlo') as $id => $details)  
                                <tr>
                                    <td class="product-name"><a href="#">{{ $details['name'] }}</a></td>
                                    <td data-th="Quantity">
                                    <input type="number"  value="{{ $details['quantity'] }}" min="1" class="form-control quantity"   style="width:50px"/></td>
                                    <td><button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button></td>
                                    <td >
                                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button></td>
                                </tr>
                                         
                                @endforeach
                        @endif
                        </tbody>
                    </table> 
                    @if(session('chonlo'))
                    <div class="panel-heading" style="background-color:#eff1ef00"><h3>Nhập thêm thông tin cần thiết</h3> </div>
                    @endif

                </form>
                </section>
            </div>
        </div>
@stop