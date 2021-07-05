<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB,Mail;
use App\Ban;
use App\Khachmua;
use App\ThuKhachmua;
use App\Donban;
use App\Chitietdonban;
use App\Http\Requests\ThanhtoanRequest;
use Cart;
use Auth;
use Session;
session_start();
class BanhangController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function getList()
    {

        $data = DB::table('sanpham')->orderBy('id','DESC')->get();
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();
    	return view('backend.bannoibo.banhang',compact('data','khuyenmai'));
    }
    
    public function AddBan(Request $req, $id){

        $sanpham = DB::select('select * from sanpham where id = ?',[$id]);
        // print_r($sanpham);
        if ($sanpham[0]->sanpham_khuyenmai == 1) {
            $bansanpham = DB::select('select sp.id,sp.sanpham_ten,sp.sanpham_gia_ban,lh.lohang_ky_hieu,sp.id, km.khuyenmai_phan_tram, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc, sanphamkhuyenmai as spkm, khuyenmai as km  where km.khuyenmai_tinh_trang = 1 and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and ncc.id = lh.nhacungcap_id and lh.lohang_so_luong_hien_tai > 0 and lh.sanpham_id = sp.id and sp.id = ?', [$id]);
            $giakm = $bansanpham[0]->sanpham_gia_ban - $bansanpham[0]->sanpham_gia_ban*$bansanpham[0]->khuyenmai_phan_tram*0.01;

            if(!$sanpham) {
                abort(404);
            }
            $ban = session()->get('ban');
            if(!$ban) {
                $ban = [$id => ["name" => $bansanpham[0]->sanpham_ten,"quantity" => 1, "price" => $giakm]];
                session()->put('ban', $ban);
                alert()->success('Sản phẩm đã được thêm vào đơn hàng.','Thông báo');
                return redirect::back();
            }
            if(isset($ban[$id])) {
                $ban[$id]['quantity']++;
                session()->put('ban', $ban);
                alert()->success('Sản phẩm đã được thêm vào đơn hàng.','Thông báo');
                return redirect::back();
            }
            // if item not exist in cart then add to cart with quantity = 1
            $ban[$id] = [ "name" => $bansanpham[0]->sanpham_ten, "quantity" => 1, "price" => $giakm ];
            session()->put('ban', $ban);
            alert()->success('Sản phẩm đã được thêm vào đơn hàng.','Thông báo');
            return redirect::back();

        } else {
            $bansanpham = DB::select('select sp.id,sp.sanpham_ten,sp.sanpham_gia_ban,lh.lohang_ky_hieu, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc  where ncc.id = lh.nhacungcap_id and lh.sanpham_id = sp.id and lh.lohang_so_luong_hien_tai > 0 and sp.id = ?',[$id]);
            $gia = $bansanpham[0]->sanpham_gia_ban;

            if(!$sanpham) {
                abort(404);
            }
            $ban = session()->get('ban');
            if(!$ban) {
                $ban = [$id => ["name" => $bansanpham[0]->sanpham_ten,"quantity" => 1, "price" => $gia]];
                session()->put('ban', $ban);
                alert()->success('Sản phẩm đã được thêm vào đơn hàng.','Thông báo');
                return redirect::back();
            }
            if(isset($ban[$id])) {
                $ban[$id]['quantity']++;
                session()->put('ban', $ban);
                alert()->success('Sản phẩm đã được thêm vào đơn hàng.','Thông báo');
                return redirect::back();
            }
            // if item not exist in cart then add to cart with quantity = 1
            $ban[$id] = [ "name" => $bansanpham[0]->sanpham_ten, "quantity" => 1, "price" => $gia ];
            session()->put('ban', $ban);
            // dd(Session('ban'));
            alert()->success('Sản phẩm đã được thêm vào đơn hàng.','Thông báo');
            return redirect::back();
        }
    }
    public function dsdonhang(){

        return view('backend.bannoibo.donhang');
    }
    public function capnhat(Request $request)
    {
        if($request->id)
        {
               
            $ban = session()->get('ban');
 
            $ban[$request->id]["quantity"] = $request->quantity;
            session()->put('ban', $ban);
 
            alert()->success('Cập nhật thành công.','Thông báo');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
 
            $ban = session()->get('ban');
 
            if(isset($ban[$request->id])) {
 
                unset($ban[$request->id]);
 
                session()->put('ban', $ban);
            }
            alert()->success('Xóa thành công.','Thông báo');
        }
    }
    public function getthanhtoan(){
        $khachmua = DB::table('khachmua')->get();
        $lydo = DB::table('lydo')->get();
        return view('backend.bannoibo.thanhtoan',compact('khachmua','lydo'));
    }
    public function postthanhtoan(ThanhtoanRequest $request)
    {
        $ban = session()->get('ban');
        $total = 0;
        foreach(session('ban') as $id => $details)
        $total += $details['price'] * $details['quantity'];

        $kh = DB::table('khachmua')->where('id', $request->txtKHID)->first();
        // $d = DB::table('donban')->select('khachmua_id')->where('khachmua_id',$kh->id)->get();
        // $c = count($d);
        // if($c >= 1){
        // $don = DB::table('donban')->where('khachmua_id',$kh->id)->update(
        //     [
        //         'donban_trang_thai' => 1,
        //     ]
        // );
        // }        
        $p=$kh->khachmua_phat_sinh_co;
        $thu = new ThuKhachmua;
        $thu->user_id = Auth::user()->id;
        $thu->khachmua_id = $kh->id;
        $thu->tien_thu = $request->tienthu;
        $thu->ly_do_thu = $request->lydo;
        $thu->save();
        $pt = DB::table('thukm')->where('id',$thu->id)->first();
        DB::table('khachmua')->where('id',$kh->id)->update([
            'khachmua_phat_sinh_no'=> $kh->khachmua_phat_sinh_no + $total,
            'khachmua_phat_sinh_co'=>$kh->khachmua_phat_sinh_co + $pt->tien_thu,
        ]);
        $a = ($kh->khachmua_tonno_dk + $kh->khachmua_phat_sinh_no + $total) - ($kh->khachmua_tonco_dk + $kh->khachmua_phat_sinh_co + $pt->tien_thu);
        if($a > 0){
            DB::table('khachmua')->where('id',$kh->id)->update([
                'khachmua_tonno_ck'=> $a,
                'khachmua_tonco_ck'=> 0,
            ]);
        }
        else{
            DB::table('khachmua')->where('id',$kh->id)->update([
                'khachmua_tonno_ck'=> 0,
                'khachmua_tonco_ck'=> - $a,
            ]);
        }
        $donban = new Donban;
        $donban->donban_nguoi_nhan = $request->txtNNName;
        $donban->donban_nguoi_nhan_email = $request->txtNNEmail;
        $donban->donban_nguoi_nhan_sdt = $request->txtNNPhone;
        $donban->donban_nguoi_nhan_dia_chi = $request->txtNNAddr;
        $donban->donban_ghi_chu = $request->txtNNNote;
        $donban->donban_tong_tien =$total;
        $donban->donban_ngay_ban = date('Y-m-d');
        $donban->khachmua_id = $request->txtKHID;
        $donban->user_id = Auth::user()->id;
        $donban->tinhtranghd_id = 1;
        $donban->save();
        foreach ($ban as $key =>$value) {
            $detail = new Chitietdonban;
            $detail->sanpham_id = $key;
            $detail->donban_id = $donban->id;
            $detail->chitietdonban_so_luong = $value['quantity'];
            $detail->chitietdonban_thanh_tien = $value['quantity']*$value['price'];
            $detail->save();
        }    
        $donban = [
            'id'=> $donban->id,
            'donban_nguoi_nhan'=> $request->txtNNName,
            'donban_nguoi_nhan_email' => $request->txtNNEmail,
            'donban_nguoi_nhan_sdt' => $request->txtNNPhone,
            'donban_nguoi_nhan_dia_chi' => $request->txtNNAddr,
            'donban_ghi_chu' => $request->txtNNNote,
            'donban_tong_tien' => $total,
            'khachmua_id' => $request->txtKHID,
            'khachmua_email'=>$kh->khachmua_email,
            ];
        // print_r($donban);
        Mail::send('auth.emails.hoadonban', $donban, function ($message) use ($donban) {
            $message->from('huyennguyenhn9595@gmail.com', 'ADMIN');
        
            $message->to($donban['khachmua_email'], 'a');
        
            $message->subject('Hóa đơn mua hàng tại Công ty cổ phần xây dựng KSD!!!');
        });

        Mail::send('auth.emails.hoadonban', $donban, function ($message) use ($donban) {
            $message->from('huyennguyenhn9595@gmail.com', 'ADMIN');
        
            $message->to('huyennguyenhn9595@gmail.com', 'KHÁCH HÀNG');
        
            $message->subject('Hóa đơn mua hàng tại Cửa hàng Công ty cổ phần xây dựng KSD!!!');
        });
        Session::forget('ban');
        alert()->success('Đơn hàng đã được thực hiện thành công.','Thông báo');
        return Redirect::route('admin.bannoibo.list');
    }

}
