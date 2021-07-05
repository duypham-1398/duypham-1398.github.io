<?php

namespace App\Http\Controllers;

use Request;
use DB;

class TimkiemController extends Controller
{
    //
    public function gettimkiem()
    {
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();
        dd($khuyenmai);
        return view('pages.timkiem',compact('khuyenmai'));
    }

    public function posttimkiem()
    {
        $keyword = Request::input('timkiem');
        $sanpham = DB::table('sanpham')
            ->where('sanpham_ten','like','%'.$keyword.'%')
            ->orWhere('sanpham_gia_ban','like','%'.$keyword.'%')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('min(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_url','sanpham.sanpham_ten','sanpham.sanpham_gia_ban','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai')->where('lohang.lohang_so_luong_hien_tai','>', '0')
                ->groupBy('sanpham.id')
            ->paginate(9);
            $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();
        return view('pages.timkiem',compact('sanpham','khuyenmai'));
    }
}
