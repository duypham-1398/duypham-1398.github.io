@extends('backend.layout')
@section('content')  
    @include('sweet::alert')              
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#60b7a3">
                    <b style="color:black">Danh sách phiếu thu khách @if(isset($phieuthu)): {{$km->khachmua_ten}} @endif</b>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="table table-striped table-bordered table-hover" id="dynamic-table">
                            <thead>
                                <tr >
                                    <th>ID</th>
                                    <th >Người tạo</th>
                                    <th >Khách hàng</th>
                                    <th >Tiền thu</th>
                                    <th >Lý do thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($phieuthu as $item)
                                <?php $user = DB::table('users')->where('id',$item->user_id)->first();
                                $khachmua = DB::table('khachmua')->where('id',$item->khachmua_id)->first();
                                $lydo = DB::table('lydo')->where('id',$item->ly_do_thu)->first();
                                ?>
                                <tr >
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $user->name !!}</td>
                                    <td>{!! $khachmua->khachmua_ten !!}</td>
                                    <td class="text-right">{!! number_format($item->tien_thu) !!}</td>
                                    <td>{!! $lydo->mo_ta !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    <!-- /.row -->
                </section>
            </div>
        </div>
@stop