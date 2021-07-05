<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\NhomAddRequest;
use App\Http\Requests\NhomEditRequest;
use App\Nhom;
use DB;
use Input,File;

class NhomController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function xemnhomsp()
    {
    	$data = DB::table('nhom')->get();
    	return view('backend.nhom.danhsach',compact('data'));
    }

    public function themnhomsp()
    {
    	return view('backend.nhom.them');
    }

    public function luunhomsp(NhomAddRequest $request)
    {
        $nhom = array();
        $nhom['id'] = $request->id;
        $nhom['nhom_ten'] = $request->txtNName;
        $nhom['nhom_url'] = Replace_TiengViet($request->txtNName);
        $nhom['nhom_mo_ta'] = $request->txtNIntro;
        DB::table('nhom')->insert($nhom);
        alert()->success('Thêm nhóm sản phẩm thành công.','Thông báo');
    	return Redirect::to('xemnhom');
    }

    public function suanhomsp($id) {
    	$nhom = DB::table('nhom')->where('id',$id)->get();
    	return view('backend.nhom.sua',compact('nhom'));
    }

    public function capnhatnhomsp(NhomEditRequest $request, $id)
    {
        $nhom = array();
        $nhom['id'] = $request->id;
        $nhom['nhom_ten'] = $request->txtNName;
        $nhom['nhom_url'] = Replace_TiengViet($request->txtNName);
        $nhom['nhom_mo_ta'] = $request->txtNIntro;
        DB::table('nhom')->where('id',$id)->update($nhom);
        alert()->success('Sửa nhóm sản phẩm thành công.','Thông báo');
    	return Redirect::to('xemnhom');
    }

    public function xoanhomsp($id)
	{
        $nhom = DB::table('nhom')->where('id',$id)->first();
        DB::table('nhom')->where('id',$id)->delete();
        alert()->success('Xóa nhóm sản phẩm thành công.','Thông báo');
        return Redirect::to('xemnhom');
	}
}
