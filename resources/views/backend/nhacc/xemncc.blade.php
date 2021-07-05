@extends('backend.layout')
@section('content')  
    @include('sweet::alert')                  
    <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading" style="background:#a9d86e">
                    <b style="color:black">Danh sách nhà cung cấp | <a href="{{URL::to('themncc')}}" >Thêm mới</a></b>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down" style="color:white"></a>
                <a href="javascript:;" class="fa fa-times" style="color:white"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="table table-striped table-bordered table-hover" id="dynamic-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tên nhà cung cấp</th>
                                                <th class="text-center">Địa chỉ</th>
                                                <th class="text-center">Số điện thoại</th>
                                                <th class="text-center">SỬa</th>
                                                <th class="text-center">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($nhacungcap as $ncc)
                                            <tr>
                                                <td class="text-center">{{$ncc->nhacungcap_ten}}</td>
                                                <td class="text-center">{{$ncc->nhacungcap_dia_chi}}</td>
                                                <td class="text-center">{{$ncc->nhacungcap_sdt}}</td>
                                                <td class="text-center">
                                                    <a href="{{URL::to('/suancc/'.$ncc->id)}}" class="btn btn-primary" ui-toggle-class="">
                                                    <i class="fa fa-pencil fa-fw"></i></a>
                                                    </td>
                                                    <td>
                                                    <a onclick="return confirm('Bạn có chắc là muốn xóa nhà cung cấp này không?')" href="{{URL::to('/xoancc/'.$ncc->id)}}" class="btn btn-danger" ui-toggle-class="">
                                                    <i class="fa fa-trash-o  fa-fw"></i>
                                                    </a>
                                                </td>
                                            </tr>			
                                            @endforeach				
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection