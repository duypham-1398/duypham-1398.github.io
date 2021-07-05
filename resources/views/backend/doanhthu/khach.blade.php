<div class="col-lg-5">
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i>
                Khách hàng mua nhiều
                <div class="btn-group pull-right">
                    
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li  class="active"><a href="#cust1" data-toggle="tab">Khách tại cửa hàng</a>
                    </li>
                    <li><a href="#cust2" data-toggle="tab">Khách trên website</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="cust1">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Khách hàng</th>
                                                <th>Số đơn hàng</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($muanhieu as $item)
                                        <?php 
                                            $kh = DB::table('khachhang')->where('id',$item->khachhang_id)->first();
                                            $count = $count +1;
                                        ?>
                                            <tr>
                                                <td>{!! $count !!}</td>
                                                <td>{!! $kh->khachhang_ten !!}</td>
                                                <td>{!! $item->donhang !!}</td>
                                                <td>{!! number_format("$item->tien",0,",",".")  !!}vnđ</td>
                                            </tr>
                                        @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="cust2">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Khách hàng</th>
                                                <th>Số đơn hàng</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($muanh as $item)
                                        <?php 
                                            $kh = DB::table('khachmua')->where('id',$item->khachmua_id)->first();
                                            $count = $count +1;
                                        ?>
                                            <tr>
                                                <td>{!! $count !!}</td>
                                                <td>{!! $kh->khachmua_ten !!}</td>
                                                <td>{!! $item->donban !!}</td>
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