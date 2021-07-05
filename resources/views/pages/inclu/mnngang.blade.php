<hr><div class="header-bottom  header-sticky" style="border-bottom: 15px solid #ffffff;border-top: 15px solid #ffffff" >
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 ">
                <nav class="d-none d-lg-block">
                    <ul class="header-bottom-list d-flex">
                        <li class="active"><a href="{!! url('shop') !!}">Cửa hàng</a>
                        </li>
                        <?php 
                        $nhom =  DB::table('nhom')->get();
                        ?>
                        @foreach ($nhom as $menu_1)
                        <li><a href="{!! url('nhom-san-pham',$menu_1->nhom_url) !!}">{!! $menu_1->nhom_ten !!}<i class="fa fa-angle-down"></i></a>
                        <?php 
                            $loaisp = DB::table('loaisanpham')->where('nhom_id',$menu_1->id)->get();
                        ?>
                            <!-- Home Version Dropdown Start -->
                            <ul class="ht-dropdown dropdown-style-two">
                            @foreach ($loaisp as $menu_2)
                                <li><a href="{!! url('loai-san-pham',$menu_2->loaisanpham_url) !!}">{!! $menu_2->loaisanpham_ten !!}</a></li>             
                            @endforeach 
                            </ul>
                            <!-- Home Version Dropdown End -->
                        </li>
                        @endforeach
                        <li><a href="{!! url('lien-he') !!}">Liên hệ</a></li>
                        <li><a href="{!! url('gioi-thieu') !!}">Giới thiệu</a></li>
                        <li><a href="{!! url('tin-tuc') !!}">Tin tức</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>