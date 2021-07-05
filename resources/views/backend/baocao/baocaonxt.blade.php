@extends('backend.layout')
@section('content')  
    <div class="row">
      <div class="col-sm-12">
          <section class="panel" >
          <div style="margin-left:10px;margin-top:25px;font-size:16px;color:blue">
            <b ><span >Công ty cổ phần xây dựng KSD</span></b><br>
            Thành phố Hải Dương<br>
            Số điện thoại: 0123456789<br>
            Website: http://localhost/congtycophanxaydungKSD/
          </div><hr>
          <center><a href="{!! URL::route('admin.thongke.congno') !!}"><h2 style="color:red"><b>BÁO CÁO NHẬP, XUẤT, TỒN</b></h2></a></center><hr>
            <div class="panel-body">
                <div class="adv-table">
                <table >
                  <thead>
                    <tr class="text-center">
                      <td style="border:thin solid;" width="10px" rowspan="2"><strong>STT</strong></td>
                      <td style="border:thin solid;" width="70px" rowspan="2"><strong>Mã số</strong></td>
                      <td style="border:thin solid;" width="200px" rowspan="2"><strong>Tên khách hàng</strong></td>
                      <td style="border:thin solid;" width="300px" colspan="2"><strong>Số dư đầu kỳ</strong>
                      </td>
                      <td style="border:thin solid;" width="300px" colspan="2"><strong>Số phát sinh trong kỳ</strong></td>
                      <td style="border:thin solid;" width="300px" colspan="2"><strong>Số dư cuối kỳ</strong></td>
                    </tr>
                    <tr class="text-center">
                      <td style="border:thin solid;" width="150px">Nợ</td>
                      <td style="border:thin solid;" width="150px">Có</td>
                      <td style="border:thin solid;"width="150px">Nợ</td>
                      <td style="border:thin solid;"width="150px">Có</td>
                      <td style="border:thin solid;"width="150px">Nợ</td>
                      <td style="border:thin solid;"width="150px">Có</td>
                    </tr>
                    
                  </thead>
                  <tbody>

                        <tr >
                          <td style="border:thin blue solid;border-style:dashed;"></td>
                          <td style="border:thin blue solid;border-style:dashed;"></td>
                          <td style="border:thin blue solid;border-style:dashed;"></td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right"></td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right"></td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right"></td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right"></td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right"></td>
                          <td style="border:thin blue solid;border-style:dashed;" class="text-right"></td>
                      </tr>
                  </tbody>
                </table>
                </div>
            </div>
          </section>
@endsection