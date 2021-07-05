<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\LohangAddRequest;
use App\Http\Requests\LohangEditRequest;
use App\Lohang;
use App\Sanpham;
use App\Nhacungcap;
use DB;
use Input,File;

class LohangController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function getList()
    {
    	$data = DB::table('lohang')->orderBy('id','DESC')->get();
    	return view('backend.lohang.danhsach',compact('data'));
    }

    public function getAdd()
    {
        $hanghoa = DB::table('sanpham')->get();
        $nhacc = DB::table('nhacungcap')->get();
    	return view('backend.lohang.them',compact('hanghoa','nhacc'));
    }

    public function postAdd(LohangAddRequest $request)
    {
    	$lohang = new Lohang;
        $lohang->lohang_ky_hieu = $request->txtLHSignt;
        $lohang->lohang_han_su_dung = $request->txtLHShelf;
        $lohang->lohang_gia_mua_vao = $request->txtLHBuyPrice;
        $lohang->lohang_so_luong_nhap = $request->txtLHQuant;
        $lohang->lohang_ngay_nhap = date('Y-m-d');
        $lohang->lohang_so_luong_da_ban = 0;
        $lohang->lohang_so_luong_doi_tra = 0;
        $lohang->lohang_so_luong_hien_tai = $request->txtLHQuant;
        $lohang->sanpham_id = $request->txtLHProduct;
        $lohang->nhacungcap_id = $request->txtLHVendor;
        $lohang->save();
        alert()->success('Thêm lô hàng thành công.','Thông báo');
        return Redirect::to('lohang');
    }

    public function getEdit($id)
    {
        $products = DB::table('sanpham')->get();
        foreach ($products as $key => $val) {
            $product[] = ['id' => $val->id, 'name'=> $val->sanpham_ten];
        }
        $vendors = DB::table('nhacungcap')->get();
        foreach ($vendors as $key => $val) {
            $vendor[] = ['id' => $val->id, 'name'=> $val->nhacungcap_ten];
        }
        $lohang = DB::table('lohang')->where('id',$id)->first();
        //print_r($lohang);
    	return view('backend.lohang.sua',compact('product','vendor','lohang','id'));
    }

    public function postEdit(LohangEditRequest $request, $id)
    {
        $lohang = DB::table('lohang')->where('id',$id)->first();
    	DB::table('lohang')->where('id',$id)
                           ->update([
                    'lohang_ky_hieu' => $request->txtLHSignt,
                    'lohang_han_su_dung' => $request->txtLHShelf,
                    'lohang_gia_mua_vao' => $request->txtLHBuyPrice,
                    'lohang_so_luong_nhap' => $request->txtLHQuant,
                    'lohang_so_luong_hien_tai' => ($request->txtLHQuant - $lohang->lohang_so_luong_da_ban + $lohang->lohang_so_luong_doi_tra),
                    'sanpham_id' => $request->txtLHProduct,
                    'nhacungcap_id' => $request->txtLHVendor                 
            ]);
            alert()->success('Sửa lô hàng thành công.','Thông báo');
            return Redirect::to('lohang');
    }

    public function getDelete($id)
    {
        DB::table('lohang')->where('id',$id)->delete();
        alert()->success('Xóa lô hàng thành công.','Thông báo');
        return Redirect::to('lohang');
    }

    public function getNhaphang($id)
    {
        $sanpham = DB::table('sanpham')->where('id',$id)->first();
        $vendors = DB::table('nhacungcap')->get();
        foreach ($vendors as $key => $val) {
            $vendor[] = ['id' => $val->id, 'name'=> $val->nhacungcap_ten];
        }
        return view('backend.lohang.nhaphang',compact('sanpham','vendor'));
    }

    public function postNhaphang(LohangAddRequest $request,$id)
    {
        $lohang = new Lohang;
        $lohang->lohang_ky_hieu = $request->txtLHSignt;
        $lohang->lohang_han_su_dung = $request->txtLHShelf;
        $lohang->lohang_gia_mua_vao = $request->txtLHBuyPrice;
        $lohang->lohang_so_luong_nhap = $request->txtLHQuant;
        $lohang->lohang_ngay_nhap = date('Y-m-d');
        $lohang->lohang_so_luong_da_ban = 0;
        $lohang->lohang_so_luong_doi_tra = 0;
        $lohang->lohang_so_luong_hien_tai = $request->txtLHQuant;
        $lohang->sanpham_id = $id;
        $lohang->nhacungcap_id = $request->txtLHVendor;
        $lohang->save();
        alert()->success('Thêm lô hàng thành công.','Thông báo');
        return Redirect::route('admin.sanpham.list');
    }
}
 