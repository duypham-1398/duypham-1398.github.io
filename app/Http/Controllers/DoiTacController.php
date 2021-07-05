<?php
namespace App\Http\Controllers;
use App\Http\Controllers\HangHoaController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Sanpham;
use App\Nhacungcap;
use Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class DoiTacController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
      }
    public function xemnhacungcap(){
        $nhacungcap = Nhacungcap::all();
        return view('backend.nhacc.xemncc',compact('nhacungcap'));
    }
    public function themnhacungcap(){
        if(Auth::user()->id == 1){
            return view('backend.nhacc.themncc');
        }else{
            $nhacungcap = Nhacungcap::all();
            alert()->warning('Bạn không thể thêm nhà cung cấp.','cảnh báo');
            return view('backend.nhacc.xemncc',compact('nhacungcap'));
        }
       
    }
    public function luunhacungcap(Request $request){
        // $this->AuthLogin();
        $nhacc = array();
        $nhacc['id'] = $request->id;
        $nhacc['nhacungcap_ten'] = $request->tenncc;
        $nhacc['nhacungcap_dia_chi'] = $request->diachincc;
        $nhacc['nhacungcap_sdt'] = $request->sdtncc;
        DB::table('nhacungcap')->insert($nhacc);
        alert()->success('Thêm nhà cung cấp thành công.','Thông báo');
    	return Redirect::to('xemncc');
    }
    public function suanhacungcap($id){
        if(Auth::user()->id == 1){
            $nhacc = DB::table('nhacungcap')->where('id',$id)->get();
            return view('backend.nhacc.suancc',compact('nhacc'));    
        }else{
            $nhacungcap = Nhacungcap::all();
            alert()->warning('Bạn không thể sửa nhà cung cấp.','cảnh báo');
            return view('backend.nhacc.xemncc',compact('nhacungcap'));
        }
    }
    public function capnhatnhacungcap(Request $request, $id)
    { 
        $nhacc = array();
        $nhacc['id'] = $request->id;
        $nhacc['nhacungcap_ten'] = $request->tenncc;
        $nhacc['nhacungcap_dia_chi'] = $request->diachincc; 
        $nhacc['nhacungcap_sdt'] = $request->sdtncc; 
        DB::table('nhacungcap')->where('id',$id)->update($nhacc);
        alert()->success('Cập nhật nhà cung cấp thành công.','Thông báo');
        return Redirect::to('xemncc');
    }
    public function xoanhacungcap($id){

        if(Auth::user()->id == 1){
            DB::table('nhacungcap')->where('id',$id)->delete();
            alert()->success('Xóa nhà cung cấp thành công.','Thông báo');    
            return Redirect::to('xemncc');
        }else{
            $nhacungcap = Nhacungcap::all();
            alert()->warning('Bạn không thể xóa nhà cung cấp.','cảnh báo');
            return view('backend.nhacc.xemncc',compact('nhacungcap'));
        }
    }
}
