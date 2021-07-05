<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\ThuKhachmua;
use App\ThuKhachhang;
use Auth;
use PDF;
use DB;

class PhieuthuController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    /////khách tại cửa hàng
    public function getphieuthukm($id)
    {
        $khachmua = DB::table('khachmua')->where('id',$id)->first();
        $lydo = DB::table('lydo')->get();
        return view('backend.khachmua.phieuthu',compact('khachmua','lydo'));
    }
    public function postphieuthukm(Request $request)
    {
        $thu = new ThuKhachmua;
        $thu->id = $request->id;
        $thu->user_id = Auth::user()->id;
        $thu->khachmua_id = $request->idkm;
        $thu->tien_thu = $request->tienthu;
        $thu->ly_do_thu = $request->lydo;
        $thu->save();
        $pt = DB::table('thukm')->where('id',$thu->id)->first();
        $khachmua = DB::table('khachmua')->where('id',$pt->khachmua_id)->first();
        DB::table('khachmua')->where('id',$pt->khachmua_id)->update([
            'khachmua_phat_sinh_co'=>$khachmua->khachmua_phat_sinh_co + $pt->tien_thu,
        ]);
        $a = ($khachmua->khachmua_tonno_dk + $khachmua->khachmua_phat_sinh_no) - ($khachmua->khachmua_tonco_dk + $khachmua->khachmua_phat_sinh_co + $pt->tien_thu);
        if($a > 0){
            DB::table('khachmua')->where('id',$khachmua->id)->update([
                'khachmua_tonno_ck'=> $a,
                'khachmua_tonco_ck'=> 0,
            ]);
        }
        else{
            DB::table('khachmua')->where('id',$khachmua->id)->update([
                'khachmua_tonno_ck'=> 0,
                'khachmua_tonco_ck'=> - $a,
            ]);
        }
        return view('backend.khachmua.phieuthu',compact('pt','khachmua'));
    }
    public function pdfkm($id)
    {
        $pt = DB::table('thukm')->where('id',$id)->first();
        $khachmua = DB::table('khachmua')->where('id',$pt->khachmua_id)->first();
        $ld = DB::table('lydo')->where('id',$pt->ly_do_thu)->first();
        // print_r($khachmua);
        $pdf = PDF::loadView('admin.phieuthukm',compact('pt','khachmua','ld'));
        return $pdf->stream();
    }
    /////khách trên website
    public function getphieuthukh($id)
    {
        $khachhang = DB::table('khachhang')->where('id',$id)->first();
        $lydo = DB::table('lydo')->get();
        return view('backend.khachhang.phieuthu',compact('khachhang','lydo'));
    }
    public function postphieuthukh(Request $request)
    {
        $thu = new ThuKhachhang;
        $thu->id = $request->id;
        $thu->user_id = Auth::user()->id;
        $thu->khachhang_id = $request->idkh;
        $thu->tien_thu = $request->tienthu;
        $thu->ly_do_thu = $request->lydo;
        $thu->save();
        $pt = DB::table('thukh')->where('id',$thu->id)->first();
        $khachhang = DB::table('khachhang')->where('id',$pt->khachhang_id)->first();
        DB::table('khachhang')->where('id',$pt->khachhang_id)->update([
            'khachhang_phat_sinh_co'=>$khachhang->khachhang_phat_sinh_co + $pt->tien_thu,
        ]);
        $a = ($khachhang->khachhang_tonno_dk + $khachhang->khachhang_phat_sinh_no) - ($khachhang->khachhang_tonco_dk + $khachhang->khachhang_phat_sinh_co + $pt->tien_thu);
        if($a > 0){
            DB::table('khachhang')->where('id',$khachhang->id)->update([
                'khachhang_tonno_ck'=> $a,
                'khachhang_tonco_ck'=> 0,
            ]);
        }
        else{
            DB::table('khachhang')->where('id',$khachhang->id)->update([
                'khachhang_tonno_ck'=> 0,
                'khachhang_tonco_ck'=> - $a,
            ]);
        }
        return view('backend.khachhang.phieuthu',compact('pt','khachhang'));
    }
    public function pdfkh($id)
    {
        $pt = DB::table('thukh')->where('id',$id)->first();
        $khachhang = DB::table('khachhang')->where('id',$pt->khachhang_id)->first();
        $lydo = DB::table('lydo')->where('id',$pt->ly_do_thu)->first();
        // print_r($khachmua);
        $pdf = PDF::loadView('admin.phieuthukh',compact('pt','khachhang','lydo'));
        return $pdf->stream();
    }
}
