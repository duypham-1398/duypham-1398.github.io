<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\SanphamAddRequest;
use App\Http\Requests\SanphamEditRequest;
use App\Sanpham;
use App\Lohang;
use App\Khuyenmai;
use App\Hinhsanpham;
use App\Donvitinh;
use DB;
use Request;
use Input,File;
class SanphamController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function getList()
    {

        $data = DB::table('sanpham')->orderBy('id','DESC')->get();
    	return view('backend.sanpham.danhsach',compact('data'));
    }

    public function getAdd()
    {
        $units = DB::table('donvitinh')->get();
        foreach ($units as $key => $val) {
            $unit[] = ['id' => $val->id, 'name'=> $val->donvitinh_ten];
        }
        $cates = DB::table('loaisanpham')->get();
        foreach ($cates as $key => $val) {
            $cate[] = ['id' => $val->id, 'name'=> $val->loaisanpham_ten];
        }
    	return view('backend.sanpham.them',compact('cate','unit'));
    }

    public function postAdd(SanphamAddRequest $request)
    {
        $sanpham = new Sanpham;
        $filename=$request->file('txtSPImage')->getClientOriginalName();
        $request->file('txtSPImage')->move(
            base_path() . '/resources/upload/sanpham/', $filename
        );
        $sanpham->sanpham_ky_hieu   = $request->txtSPSignt;
        $sanpham->sanpham_ten           = $request->txtSPName;
        $sanpham->sanpham_url           = Replace_TiengViet($request->txtSPName);
        $sanpham->sanpham_mo_ta = $request->txtSPIntro;
        $sanpham->sanpham_anh = $filename;
        $sanpham->loaisanpham_id = $request->txtSPCate;
        $sanpham->donvitinh_id = $request->txtSPUnit;
        $sanpham->sanpham_gia_ban = $request->txtSPSalePrice;
        $sanpham->sanpham_khuyenmai = 0;
        $sanpham->save();
        alert()->success('Thêm sản phẩm thành công.','Thông báo');
        return redirect()->route('admin.sanpham.list');
    }

    public function getDelete($id)
    {   
        $binhluan = DB::table('binhluan')->where('sanpham_id',$id)->get();
        foreach ($binhluan as $val) {
            
            DB::table('binhluan')->where('sanpham_id',$id)->delete();
        }
        DB::table('lohang')->where('sanpham_id',$id)->delete();
    	$sanpham = DB::table('sanpham')->where('id',$id)->first();
        $img = 'resources/upload/sanpham/'.$sanpham->sanpham_anh;
        File::delete($img);
        DB::table('sanpham')->where('id',$id)->delete();
        alert()->success('Xóa sản phẩm thành công.','Thông báo');
        return redirect()->route('admin.sanpham.list');
    }

    public function getEdit($id)
    {
    	$units = DB::table('donvitinh')->get();
        foreach ($units as $key => $val) {
            $unit[] = ['id' => $val->id, 'name'=> $val->donvitinh_ten];
        }
        $cates = DB::table('loaisanpham')->get();
        foreach ($cates as $key => $val) {
            $cate[] = ['id' => $val->id, 'name'=> $val->loaisanpham_ten];
        }
        $sanpham = DB::table('sanpham')->where('id',$id)->first();
        return view('backend.sanpham.sua',compact('cate','unit','sanpham','id'));
    }

    public function postEdit($id, SanphamEditRequest $request)
    {
        $sanpham = Sanpham::find($id);
        $sanpham->sanpham_ky_hieu   = Request::input('txtSPSignt');
        $sanpham->sanpham_ten       = Request::input('txtSPName');
        $sanpham->sanpham_url       = Replace_TiengViet(Request::input('txtSPName'));
        $sanpham->sanpham_mo_ta     = Request::input('txtSPIntro');
        $sanpham->loaisanpham_id    = Request::input('txtSPCate');
        $sanpham->donvitinh_id      = Request::input('txtSPUnit');
        $sanpham->sanpham_gia_ban      = Request::input('txtSPSalePrice');
        
       
        $img_current = 'resources/upload/sanpham/'.Request::input('fImageCurrent');
        if (!empty(Request::file('fImage'))) {
             $filename=Request::file('fImage')->getClientOriginalName();
             $sanpham->sanpham_anh = $filename;
             Request::file('fImage')->move(base_path() . '/resources/upload/sanpham/', $filename);
             File::delete($img_current);
        } else {
            echo "File empty";
        }

        if(!empty(Request::file('fEditImage'))) {
            foreach (Request::file('fEditImage') as $file) {
                $detail_img = new Hinhsanpham();
                if (isset($file)) {
                    $detail_img->hinhsanpham_ten = $file->getClientOriginalName();
                    $detail_img->sanpham_id = $id;
                    $file->move('resources/upload/chitietsanpham/', $file->getClientOriginalName());
                    $detail_img->save();
                } 
          }
        }

        $sanpham->save();
        alert()->success('Sửa sản phẩm thành công.','Thông báo');
        return redirect()->route('admin.sanpham.list');
    }
    public function xemsptheolo($id){
        $data = DB::table('lohang')->orderBy('id','DESC')->get();
        $data = DB::table('lohang')->where('sanpham_id','=',$id)->get();
        
        return view('backend.sanpham.xemlo',compact('data'));
    }
}

