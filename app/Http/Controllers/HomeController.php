<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB,Cart,Mail;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Donhang;
use App\Quangcaoo;
use App\Binhluan;
use App\Vechungtoi;
use App\Chitietdonhang;
use App\Http\Requests\ThanhtoanRequest;
use App\Http\Requests\BinhluanRequest;
use Session;
session_start();
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(){
        $data2 = DB::table('sanphamkhuyenmai')->join('khuyenmai','khuyenmai.id','=','sanphamkhuyenmai.khuyenmai_id')->join('sanpham','sanpham.id','=','sanphamkhuyenmai.sanpham_id')->select('khuyenmai.created_at','khuyenmai.khuyenmai_thoi_gian','khuyenmai.khuyenmai_tinh_trang','sanphamkhuyenmai.khuyenmai_id','sanphamkhuyenmai.sanpham_id','sanpham.sanpham_khuyenmai')->where('sanpham_khuyenmai',1)->get();
        // dd($data2);
        foreach ($data2 as  $item) {
            $today  = date("Y-m-d"); // Năm/Tháng/Ngày
            $ngaybd =  date("Y-m-d", strtotime("$item->created_at")); // Năm/Tháng/Ngày
            $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $item->khuyenmai_thoi_gian  day"));
            if ( (strtotime($today) >= strtotime($ngaybd)) && (strtotime($today) <= strtotime($ngaykt)) )
            {      
                DB::table('sanpham')->where('id',$item->sanpham_id)->update(['sanpham_khuyenmai'=>1]);
                DB::table('khuyenmai') ->where('id',$item->khuyenmai_id)->update([ 'khuyenmai_tinh_trang' => 1 ]);
            } else{
                DB::table('sanpham')->where('id',$item->sanpham_id)->update(['sanpham_khuyenmai'=>0]);
                DB::table('khuyenmai') ->where('id',$item->khuyenmai_id)->update([ 'khuyenmai_tinh_trang' => 0]);
            }
        }
        /////////////////////////////////////////
        $slider = DB::table('slider')->paginate(1000);
        $loaisanpham =  DB::table('loaisanpham')->paginate(1000);
        $sanpham = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('SUM(lohang_so_luong_hien_tai) as sl'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_gia_ban','sanpham.sanpham_mo_ta','sanpham.sanpham_url','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai')->where('lohang_so_luong_hien_tai','>','0')
                ->groupBy('sanpham.id')
                ->orderBy('id','DESC')
            ->paginate(1000);
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();

        $nhom = DB::table('nhom')->get();
        $tintuc = DB::table('vechungtoi')->get();   
        return view ('pages.trangchinh',compact('slider','loaisanpham','sanpham','khuyenmai','nhom','tintuc'));
    }
    public function shop(Request $request)
    {
        $sanpham = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('SUM(lohang_so_luong_hien_tai) as sl'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_gia_ban','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai')->where('lohang_so_luong_hien_tai','>','0')->groupBy('sanpham.id')
                ->orderBy('id','DESC')
                ->paginate(9);
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();
                // print_r($loaisp);
        $g = $sanpham->where('sanpham_gia_ban','<',100000);
        return view ('pages.home',compact('loaisp','sanpham','khuyenmai'));
    }
    public function nhomsp($url)
    {
        $id = DB::table('nhom')->select('id')->where('nhom_url',$url)->first();
        $i = $id->id;
        $id = DB::table('loaisanpham')->select('id')->where('nhom_id',$i)->get();
        foreach ($id as $key => $val) {
            $ids[] = $val->id;
        }
        $nhom = DB::table('nhom')->where('id',$i)->first();
        $sanpham = DB::table('sanpham')
            ->whereIn('sanpham.loaisanpham_id',$ids)
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('min(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_gia_ban','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai')->where('lohang_so_luong_hien_tai','>','0')
            ->groupBy('sanpham.id')
            ->paginate(9);
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();
        return view('pages.nhomsp',compact('sanpham','nhom','khuyenmai'));
    }

    public function loaisp($url)
    {
        $idLSP = DB::table('loaisanpham')->select('id')->where('loaisanpham_url',$url)->first();
        $i = $idLSP->id;
        $loaisanpham = DB::table('loaisanpham')->where('id',$i)->first();
        $sanpham = DB::table('sanpham')
            ->where('sanpham.loaisanpham_id',$i)
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('min(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_gia_ban','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai')->where('lohang_so_luong_hien_tai','>','0')
                ->groupBy('sanpham.id')
            ->paginate(9);
        $nhom = DB::table('nhom')->where('id',$loaisanpham->nhom_id)->first();
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();
        return view('pages.loaisp',compact('sanpham','loaisanpham','nhom','khuyenmai'));
    }

    public function getlienhe()
    {
        return view ('pages.lienhe');
    }

    public function postlienhe(Request $request)
    {
        $data = ['mail'=>Request::input('txtMail'),'name'=>Request::input('txtName'),'content'=>Request::input('txtContent')];
        Mail::send('auth.emails.layoutmail', $data, function ($message) {
            $message->from('huyennguyenhn9595@gmail.com', 'Khách hàng');
        
            $message->to('huyennguyenhn9595@gmail.com', 'Admin');
        
            $message->subject('Mail liên hệ!!!');
        });

        echo "<script>
         alert('Cảm ơn bạn đã góp ý! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất');
         window.location='".url('/')."'
        </script>";
    }
    public function chitietsp($url)
    {
        $idLSP = DB::table('sanpham')->select('id')->where('sanpham_url',$url)->first();
        $id = $idLSP->id;
        $sanpham = DB::table('sanpham')
            ->where('sanpham.id',$id)
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->join('donvitinh','sanpham.donvitinh_id', '=', 'donvitinh.id' )
            ->join('loaisanpham','sanpham.loaisanpham_id' , '=', 'loaisanpham.id')
            ->select(DB::raw('SUM(lohang_so_luong_hien_tai) as sl'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_gia_ban','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','donvitinh.donvitinh_ten','loaisanpham.loaisanpham_ten','sanpham.loaisanpham_id','sanpham.sanpham_anh','sanpham.sanpham_mo_ta')->where('lohang_so_luong_hien_tai','>','0')
            ->groupBy('sanpham.id')
            ->first();
            $loaisanpham = DB::table('loaisanpham')->where('id',$sanpham->loaisanpham_id)->first();
            $nhom = DB::table('nhom')->where('id',$loaisanpham->nhom_id)->first();
            $binhluan = DB::table('binhluan')->where([['sanpham_id',$id],['binhluan_trang_thai',1],])->get();
            $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();
            $splienquan = DB::table('sanpham')
            ->where('sanpham.loaisanpham_id',$loaisanpham->id)->whereNotIn('sanpham.sanpham_url',[$url])->get();
        
        return view('pages.chitietsp',compact('sanpham','loaisanpham','nhom','binhluan','splienquan','khuyenmai'));
        // print_r($loaisanpham);
    }

    public function mua(Request $req, $id){

        $sanpham = DB::select('select * from sanpham where id = ?',[$id]);
        // print_r($sanpham);
        if ($sanpham[0]->sanpham_khuyenmai == 1) {
            $muasanpham = DB::select('select sp.id,sp.sanpham_ten,sp.sanpham_anh,sp.sanpham_gia_ban,lh.lohang_ky_hieu,  sp.id, km.khuyenmai_phan_tram, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc, sanphamkhuyenmai as spkm, khuyenmai as km  where km.khuyenmai_tinh_trang = 1 and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and ncc.id = lh.nhacungcap_id and lh.lohang_so_luong_hien_tai > 0 and lh.sanpham_id = sp.id and sp.id = ?', [$id]);
            $giakm = $muasanpham[0]->sanpham_gia_ban - $muasanpham[0]->sanpham_gia_ban*$muasanpham[0]->khuyenmai_phan_tram*0.01;

            if(!$sanpham) {
                abort(404);
            }
            $mua = session()->get('mua');
            if(!$mua) {
                $mua = [$id => ["name" => $muasanpham[0]->sanpham_ten,"quantity" => 1, "price" => $giakm]];
                session()->put('mua', $mua);
                alert()->success('Sản phẩm đã được thêm vào giỏ hàng.','Thông báo');
                return redirect::back();
            }
            if(isset($mua[$id])) {
                $mua[$id]['quantity']++;
                session()->put('mua', $mua);
                alert()->success('Sản phẩm đã được thêm vào giỏ hàng.','Thông báo');
                return redirect::back();
            }
            // if item not exist in cart then add to cart with quantity = 1
            $mua[$id] = [ "name" => $muasanpham[0]->sanpham_ten, "quantity" => 1, "price" => $giakm ];
            session()->put('mua', $mua);
            alert()->success('Sản phẩm đã được thêm vào giỏ hàng.','Thông báo');
            return redirect::back();

        } else {
            $muasanpham = DB::select('select sp.id,sp.sanpham_ten,sp.sanpham_anh,sp.sanpham_gia_ban,lh.lohang_ky_hieu,  min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc  where ncc.id = lh.nhacungcap_id and lh.sanpham_id = sp.id and lh.lohang_so_luong_hien_tai > 0 and sp.id = ?',[$id]);
            $gia = $muasanpham[0]->sanpham_gia_ban;

            if(!$sanpham) {
                abort(404);
            }
            $mua = session()->get('mua');
            if(!$mua) {
                $mua = [$id => ["name" => $muasanpham[0]->sanpham_ten,"quantity" => 1, "price" => $gia]];
                session()->put('mua', $mua);
                alert()->success('Sản phẩm đã được thêm vào giỏ hàng.','Thông báo');
                return redirect::back();
            }
            if(isset($mua[$id])) {
                $mua[$id]['quantity']++;
                session()->put('mua', $mua);
                alert()->success('Sản phẩm đã được thêm vào giỏ hàng.','Thông báo');
                return redirect::back();
            }
            // if item not exist in cart then add to cart with quantity = 1
            $mua[$id] = [ "name" => $muasanpham[0]->sanpham_ten, "quantity" => 1, "price" => $gia ];
            session()->put('mua', $mua);
            // dd(Session('mua'));
            alert()->success('Sản phẩm đã được thêm vào giỏ hàng.','Thông báo');
            return redirect::back();
        }
    }
    public function giohang()
    {
        return view('pages.giohang');
    }

    public function capnhat(Request $request)
    {
        if($request->id)
        {
               
            $mua = session()->get('mua');
 
            $mua[$request->id]["quantity"] = $request->quantity;
            session()->put('mua', $mua);
 
            alert()->success('Cập nhật thành công.');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
 
            $mua = session()->get('mua');
 
            if(isset($mua[$request->id])) {
 
                unset($mua[$request->id]);
 
                session()->put('mua', $mua);
            }
            alert()->success('Xóa sản phẩm trong giỏ hàng thành công.');
        }
    }
    public function getCheckin()
    {
        return view('pages.thanhtoan');
    }
    public function postCheckin(ThanhtoanRequest $request)
    {
        $mua = session()->get('mua');
        $total = 0;
        foreach(session('mua') as $id => $details)
        $total += $details['price'] * $details['quantity'];
        $kh = DB::table('khachhang')->where('id', $request->txtKHID)->first();

        $donhang = new Donhang;
        $donhang->donhang_nguoi_nhan = $request->txtNNName;
        $donhang->donhang_nguoi_nhan_email = $request->txtNNEmail;
        $donhang->donhang_nguoi_nhan_sdt = $request->txtNNPhone;
        $donhang->donhang_nguoi_nhan_dia_chi = $request->txtNNAddr;
        $donhang->donhang_ghi_chu = $request->txtNNNote;
        $donhang->donhang_tong_tien = $total;
        $donhang->donhang_ngay_ban = date('Y-m-d');
        $donhang->khachhang_id = $request->txtKHID;
        $donhang->tinhtranghd_id = 1;
        $donhang->save();
        

        foreach ($mua as $key =>$value) {
            $detail = new Chitietdonhang;
            $detail->sanpham_id = $key;
            $detail->donhang_id = $donhang->id;
            $detail->chitietdonhang_so_luong = $value['quantity'];
            $detail->chitietdonhang_thanh_tien = $value['quantity']*$value['price'];
            $detail->save();
        }
        // print_r($kh);
        $donhang = [
            'id'=> $donhang->id,
            'donhang_nguoi_nhan'=> $request->txtNNName,
            'donhang_nguoi_nhan_email' => $request->txtNNEmail,
            'donhang_nguoi_nhan_sdt' => $request->txtNNPhone,
            'donhang_nguoi_nhan_dia_chi' => $request->txtNNAddr,
            'donhang_ghi_chu' => $request->txtNNNote,
            'donhang_tong_tien' => $total,
            'khachhang_id' => $request->txtKHID,
            'khachhang_email'=>$kh->khachhang_email,
            ];
        // print_r($donhang);
        Mail::send('auth.emails.hoadon', $donhang, function ($message) use ($donhang) {
            $message->from('huyennguyenhn9595@gmail.com', 'ADMIN');
        
            $message->to($donhang['khachhang_email'], 'a');
        
            $message->subject('Hóa đơn mua hàng tại Công ty cổ phần xây dựng KSD!!!');
        });

        Mail::send('auth.emails.hoadon', $donhang, function ($message) use ($donhang) {
            $message->from('huyennguyenhn9595@gmail.com', 'ADMIN');
        
            $message->to('huyennguyenhn9595@gmail.com', 'KHÁCH HÀNG');
        
            $message->subject('Hóa đơn mua hàng tại Cửa hàng Công ty cổ phần xây dựng KSD!!!');
        });

        Session::forget('mua');
        alert()->success('Bạn đã đặt mua sản phẩm thành công.','Thông báo');
        return redirect('/');
    }

    public function postComment(BinhluanRequest $request)
    {
        $binhluan = new Binhluan;
        $binhluan->binhluan_ten = $request->txtName;
        $binhluan->binhluan_email = $request->txtEmail;
        $binhluan->binhluan_noi_dung = $request->txtContent;
        $binhluan->binhluan_trang_thai = 0;
        $binhluan->sanpham_id = $request->txtID;
        $binhluan->save();
         echo "<script>
          alert('Cảm ơn bạn đã góp ý!');
          window.location = '".url('/')."';</script>";
    }

    public function bando(){
        return view ('pages.bando');
    }
    public function gioithieu(){
        return view ('pages.gioithieu');
    }
    public function chinhsachbm(){
        return view ('pages.chinhsachbm');
    }
    public function History($id){
        $khachhang = DB::table('khachhang')->where('user_id',$id)->first();
        if (!is_null($khachhang)){
        $idkh = $khachhang->id;
        $donhang = DB::table('donhang')->where('khachhang_id',$idkh)->get();
    }
        return view('pages.lichsumuahang',compact('khachhang','donhang'));
    }
    public function myNotification($type)
    {
        switch ($type) {
            case 'message':
                alert()->message('Sweet Alert with message.');
                break;
            case 'basic':
                alert()->basic('Sweet Alert with basic.','Basic');
                break;
            case 'info':
                alert()->info('Sweet Alert with info.');
                break;
            case 'success':
                alert()->success('Sweet Alert with success.','Welcome to ItSolutionStuff.com')->autoclose(3500);
                break;
            case 'error':
                alert()->error('Sweet Alert with error.');
                break;
            case 'warning':
                alert()->warning('Sweet Alert with warning.');
                break;
            default:
                # code...
                break;
        }
        return view('my-notification');
    }
    public function tintuc(){
        $data = DB::table('vechungtoi')->get();
    	return view('pages.tintuc',compact('data'));
    }
    public function chitiet($url){
        $chitiet = DB::table('vechungtoi')->where('vechungtoi_url',$url)->first();
        return view('pages.tintuc',compact('chitiet'));
    }
}
