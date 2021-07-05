<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use PDF;
use Lohang;
use Donban;
use Carbon\Carbon;

class BaocaoController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    public function getList()
    {
      $sl = DB::table('lohang')->join('sanpham','lohang.sanpham_id','=','sanpham.id')
            ->select(DB::raw('SUM(lohang_so_luong_nhap) as nhap'),DB::raw('SUM(lohang_so_luong_hien_tai*lohang_gia_mua_vao) as vtk'),DB::raw('SUM(lohang_so_luong_nhap*sanpham_gia_ban) as gtt'),
	    			 DB::raw('SUM(lohang_so_luong_da_ban) as ban'),
	    			 DB::raw('SUM(lohang_so_luong_hien_tai) as ton'),
	    			 DB::raw('SUM(lohang_so_luong_doi_tra) as tra'))->get();
		 
			$bannhieu = DB::table('lohang')->where('lohang_so_luong_da_ban','>',2)
	   			->select('sanpham_id',
	   				DB::raw('SUM(lohang_so_luong_da_ban) as ban'),
	   				DB::raw('SUM(lohang_so_luong_hien_tai) as ton'))->groupBy('sanpham_id')->orderBy('ban', 'desc')->get();
		 
			$tonnhieu = DB::table('lohang')->where('lohang_so_luong_hien_tai','>',5)->select('sanpham_id',DB::raw('SUM(lohang_so_luong_da_ban) as ban'),
	   				DB::raw('SUM(lohang_so_luong_hien_tai) as ton'))->groupBy('sanpham_id')->orderBy('ton', 'desc')->get();
			 
			$hethan = DB::table('lohang')->where('lohang_tinh_trang',1)->select('sanpham_id','id',
						DB::raw('SUM(lohang_so_luong_da_ban) as ban'),
             DB::raw('SUM(lohang_so_luong_hien_tai) as ton'))->groupBy('sanpham_id')->get();
      $counthethan = DB::table('lohang')->where('lohang_tinh_trang',1)->count();
						 
	   	$conhan = DB::table('lohang')->where('lohang_tinh_trang',NULL)->select('sanpham_id',
	   				'lohang_so_luong_da_ban as ban',
	   				'lohang_so_luong_hien_tai as ton')->get();		
			$chuaban = DB::table('lohang')->where('lohang_so_luong_da_ban',0)->select('sanpham_id',
						'lohang_so_luong_da_ban as ban',
						'lohang_so_luong_hien_tai as ton')->get();	
    	return view('backend.thongke.tongquan',compact('sl','tonnhieu','bannhieu','hethan','conhan','chuaban','counthethan'));
    }

    public function getNhapvao()
    {
			$data = DB::table('lohang')->join('sanpham','sanpham.id','=','lohang.sanpham_id')
			->select('sanpham.*','lohang.*')->get();
	    return view('backend.thongke.sanpham',compact('data'));
    }

    public function getBanra()
    {
			$data = DB::table('lohang')->where('lohang.lohang_so_luong_da_ban','>',0)
			->join('sanpham','sanpham.id','=','lohang.sanpham_id')
      ->select('sanpham.*','lohang.*')->get();
      $data2 = DB::table('lohang')->where('lohang.lohang_so_luong_da_ban','>',0)->get();
	    return view('backend.thongke.sanpham',compact('data','data2'));
    }

    public function getHienco()
    {
			$data = DB::table('lohang')->where('lohang.lohang_so_luong_hien_tai','>',0)
			->join('sanpham','sanpham.id','=','lohang.sanpham_id')
        ->select('sanpham.*','lohang.*')->get();
      $data3 = DB::table('lohang')->where('lohang.lohang_so_luong_hien_tai','>',0)->get();
	    // print_r($data);
	    return view('backend.thongke.sanpham',compact('data','data3'));
    }

    public function getDoitra()
    {
			$data = DB::table('lohang')->where('lohang.lohang_so_luong_doi_tra','>',0)
      ->join('sanpham','sanpham.id','=','lohang.sanpham_id')->select('sanpham.*','lohang.*')->get();
      $data4 = DB::table('lohang')->where('lohang.lohang_so_luong_doi_tra','>',0)->get();
	    return view('backend.thongke.sanpham',compact('data','data4'));
    }

    public function getBanchay()
    {
			$data = DB::table('lohang')->select('sanpham_id','lohang_ky_hieu','lohang_ngay_nhap','lohang_han_su_dung',	DB::raw('SUM(lohang_so_luong_nhap) as nhap'),DB::raw('SUM(lohang_so_luong_da_ban) as ban'),
      DB::raw('SUM(lohang_so_luong_hien_tai) as ton'))->where('lohang_so_luong_da_ban','>',1)->groupBy('sanpham_id')->orderBy('ban', 'desc')->get();
      $data2 = DB::table('lohang')->select(DB::raw('SUM(lohang_so_luong_da_ban) as ban'))->groupBy('sanpham_id')->orderBy('ban', 'desc')->get();
	    return view('backend.thongke.ton',compact('data','data2'));
    }

    public function getTonnhieu()
    {
    	$data = DB::table('lohang')->select('sanpham_id','lohang_ngay_nhap','lohang_han_su_dung','lohang_so_luong_nhap',
	   				DB::raw('SUM(lohang_so_luong_nhap) as nhap'),
	   				DB::raw('SUM(lohang_so_luong_da_ban) as ban'),
	   				DB::raw('SUM(lohang_so_luong_hien_tai) as ton'))
	   			->groupBy('sanpham_id')->orderBy('ton', 'desc')->get();
	    return view('backend.thongke.ton',compact('data'));
    }
    public function getChuaban()
    {
        $data = DB::table('lohang')->where('lohang_so_luong_da_ban',0)->select('sanpham_id','lohang_ngay_nhap','lohang_so_luong_nhap as nhap','lohang_han_su_dung','lohang_so_luong_da_ban as ban','lohang_so_luong_hien_tai as ton')->get();	
        $data1 = DB::table('lohang')->where('lohang_so_luong_da_ban',0)->get();
        return view('backend.thongke.ton',compact('data','data1'));
      }
    public function getHethan()
    {
    	$data = DB::table('lohang')->where('lohang_tinh_trang',1)->select('sanpham_id','lohang_ngay_nhap','lohang_han_su_dung','lohang_so_luong_nhap as nhap','lohang_so_luong_da_ban as ban','lohang_so_luong_hien_tai as ton')->groupBy('sanpham_id')->get();
      $data1 = DB::table('lohang')->where('lohang_tinh_trang',1)->get();
	    return view('backend.thongke.sanpham1',compact('data','data1'));
    }

    public function baocaohethan()
    {
      $data = DB::table('lohang')->where('lohang_tinh_trang',1)->get();
      $tong = DB::table('lohang')->where('lohang_tinh_trang',1)->select(DB::raw('SUM(lohang_so_luong_hien_tai*lohang_gia_mua_vao) as tonthat'),DB::raw('SUM(lohang_so_luong_hien_tai) as slht'))->first();
      $tonglo = DB::table('lohang')->where('lohang_tinh_trang',1)->count();
	    return view('backend.thongke.baocaohethan',compact('data','tonglo','tong'));
    }

    public function getConhan()
    {
    	$data = DB::table('lohang')->where('lohang_tinh_trang',NULL)->select('sanpham_id','lohang_ngay_nhap','lohang_han_su_dung',('lohang_so_luong_nhap as nhap'),('lohang_so_luong_da_ban as ban'),('lohang_so_luong_hien_tai as ton'))->get();
	    return view('backend.thongke.sanpham1',compact('data'));
    }
    ///////////////////////////////////////////////////////
		public function congno()
		{
      $data = DB::table('khachhang')->get();
      $khachmua = DB::table('khachmua')->get();
      
			return view('backend.thongke.congno',compact('data','khachmua'));
    }
    public function tonghopcongno()
		{
      $khachhang = DB::table('khachhang')->get();
      $khachmua = DB::table('khachmua')->get();
      
			return view('backend.thongke.tonghopcongno',compact('khachhang','khachmua'));
    }
    public function congnongay()
		{
      $thu = DB::table('thukh')->get();
      $khachmua = DB::table('khachmua')->get();
      $thu = DB::table('thukh')->select('created_at',DB::raw('SUM(tien_thu) as tongt'))->groupBy('created_at')->orderBy('created_at', 'desc')->get();
      $doanhthu = DB::table('donhang')->select('donhang_ngay_ban','khachhang_id',DB::raw('SUM(donhang_tong_tien) as tongtdh'))->groupBy('donhang_ngay_ban')->orderBy('created_at', 'desc')->where('tinhtranghd_id','>=',2)->where('tinhtranghd_id','!=',3)->get();
      $khachhang = DB::table('khachhang')->get();
			return view('backend.khachhang.congno',compact('thu','doanhthu','khachhang','khachmua'));
    }
    public function congnotuychon(Request $request)
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
				$hn=Carbon::today()->toDateString();
        $bd=$request->tu;
        $kt=$request->den;
        $khachmua = DB::table('khachmua')->get();
        $khachhang = DB::table('khachhang')->get();
        $khachmuatuychon = DB::table('khachmua')->join('donban','donban.khachmua_id','=','khachmua.id')->select('khachmua.id','khachmua.khachmua_ten',DB::raw('SUM(donban_tong_tien) as tt'),'khachmua_tonno_dk','donban_ngay_ban','khachmua_tonco_dk','khachmua_phat_sinh_co','khachmua_tonno_ck','khachmua_tonco_ck')->whereBetween('donban_ngay_ban',[$bd,$kt])->groupBy('khachmua.id')->get();
        return view('backend.khachhang.congno',compact('khachhang','khachmua','doanhthu','tonggt','sodon','dtngaycongno','bd','kt','thang','tuan','khachmuatuychon'));
		}
    ///////////////////////////////////////////////////////
		public function baocao(){
			$donhang = DB::table('donhang')->select('donhang_ngay_ban',DB::raw('SUM(donhang_tong_tien) as tth'),DB::raw('SUM(donhang_tong_tien) as tt'),DB::raw('SUM(donhang_tong_tien - donhang_tong_tien*0.01) as tn'))->where('tinhtranghd_id','=',4)->groupBy('donhang_ngay_ban')->get();

			$donban = DB::table('donban')->select('donban_ngay_ban',DB::raw('SUM(donban_tong_tien) as tth'),DB::raw('SUM(donban_tong_tien) as tt'),DB::raw('SUM(donban_tong_tien - donban_tong_tien*0.01) as tn'))->where('tinhtranghd_id','=',4)->groupBy('donban_ngay_ban')->get();
			$tong = $donhang->sum('tt') + $donban->sum('tt');
			
      $lohangn = DB::table('lohang')->select('id','lohang_ngay_nhap',DB::raw('SUM(lohang_so_luong_nhap) as slnhap'),DB::raw('SUM(lohang_so_luong_doi_tra) as sldoitra'),DB::raw('SUM(lohang_gia_mua_vao*lohang_so_luong_nhap) as tiennh'))->groupBy('lohang_ngay_nhap')->get();

			return view('backend.thongke.baocao',compact('lohangn','donhang','donban','tong'));
    }
    public function dtcuahday(Request $req){
      $result[] = array('donban_tong_tien','donban_ngay_ban');
      $dt = DB::table('donban')->where('donban_ngay_ban',$req->ngayban)->get();
      foreach($dt as $val)
      {
          $result[] = array(
              'donban_ngay_ban' => $val->donban_ngay_ban,
              'donban_tong_tien' => $val->donban_tong_tien,
          );
      }
      return response()->json(['result' => $result]);
    }
		///////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////
    
		public function dtctdonban()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $dtngay = DB::table('donban')->select('donban_ngay_ban','tinhtranghd_id',DB::raw('SUM(donban_tong_tien) as tongt'))->where('tinhtranghd_id','=',4)->groupBy('donban_ngay_ban')->orderBy('donban_ngay_ban', 'desc')->get();
        $doanhthu = DB::table('donban')->orderBy('donban_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = DB::table('donban')->where('tinhtranghd_id','=',4)->count('id');
        return view('backend.thongke.chitietcuahang',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,'thang'=>$thang,'tuan'=>$tuan]);
    }

    public function doanhthungay()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $hn=Carbon::today()->toDateString();
				$dtngay = DB::table('donban')->select('donban_ngay_ban','tinhtranghd_id',DB::raw('SUM(donban_tong_tien) as tongt'))->groupBy('donban_ngay_ban')->orderBy('donban_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->where('donban_ngay_ban','=',$hn)->get();
				$doanhthu = DB::table('donban')->where('tinhtranghd_id','=',4)->where('donban_ngay_ban','=',$hn)->get();
				$tonggt = $dtngay->sum('tongt');
        $sodon = $doanhthu->count('id');
        return view('backend.thongke.chitietcuahang',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,'hn'=>$hn,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function dtdonbantuan()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $a=Carbon::today()->dayOfWeek;
        $bd=Carbon::today()->subDay($a)->toDateString();
        $kt=Carbon::today()->toDateString();
        $dtngay = DB::table('donban')->select('donban_ngay_ban','tinhtranghd_id',DB::raw('SUM(donban_tong_tien) as tongt'))->groupBy('donban_ngay_ban')->orderBy('donban_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->whereBetween('donban_ngay_ban',[$bd,$kt])->get();
        $doanhthu = DB::table('donban')->where('tinhtranghd_id','=',4)->whereBetween('donban_ngay_ban',[$bd,$kt])->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = $doanhthu->count('id');
        return view('backend.thongke.chitietcuahang',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,
        'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function dtdonbanthang()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
				$hn=Carbon::today()->toDateString();
        $a=Carbon::today()->day;
        $bd=Carbon::today()->subDay($a-1)->toDateString();
        $kt=Carbon::today()->toDateString();
        $dtngay = DB::table('donban')->select('donban_ngay_ban','tinhtranghd_id',DB::raw('SUM(donban_tong_tien) as tongt'))->groupBy('donban_ngay_ban')->orderBy('donban_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->whereBetween('donban_ngay_ban',[$bd,$kt])->get();
        $doanhthu = DB::table('donban')->where('tinhtranghd_id','=',4)->whereBetween('donban_ngay_ban',[$bd,$kt])->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = $doanhthu->count('id');
        return view('backend.thongke.chitietcuahang',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,
        'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function dtdonbantuychon(Request $request)
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
				$hn=Carbon::today()->toDateString();
        $bd=$request->tu;
        $kt=$request->den;
        $dtngay =  DB::table('donban')->select('donban_ngay_ban','tinhtranghd_id',DB::raw('SUM(donban_tong_tien) as tongt'))->groupBy('donban_ngay_ban')->orderBy('donban_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->whereBetween('donban_ngay_ban',[$bd,$kt])->get();
        $doanhthu =  DB::table('donban')->where('tinhtranghd_id','=',4)->whereBetween('donban_ngay_ban',[$bd,$kt])->get();
        $tonggt =  $dtngay->sum('tongt');
        $sodon = $doanhthu->count('id');
        return view('backend.thongke.chitietcuahang',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay, 'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
		}
		/////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////
		public function dtctdonhang()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $dtngay = DB::table('donhang')->select('donhang_ngay_ban','tinhtranghd_id',DB::raw('SUM(donhang_tong_tien) as tongt'))->where('tinhtranghd_id','=',4)->groupBy('donhang_ngay_ban')->orderBy('donhang_ngay_ban', 'desc')->get();
        $doanhthu = DB::table('donhang')->orderBy('donhang_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = DB::table('donhang')->where('tinhtranghd_id','=',4)->count('id');
        return view('backend.thongke.chitietwebsite',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,'thang'=>$thang,'tuan'=>$tuan]);
    }

    public function dhdoanhthungay()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $hn=Carbon::today()->toDateString();
				$dtngay = DB::table('donhang')->select('donhang_ngay_ban','tinhtranghd_id',DB::raw('SUM(donhang_tong_tien) as tongt'))->groupBy('donhang_ngay_ban')->orderBy('donhang_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->where('donhang_ngay_ban','=',$hn)->get();
				$doanhthu = DB::table('donhang')->where('tinhtranghd_id','=',4)->where('donhang_ngay_ban','=',$hn)->get();
				$tonggt = $dtngay->sum('tongt');
        $sodon = $doanhthu->count('id');
        return view('backend.thongke.chitietwebsite',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,'hn'=>$hn,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function dtdonhangtuan()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $a=Carbon::today()->dayOfWeek;
        $bd=Carbon::today()->subDay($a)->toDateString();
        $kt=Carbon::today()->toDateString();
        $dtngay = DB::table('donhang')->select('donhang_ngay_ban','tinhtranghd_id',DB::raw('SUM(donhang_tong_tien) as tongt'))->groupBy('donhang_ngay_ban')->orderBy('donhang_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->whereBetween('donhang_ngay_ban',[$bd,$kt])->get();
        $doanhthu = DB::table('donhang')->where('tinhtranghd_id','=',4)->whereBetween('donhang_ngay_ban',[$bd,$kt])->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = $doanhthu->count('id');
        return view('backend.thongke.chitietwebsite',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,
        'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function dtdonhangthang()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
				$hn=Carbon::today()->toDateString();
        $a=Carbon::today()->day;
        $bd=Carbon::today()->subDay($a-1)->toDateString();
        $kt=Carbon::today()->toDateString();
        $dtngay = DB::table('donhang')->select('donhang_ngay_ban','tinhtranghd_id',DB::raw('SUM(donhang_tong_tien) as tongt'))->groupBy('donhang_ngay_ban')->orderBy('donhang_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->whereBetween('donhang_ngay_ban',[$bd,$kt])->get();
        $doanhthu = DB::table('donhang')->where('tinhtranghd_id','=',4)->whereBetween('donhang_ngay_ban',[$bd,$kt])->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = $doanhthu->count('id');
        return view('backend.thongke.chitietwebsite',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,
        'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function dtdonhangtuychon(Request $request)
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
				$hn=Carbon::today()->toDateString();
        $bd=$request->tu;
        $kt=$request->den;
        $dtngay =  DB::table('donhang')->select('donhang_ngay_ban','tinhtranghd_id',DB::raw('SUM(donhang_tong_tien) as tongt'))->groupBy('donhang_ngay_ban')->orderBy('donhang_ngay_ban', 'desc')->where('tinhtranghd_id','=',4)->whereBetween('donhang_ngay_ban',[$bd,$kt])->get();
        $doanhthu =  DB::table('donhang')->where('tinhtranghd_id','=',4)->whereBetween('donhang_ngay_ban',[$bd,$kt])->get();
        $tonggt =  $dtngay->sum('tongt');
        $sodon = $doanhthu->count('id');
        return view('backend.thongke.chitietwebsite',['doanhthu'=>$doanhthu,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay, 'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
		}
		////////////////////////////////////////////
		public function ctnhaphang()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $dtngay = DB::table('lohang')->select('lohang_ngay_nhap','sanpham_id',DB::raw('SUM(lohang_so_luong_nhap*lohang_gia_mua_vao) as tongt'))->groupBy('lohang_ngay_nhap')->orderBy('lohang_ngay_nhap', 'desc')->get();
        $chi = DB::table('lohang')->orderBy('created_at', 'desc')->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = DB::table('lohang')->count('id');
        return view('backend.thongke.chitietlohang',['chi'=>$chi,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,'thang'=>$thang,'tuan'=>$tuan]);
    }

    public function nhngay()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $hn=Carbon::today()->toDateString();
				$dtngay = DB::table('lohang')->select('lohang_ngay_nhap',DB::raw('SUM(lohang_so_luong_nhap*lohang_gia_mua_vao) as tongt'))->groupBy('lohang_ngay_nhap')->orderBy('lohang_ngay_nhap', 'desc')->where('lohang_ngay_nhap','=',$hn)->get();
				$chi = DB::table('lohang')->where('lohang_ngay_nhap','=',$hn)->get();
				$tonggt = $dtngay->sum('tongt');
        $sodon = $chi->count('id');
        return view('backend.thongke.chitietlohang',['chi'=>$chi,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,'hn'=>$hn,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function nhaphangtuan()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
        $a=Carbon::today()->dayOfWeek;
        $bd=Carbon::today()->subDay($a)->toDateString();
        $kt=Carbon::today()->toDateString();
        $dtngay = DB::table('lohang')->select('lohang_ngay_nhap','lohang_so_luong_nhap',DB::raw('SUM(lohang_so_luong_nhap*lohang_gia_mua_vao) as tongt'),DB::raw('SUM(lohang_so_luong_nhap) as tongslngay'))->groupBy('lohang_ngay_nhap')->orderBy('lohang_ngay_nhap', 'desc')->whereBetween('lohang_ngay_nhap',[$bd,$kt])->get();
        $chi = DB::table('lohang')->whereBetween('lohang_ngay_nhap',[$bd,$kt])->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = $chi->count('id');
        return view('backend.thongke.chitietlohang',['chi'=>$chi,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,
        'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function nhaphangthang()
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
				$hn=Carbon::today()->toDateString();
        $a=Carbon::today()->day;
        $bd=Carbon::today()->subDay($a-1)->toDateString();
        $kt=Carbon::today()->toDateString();
        $dtngay = DB::table('lohang')->select('lohang_ngay_nhap',DB::raw('SUM(lohang_so_luong_nhap*lohang_gia_mua_vao) as tongt'))->groupBy('lohang_ngay_nhap')->orderBy('lohang_ngay_nhap', 'desc')->whereBetween('lohang_ngay_nhap',[$bd,$kt])->get();
        $chi = DB::table('lohang')->whereBetween('lohang_ngay_nhap',[$bd,$kt])->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = $chi->count('id');
        return view('backend.thongke.chitietlohang',['chi'=>$chi,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay,
        'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
    }
    public function nhaphangtuychon(Request $request)
    {
				$thang=Carbon::today()->month;
				$tuan=Carbon::today()->weekOfMonth;
				$hn=Carbon::today()->toDateString();
        $bd=$request->tu;
        $kt=$request->den;
        $dtngay =  DB::table('lohang')->select('lohang_ngay_nhap',DB::raw('SUM(lohang_so_luong_nhap*lohang_gia_mua_vao) as tongt'))->groupBy('lohang_ngay_nhap')->orderBy('lohang_ngay_nhap', 'desc')->whereBetween('lohang_ngay_nhap',[$bd,$kt])->get();
        $chi =  DB::table('lohang')->whereBetween('lohang_ngay_nhap',[$bd,$kt])->get();
        $tonggt = $dtngay->sum('tongt');
        $sodon = $chi->count('id');
        return view('backend.thongke.chitietlohang',['chi'=>$chi,'tonggt'=>$tonggt,'sodon'=>$sodon,'dtngay'=>$dtngay, 'bd'=>$bd,'kt'=>$kt,'thang'=>$thang,'tuan'=>$tuan]);
    }
}
