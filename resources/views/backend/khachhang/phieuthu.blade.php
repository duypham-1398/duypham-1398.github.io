@extends('backend.layout')
@section('content')  
    <div class="row">
      <div class="col-sm-12">
          <section class="panel" >
          <div style="margin-left:10px;margin-top:25px;font-size:16px;color:red">
            <b ><span >Công ty cổ phần xây dựng KSD</span></b><br>
            Thành phố Hải Dương<br>
            Số điện thoại: 0123456789<br>
            Website: http://localhost/congtycophanxaydungKSD/
          </div><hr>
          <center><h2 style="color:red">PHIẾU THU TIỀN</h2></center><hr>
          <table style="margin-left:10px;font-size:16px;color:black">
            <tr >
              <td width="120px"><strong>Khách hàng:</strong></td> <td>{!!$khachhang->khachhang_ten!!}</td>
              <td><strong></td>
            </tr>
            <tr>
              <td width="120px"><strong>Địa chỉ:</strong></td> <td>{!!$khachhang->khachhang_dia_chi!!}</td>
              <td></td>
            </tr>
            <tr>
              <td width="120px"><strong>Điện thoại:</strong></td> <td> {!!$khachhang->khachhang_sdt!!}</td>
              <td></td>
            </tr>
            <tr>
              <td width="120px"><strong>Email:</strong></td> <td> {!!$khachhang->khachhang_email!!}</td>
              <td></td>
            </tr>
          </table><br><br>
            <div class="panel-body">
                <div class="adv-table">
                <form action="{!! route('admin.phieuthu.postkhachhang') !!}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                    <table  class="display table table-bordered table-striped" style="font-size:16px;color:black">
                        <thead>
                            <tr >
                                <th>Tiền thu từ khách</th>
                                <th >Lý do thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                            @if(isset($pt))
                            <?php $l = DB::table('lydo')->where('id',$pt->ly_do_thu)->first();
                            ?>
                                <td>{{number_format($pt->tien_thu)}} </td>
                                <td>{{$l->mo_ta}}</td>
                            @else
                                <td>
                                  <input type="hidden" name="idkh" class="form-control" value="{{$khachhang->id}}">
                                  <input type="text" name="tienthu" class="form-control" placeholder="Nhập số tiền thu từ khách" required>
                                  <span style="color: red; font-style: italic;" class="error error-manv"></span>
                                </td>
                                <td>
                                <select  name="lydo"  class="form-control">
                                      <option value="">--Chọn lý do thu--</option>
                                      @foreach($lydo as $ld)
                                          <option value="{{$ld->id}}">{{$ld->mo_ta}}</option>
                                      @endforeach 
                                </select>
                                </td>
                            @endif
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer" >
                        @if(isset($pt))
                        <a href="{!! URL::route('admin.phieuthu.pdfkh', $pt->id ) !!}" 
                        type="button" class="btn btn-default" 
                        data-toggle="tooltip" data-placement="left" 
                        title="In phiếu thu">
                            <i class="fa fa-print"></i>
                        </a>
                        @else
                        <button type="submit" class="btn btn-primary btn-sm" ><i
                                class="fa fa-check"></i> Lưu
                        </button>
                        @endif
                        <a href="{!! URL::route('admin.khachhang.list') !!}" type="button" class="btn btn-default btn-sm" ><i
                                class="fa fa-undo"></i> Bỏ qua
                        </a>
                    </div>
                </form>
                </div>
            </div>
          </section>
@endsection