<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use DB;
use App\Donhang;
use App\Donban;
use Auth;
use Chartjs;

class AdminController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {
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
        //////////////////////////////////////////////////
        
    	$donhang = DB::table('donhang')->where('tinhtranghd_id',1)->count();
    	$luotbinhluan = DB::table('binhluan')->where('binhluan_trang_thai',0)->count();
    	$khachhang = DB::table('khachhang')->count();
    	$sanpham = DB::table('sanpham')->count();
    	$binhluan = DB::table('binhluan')->where('binhluan_trang_thai',0)->get();
    	$bannhieu = DB::table('chitietdonhang')->where('donhang.tinhtranghd_id','=',4)->join('donhang','donhang.id','=','chitietdonhang.donhang_id')->select( 'sanpham_id',DB::raw('SUM(chitietdonhang_so_luong) as ban'),DB::raw('SUM(chitietdonhang_thanh_tien) as tien'))->groupBy('sanpham_id')->orderBy('tien', 'desc')->take(10)->get();
                // print_r($bannhieu);
        $nhapnhieu = DB::table('lohang')->select( 'sanpham_id', DB::raw('SUM(lohang_so_luong_nhap) as nhap'),
                    DB::raw('SUM(lohang_gia_mua_vao*lohang_so_luong_nhap) as tien')) ->groupBy('sanpham_id') ->orderBy('tien', 'desc') ->take(10) ->get();
        $muanhieu = DB::table('donhang')->where('tinhtranghd_id','=',4)->select('khachhang_id', DB::raw('COUNT(khachhang_id) as donhang'), DB::raw('SUM(donhang_tong_tien) as tien')) ->groupBy('khachhang_id') ->orderBy('tien', 'desc') ->take(10)->get(); 
        $muanh = DB::table('donban')->where('tinhtranghd_id','=',4)->select('khachmua_id', DB::raw('COUNT(khachmua_id) as donban'), DB::raw('SUM(donban_tong_tien) as tien')) ->groupBy('khachmua_id') ->orderBy('tien', 'desc')->take(10)->get(); 
        // print_r($nhapnhieu);
        /////////////////////////////////

        $bdban = DB::table('lohang')->join('sanpham','lohang.sanpham_id','=','sanpham.id')->select('sanpham_ten','sanpham_ky_hieu', DB::raw('SUM(lohang_so_luong_da_ban) as soluong'))->groupBy('sanpham_id')->where('lohang_so_luong_da_ban','>',1)->get();
        
        $hoadon = DB::table('donhang')->select('donhang_ngay_ban',DB::raw('SUM(donhang_tong_tien) as DT'),DB::raw('count(id) as SD'))->groupBy('donhang_ngay_ban')->where('tinhtranghd_id','=',4)->get();
        // dd($hoadon);

        $hoadnban = DB::table('donban')->select('donban_ngay_ban',DB::raw('SUM(donban_tong_tien) as DT'),DB::raw('count(id) as SD'))->groupBy('donban_ngay_ban')->where('tinhtranghd_id','=',4)->get();

        $don=Donhang::count('id');
        $tongdt=Donhang::sum('donhang_tong_tien');

        $donb=Donban::count('id');
    	return view('backend.home',compact('donhang','binhluan','khachhang','sanpham','luotbinhluan','bannhieu','nhapnhieu','muanhieu','bdban','hoadon','hoadnban','don','tongdt','donb','muanh'));
    }
    public function theongay(Request $request){
        $bd=Carbon::parse($request->tu)->toDateString();
        $kt=Carbon::parse($request->den)->toDateString();
        $hoadon=Donhang::whereBetween('donhang_ngay_ban',[$bd,$kt])->select('donhang_ngay_ban',DB::raw('SUM(donhang_tong_tien) as DT'),DB::raw('count(id) as SD'))->groupBy('donhang_ngay_ban')->where('tinhtranghd_id','=',4)->get();

        return response()->json(['result' => $hoadon]);
    }
    public function theongaynoibo(Request $request){
        $bd=Carbon::parse($request->tu)->toDateString();
        $kt=Carbon::parse($request->den)->toDateString();
        $hoadnban=Donban::whereBetween('donban_ngay_ban',[$bd,$kt])->select('donban_ngay_ban',DB::raw('SUM(donban_tong_tien) as DT'),DB::raw('count(id) as SD'))->groupBy('donban_ngay_ban')->where('tinhtranghd_id','=',4)->get();

        return response()->json(['result' => $hoadnban]);
    }
}
