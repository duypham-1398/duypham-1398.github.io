<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Binhluan;

class BinhluanController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
      }
    public function danhsachbl()
    {
    	$data = DB::table('binhluan')->orderBy('id','DESC')->get();
        $data1 = DB::table('binhluan')->where('binhluan_trang_thai',1)->orderBy('id','DESC')->get();
        $data2 = DB::table('binhluan')->where('binhluan_trang_thai',0)->orderBy('id','DESC')->get();
    	return view('backend.binhluan.danhsach',compact('data','data1','data2'));
    }

    public function xoabl($id)
    {
    	DB::table('binhluan')->where('id',$id)->delete();
        return redirect()->route('binhluan.danhsach')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công!!!']);
    }

    public function chapnhan($id)
    {
    	DB::table('binhluan')->where('id',$id) ->update(['binhluan_trang_thai'=>1]);
        alert()->success('Bình luận đã được chấp nhận.','Thông báo');
    	return redirect()->route('binhluan.danhsach');
    }

    public function huychapnhan($id)
    {
        DB::table('binhluan') ->where('id',$id)->update(['binhluan_trang_thai'=>0]);
        alert()->success('Bình luận đã bị hủy chấp nhận.','Thông báo');
        return redirect()->route('binhluan.danhsach');
    }
}
