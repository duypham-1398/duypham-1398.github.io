<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>In hóa đơn</title>
    <style>
      body{
        font-family: DejaVu Sans, sans-serif, font-size: 12px;
      }
    </style>
  </head>
  
  <body >
    <div>
      <b><span>Công ty cổ phần xây dựng KSD</span></b><br>
      Thành phố Hải Dương<br>
      Số điện thoại: 0123456789<br>
      Website: http://localhost/congtycophanxaydungKSD/
    </div><hr>
    <center><h2>PHIẾU THU KHÁCH MUA HÀNG TẠI CỬA HÀNG</h2></center>
    
    <table>
      <tr>
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
    <table>
      <tr>
        <td width="120px"><strong>Lý do thu:</strong></td> <td>{!!$lydo->mo_ta!!}</td>
        <td><strong></td>
      </tr>
      <tr>
        <td width="120px"><strong>Tiền thu từ khách:</strong></td> <td> {!! number_format($pt->tien_thu) !!} VND</td>
        <td></td>
      </tr>
    </table><br><br>
    <table style="margin-bottom:-300px;">
      <tr>
        <td width="450px"></td>
        <td>Ngày <?php echo date("d") ?> tháng <?php echo date("m") ?> năm <?php echo date("Y") ?></td>
      </tr>
      <tr>
        <td width="450px" class="customer-title">   <strong>Khách hàng</strong></td>
        <td class="writer-title"><strong>Người lập phiếu</strong></td>
      </tr>
      <tr>
        <td>(Ký và ghi rõ họ tên)</td>
        <td class="writer-name"><span>(Ký và ghi rõ họ tên)</span></td>
      </tr>
    </table>
  </body>
</html>
    
