<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class KhachhangController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getList()
    {
        $data = DB::table('khachhang')->get();
    	return view('backend.khachhang.danhsach',compact('data'));
    }

    public function getAdd()
    {
    	# code...
    }

    public function postAdd()
    {
    	# code...
    }

    public function getDelete($id)
    {
    	$id_user = DB::table('khachhang')->select('user_id')->where('id',$id)->first();
        DB::table('khachhang')->where('id',$id)->delete();
        DB::table('users')->where('id',$id_user->user_id)->delete();
        alert()->success('Xóa khách hàng thành công.','Thông báo');
        return redirect()->route('admin.khachhang.list');
    }

    public function getEdit()
    {
    	# code...
    }

    public function postEdit()
    {
    	# code...
    }

    public function getHistory($id)
    {
        $khachhang = DB::table('khachhang')->where('id',$id)->first();
        $donhang = DB::table('donhang')->where('khachhang_id',$id)->get();
        return view('backend.khachhang.lichsu',compact('khachhang','donhang'));
    }
    public function xemsptheolo($id){
        $data = DB::table('lohang')->orderBy('id','DESC')->get();
        $data = DB::table('lohang')->where('sanpham_id','=',$id)->get();
        
        return view('backend.sanpham.xemlo',compact('data'));
    }
    public function dsphieuthu(){
        $phieuthu = DB::table('thukh')->get();
        return view('backend.khachhang.dsphieuthu',compact('phieuthu'));
    }
    public function xemphieuthu($id){
        $phieuthu = DB::table('thukh')->where('khachhang_id',$id)->get();
        $kh = DB::table('khachhang')->where('id',$id)->first();
        return view('backend.khachhang.dsphieuthu',compact('phieuthu','kh'));
    }
}
