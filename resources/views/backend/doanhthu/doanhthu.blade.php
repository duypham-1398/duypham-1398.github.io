<div class="col-lg-7">
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i>
                Tổng quan
                <div class="btn-group pull-right">
                    
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">Sản phẩm bán chạy</a>
                    </li>
                    <li><a href="#profile" data-toggle="tab">Sản phẩm nhập nhiều</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Ký hiệu</th>
                                                <th>Sản phẩm</th>
                                                <th>Đã bán</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($bdban as $item)
                                        <?php 
                                            $count = $count +1;
                                        ?>
                                            <tr>
                                                <td>{!! $count !!}</td>
                                                <td>{!! $item->sanpham_ky_hieu !!}</td>
                                                <td>{!! $item->sanpham_ten !!}</td>
                                                <td>{!! $item->soluong !!}</td>
                                                <td>{!! number_format("$item->soluong",0,",",".")  !!}vnđ</td>
                                            </tr>
                                        @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Ký hiệu</th>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($nhapnhieu as $item)
                                        <?php 
                                            $sp = DB::table('sanpham')->where('id',$item->sanpham_id)->first();
                                            $count = $count +1;
                                        ?>
                                            <tr>
                                                <td>{!! $count !!}</td>
                                                <td>{!! $sp->sanpham_ky_hieu !!}</td>
                                                <td>{!! $sp->sanpham_ten !!}</td>
                                                <td>{!! $item->nhap !!}</td>
                                                <td>{!! number_format("$item->tien",0,",",".")  !!}vnđ</td>
                                            </tr>
                                        @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
            </div>
            <!-- /.panel-body -->
            
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>