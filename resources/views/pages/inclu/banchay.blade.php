<div class="col-lg-3 order-2 order-lg-1">
    <div class="sidebar">
        <!-- Sidebar Electronics Categorie Start -->
        <div class="electronics mb-40">
            <h1 class="sidebar-title" style="color: red;font-size: 28px;">Sản phẩm bán chạy</h1>
            <hr style="height:2px;border-width:0;color:red;background-color:red">
            <div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style">
              <?php $sanpham = DB::table('sanpham') ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')->select(DB::raw('sum(lohang.lohang_so_luong_da_ban) as daban'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai','sanpham.sanpham_gia_ban')->groupBy('sanpham.id') ->orderBy('daban','desc')->take(9)->get(); 
              ?>
    @foreach($sanpham as $item)
        <ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
            <li class="col-lg-5 col-md-12"><a  href="{!! url('chi-tiet-san-pham',$item->sanpham_url) !!}" class="aa-cartbox-img"><img alt="img" src="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}" style="width: 100px;height: 120px;margin-bottom: 20px;margin-top: 10px"></a>
            </li>
            <li class="col-lg-7 col-md-12" > <h3 style="font: 20px arial, sans-serif;"><a  href="{!! url('chi-tiet-san-pham',$item->sanpham_url) !!}">{!! $item->sanpham_ten !!}</a></h3><hr style="height:1px;border-width:0;color:red;background-color:red">
          <p style="color:rgb(230, 0, 0); font:20px arial;">{!! number_format("$item->sanpham_gia_ban",0,",",".") !!} vnđ</p>
            </li>
        </ul> 
        <hr style="height:1px;border-width:0;color:red;background-color:red">
        @endforeach                           
    </div>
            <!-- category-menu-end -->
        </div>
        <!-- Sidebar Electronics Categorie End -->                       
    </div>
</div>