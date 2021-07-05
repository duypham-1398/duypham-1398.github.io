<div class="col-xl-3 col-lg-4 d-none d-lg-block">
    <div class="vertical-menu mb-all-30">
        <nav>
            <ul class="vertical-menu-list">
            <?php 
            $nhom =  DB::table('nhom')->get();
            ?>
            @foreach ($nhom as $menu_1)
                <li class=""><a href="{!! url('nhom-san-pham',$menu_1->nhom_url) !!}">{!! $menu_1->nhom_ten !!}<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                <?php 
                    $loaisp = DB::table('loaisanpham')->where('nhom_id',$menu_1->id)->get();
                ?>
                    <ul class="ht-dropdown mega-child">
                    @foreach ($loaisp as $menu_2)
                        <li><a href="{!! url('loai-san-pham',$menu_2->loaisanpham_url) !!}">{!! $menu_2->loaisanpham_ten !!}</a>
                        </li>  
                    @endforeach                                       
                    </ul>
                    <!-- category submenu end-->
                </li>
              @endforeach
            </ul>
        </nav>
    </div>
</div>