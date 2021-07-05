@extends('layout_ad')
@section('title')
        <h3 class="page-header ">
        Sản phẩm / 
            <a href="{{URL::to('themhh')}}"  style="margin-top:-8px;" class="fa fa-product-hunt">Thêm mới</a>
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
    <b><i>Danh sách sản phẩm</i></b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th class="text-center">Hình</th>
                <th class="text-center">Tên</th>
                <th class="text-center">Thông số</th>
                <th class="text-center">Danh mục</th>
                <th class="text-center">Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hanghoa as $hh)
            <tr class="odd gradeX" align="left">
                <td class="text-center"><img src="public/uploads/product/{{ $hh->HinhHH }}" class="img-responsive img-rounded" alt="Image" style="width: 70px; height: 50px;"></td>
                <td class="text-center">{{$hh->TenHH}}</td>
                <td class="text-center">{{$hh->DonViHH->TenDV}}</td>
                <td class="text-center">{{$hh->DanhMucHH->TenDM}}</td>
                <td class="text-center"><span class="text-ellipsis">
                    <?php
                    if($hh->TrangThaiHH==0){
                        ?>
                        <a href="{{URL::to('/khongkichhoathh/'.$hh->id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                        <?php
                        }else{
                        ?>  
                        <a href="{{URL::to('/kichhoathh/'.$hh->id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"  style="color:red"></span></a>
                        <?php
                    }
                    ?>
                </span>
                    <a href="{{URL::to('/suahh/'.$hh->id)}}" onclick="return confirm('Bạn có chắc chắn muốn sửa?')"><i class="fa fa-pencil-square-o text-success text-active"></i></i></a>
                    <a onclick="return confirm('Bạn có chắc là muốn xóa hàng hóa này không?')" href="{{URL::to('/xoahh/'.$hh->id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                    </a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.row -->
</div>
</div>

@stop



