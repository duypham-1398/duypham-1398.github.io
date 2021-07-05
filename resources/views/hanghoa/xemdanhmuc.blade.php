@extends('layout_ad')
@section('title')
        <h3 class="page-header ">
        Danh mục hàng hóa / 
            <a href="{{URL::to('themdm')}}"  style="margin-top:-8px;" class="fa fa-product-hunt">Thêm mới</a>
        </h3>
        <?php
        $message = Session::get('message');
        if($message){
            echo '<b><span class="text-alert" style="color:red">'.$message.'</span></b>';
            Session::put('message',null);
        }
        ?>
@stop

@section('content')                 
<div class="panel panel-default">
    <div class="panel-heading">
        <b><i>Danh mục hàng hóa</i></b>
    </div>
<!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="text-center">Tên danh mục</th>
                        <th class="text-center">Hiển thị</th>
                        <th class="text-center">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($danhmuc as $dm)
                    <tr>
                        <td class="text-center">{{$dm->TenDM}}</td>
                        <td class="text-center"><span class="text-ellipsis">
                            <?php
                            if($dm->TrangThaiDM==0){
                                ?>
                                <a href="{{URL::to('/khongkichhoatdm/'.$dm->id)}}"  class="btn btn-primary"  ><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php
                                }else{
                                ?>  
                                <a href="{{URL::to('/kichhoatdm/'.$dm->id)}}"class="btn btn-danger" ><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php
                            }
                            ?>
                            </span></td>

                        <td class="text-center">
                            <a href="{{URL::to('/suadm/'.$dm->id)}}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></i></a>
                            <a  type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')" href="{{URL::to('/xoandm/'.$dm->id)}}">
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

@endsection