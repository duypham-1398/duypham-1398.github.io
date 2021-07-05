@extends('backend.layout')
@section('content')    
     <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;margin-bottom:10px">
              <h3 >
                <div style="margin-bottom:10px">Chi tiết đơn bán số {{$donban->id}}</div>
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <!-- <a type="text" style="color:white"class="btn btn-primary"  href="{!! URL::route('admin.donban.list') !!}"> Lưu</a> -->
                <a href="{!! URL::route('admin.donban.list') !!}" ><i class="btn btn-default" >Hoàn tất</i></a>

            </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="panel panel-default" >
                    <div class="panel-heading" style="background:#a9d86e;">
                        <h2 class="panel-title" style="color:black;"><b>Danh sách sản phẩm </b></h2>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12" >
                            <div class="table-responsive">
                                <table class="table table-hovered" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>ID</th>
                                            <th>Sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 0; ?>
                                        @foreach ($chitiet as $val)
                                            <tr>
                                                <td>{!! $count = $count + 1 !!}</td>
                                                <td>{!! $val->id !!}</td>
                                                <td>
                                                    <?php  
                                                        $sp = DB::table('sanpham')->where('id',$val->sanpham_id)->first();
                                                        $lh = $sp->id;
                                                        $splohang = DB::table('lohang')->where('sanpham_id',$lh)->first();
                                                        $lohang = DB::table('lohang')->where('sanpham_id',$lh)->get();
                                                    ?>
                                                    <a href="{!! URL::route('admin.sanphamlo.list', [$sp->id] ) !!}">
                                                    {{$sp->sanpham_ten}}
                                                </a>
                                                </td>
                                            
                                                <td>
                                                {!! number_format($val->chitietdonban_thanh_tien/$val->chitietdonban_so_luong,0,",",".") !!} vnđ 
                                                </td>
                                                <td>{!! $val->chitietdonban_so_luong !!}</td>
                                                <td>{!! number_format("$val->chitietdonban_thanh_tien",0,",",".") !!} vnđ </td>
                                                </td>
                                            
                                            </tr>
                                            
                                        @endforeach
                                        <tr>
                                        <td colspan="5">
                                        <b>Tổng tiền : {!! number_format("$donban->donban_tong_tien",0,",",".") !!} vnđ </b>
                                            
                                        </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
    @foreach ($chitiet as $val)
      <?php  
          $sp = DB::table('sanpham')->where('id',$val->sanpham_id)->first();
          $splohang = DB::table('lohang')->where('sanpham_id',$sp->id)->first();
          $ctl = DB::table('chitietdonban')->where('sanpham_id',$val->sanpham_id)->first();
          $lohang = DB::table('lohang')->where('sanpham_id',$sp->id)->get();
      ?>
    @if(session('chonlo'))
    @if($sp->id == $spid)
    <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="background:#a9d86e;">
        <h3 class="panel-title" style="color:black">Chi tiết sản phẩm : {{$sp->sanpham_ten}} {{$sp->id}}</h3>
          </div>
          <div class="panel-body">
          <div class="table-responsive">
              <table class="table table-hover">

                  <tbody>
                      <tr>    
                          <td><b>Thuộc lô hàng có id : {{$splohang->id}} và số lượng hiện tại là {{$splohang->lohang_so_luong_hien_tai}}</b></td>
                      </tr>
                      <tr>
                          <td><h4>Lô hàng chứa sản phẩm tại công ty</h4></td>
                        </tr>
                          <table class="table table-hovered" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ký hiệu</th>
                                <th>SL hiện tại</th>
                                <th>HSD</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $lohang = DB::table('lohang')->where('sanpham_id',$sp->id)->get();
                        ?>
                        @foreach($lohang as $lohang)
                                <tr>
                                <?php 
                                // date("Y-m-d H:i", strtotime("$now -$days day"));
                                    $today  = date("Y-m-d"); // Năm/Tháng/Ngày
                                    
                                    $ngaybd =  date("Y-m-d", strtotime("$lohang->created_at")); // Năm/Tháng/Ngày
                                    
                                    // strtotime(date("Y-m-d", $ngaybd,"+ "+$item->khuyenmai_thoi_gian +" days"));
                                    $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $lohang->lohang_han_su_dung  day"));
                                    // echo $ngaykt;
                                    if ((strtotime($today) >= strtotime($ngaybd))&& (strtotime($today) <= strtotime($ngaykt)))
                                    {

                                    }else{
                                    DB::table('lohang') ->where('id',$lohang->id)->update(['lohang_tinh_trang' => 1, ]);
                                    }    
                                ?>
                                    <td>{{$lohang->id}}</td>
                                    <td> {{$lohang->lohang_ky_hieu}} </td>
                                    <td>{{$lohang->lohang_so_luong_hien_tai}}</td>
                                    <td>{{date('d-m-y',strtotime($ngaykt))}}</td>
                                    <td style="color: #fff;text-shadow: 0px -1px 4px white, 0px -2px 10px yellow, 0px -10px 20px #ff8000, 0px -18px 40px red;font: 20px 'BlackJackRegular';"><a href="{{URL::to('chon-lo-san-pham/'.$lohang->id)}}">
                                      <h4 > Thêm chi tiết bán theo lô</h4>
                                   
                                </tr>
                        @endforeach
                              
                        </tbody>
                    </table>
                      </tr>
                  </tbody>
              </table>
          </div>
          </div>
        </div> 
    </div>
    @endif
    @else
    <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="background:#a9d86e;">
        <h3 class="panel-title" style="color:black">Chi tiết sản phẩm : {{$sp->sanpham_ten}} {{$sp->id}}</h3>
          </div>
          <div class="panel-body">
          <div class="table-responsive">
              <table class="table table-hover">

                  <tbody>
                      <tr>    
                          <td><b>Thuộc lô hàng có id : {{$splohang->id}} và số lượng hiện tại là {{$splohang->lohang_so_luong_hien_tai}}</b></td>
                      </tr>
                      <tr>
                          <td><h4>Lô hàng chứa sản phẩm tại công ty</h4></td>
                        </tr>
                          <table class="table table-hovered" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ký hiệu</th>
                                <th>SL hiện tại</th>
                                <th>HSD</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lohang as $lohang)
                                <tr>
                                <?php 
                                // date("Y-m-d H:i", strtotime("$now -$days day"));
                                    $today  = date("Y-m-d"); // Năm/Tháng/Ngày
                                    
                                    $ngaybd =  date("Y-m-d", strtotime("$lohang->created_at")); // Năm/Tháng/Ngày
                                    
                                    // strtotime(date("Y-m-d", $ngaybd,"+ "+$item->khuyenmai_thoi_gian +" days"));
                                    $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $lohang->lohang_han_su_dung  day"));
                                    // echo $ngaykt;
                                    if ((strtotime($today) >= strtotime($ngaybd))&& (strtotime($today) <= strtotime($ngaykt)))
                                    {

                                    }else{
                                    DB::table('lohang') ->where('id',$lohang->id)->update(['lohang_tinh_trang' => 1, ]);
                                    }    
                                ?>
                                    <td>{{$lohang->id}}</td>
                                    <td> {{$lohang->lohang_ky_hieu}} </td>
                                    <td>{{$lohang->lohang_so_luong_hien_tai}}</td>
                                    <td>{{date('d-m-y',strtotime($ngaykt))}}</td>
                                    <?php 
                                        $chitietlo = DB::table('ctbantheolo')->select('ctdonban_id')->where('ctdonban_id',$val->id)->first();
                                        ?>
                                    @if(!isset($chitietlo))
                                    <td style="color: #fff;text-shadow: 0px -1px 4px white, 0px -2px 10px yellow, 0px -10px 20px #ff8000, 0px -18px 40px red;font: 20px 'BlackJackRegular';"><a href="{{URL::to('chon-lo-san-pham/'.$lohang->id)}}">
                                      <h4 > Thêm chi tiết bán theo lô</h4></a></td>
                                    @else
                                    <td >
                                    <h5 style="color:red">Đã thêm </h5>
                                    </td>
                                    @endif

                                   
                                </tr>
                        @endforeach
                              
                        </tbody>
                    </table>
                      </tr>
                  </tbody>
              </table>
          </div>
          </div>
        </div> 
    </div>
    @endif
  @endforeach
  <div class="col-sm-6">
  <section class="panel">
  <form role="form" method="post" action="{{URL::to('luu-san-pham-theo-lo')}}">
      {{ csrf_field() }}
      @if(session('chonlo'))
        <div class="panel panel-default">
          <div class="panel-heading" style="background:#a9d86e;">
        <h3 class="panel-title" style="color:black">Số lượng SP đã chọn theo lô: {{ count((array) session('chonlo')) }}</h3>
          </div>
          <div class="navbar-right" style="margin-right:10px;margin-top:-25px;">
          <button type="submit" class="btn btn-primary btn-sm btn-crnv-right"><i
                        class="fa fa-check"></i> Lưu
                </button> </div>
          <div class="panel-body">
          <div class="table-responsive">
        <table class="table table-hover">
                <thead>
                <tr>
                    <th class="product-name">ID đơn bán </th>
                    <th class="product-name">ID-CT đơn bán</th>
                    <th class="product-name">Lô hàng</th>
                    <th class="product-quantity" >Đơn giá</th>
                    <th class="product-quantity" >Số lượng</th>
                    <th class="product-remove" >Cập nhật</th>
                    <th class="product-remove">Xóa</th>
                </tr>
                </thead>
                <tbody>
                        @foreach(session('chonlo') as $id => $details)  
                        
                        <tr>
                            <td><input type="text" name="chitietma" value = "{!! $ctlb ->donban_id!!}" class="form-control "   style="width:50px"/></td>
                            @foreach ($chitiet as $val)
                            <?php  
                                $sp = DB::table('sanpham')->where('id',$val->sanpham_id)->first();
                            ?>
                            @if($sp->id == $spid)
                            <td><input type="text" name="ctbanid" value = "{{ $val->id }}" class="form-control "   style="width:50px"/></td>
                            @endif
                            @endforeach
                            <td class="product-name"><a href="#">{{ $details['name'] }}</a></td>
                            <td data-th="Price">{{number_format($details['price'])}}</td>
                            <td data-th="Quantity">
                            <input type="number"  value="{{ $details['quantity'] }}" min="0" class="form-control quantity"   style="width:50px"/></td>
                            <td><button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button></td>
                            <td >
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button></td>
                        </tr>
                                    
                        @endforeach
                @endif
                </tbody>
            </table> 
            </div>
        </div>
        </div>
    </div>

  </form>

</section>
</section>

<!-- end customer -->
<script type="text/javascript">
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('cap-nhat-don-ban-theo-lo') }}',
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
                    url: '{{ url('xoa-don-ban-theo-lo') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    $(document).ready(function(){
        $('.blink').each(function() {
            var elem = $(this);
            setInterval(function() {
                if (elem.css('visibility') == 'hidden') {
                    elem.css('visibility', 'visible');
                } else {
                    elem.css('visibility', 'hidden');
                }    
            }, 500);
        });
    });


        
</script>
@stop