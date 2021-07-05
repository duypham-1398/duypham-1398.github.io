<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Donban;
use Khachmua;

class KhachmuaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function getList()
    {
        $data = DB::table('khachmua')->get();
        
    	return view('backend.khachmua.danhsach',compact('data'));
    }

    public function getAdd()
    {
    	# code...
    }

    public function postAdd(Request $request)
    {
        $customer = array();
        $customer['id'] = $request->id;
        $customer['khachmua_email'] =$request->khachmuaemail;
        $customer['khachmua_ten'] = $request->khachmuaten;
        $customer['khachmua_dia_chi'] = $request->khachmuadiachi;
        $customer['khachmua_sdt'] = $request->khachmuasdt;
        $customer['khachmua_tonno_dk'] = $request->tonnodk;
        $customer['khachmua_tonco_dk'] = $request->toncodk;
        $customer['khachmua_phat_sinh_no'] = 0;
        $customer['khachmua_phat_sinh_co'] = 0;
        $customer['khachmua_tonco_ck'] = $customer['khachmua_tonco_dk'];
        $customer['khachmua_tonno_ck'] = $customer['khachmua_tonno_dk'];
        DB::table('khachmua')->insert($customer);
        alert()->success('Thêm khách hàng thành công.','Thông báo');
        return redirect()->back();
    }

    public function getDelete()
    {
    	#code
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
        $khachmua = DB::table('khachmua')->where('id',$id)->first();
        $donban = DB::table('donban')->where('khachmua_id',$id)->get();
        return view('backend.khachmua.lichsu',compact('khachmua','donban'));
    }
    public function xemctkm($id){
        $data = DB::table('khachmua')->get();
        $data = DB::table('khachmua')->where('id',$id)->get();
        return view('backend.khachmua.danhsach',compact('data'));
    }
    public function dsphieuthu(){
        $phieuthu = DB::table('thukh')->get();
        return view('backend.khachmua.dsphieuthu',compact('phieuthu'));
    }
    public function xemphieuthu($id){
        $phieuthu = DB::table('thukm')->where('khachmua_id',$id)->get();
        $km = DB::table('khachmua')->where('id',$id)->first();
        return view('backend.khachmua.dsphieuthu',compact('phieuthu','km'));
    }
}
