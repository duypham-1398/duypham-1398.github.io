<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HangHoaController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\HangHoa;
use App\NhaCC;
use App\Donvitinh;
use App\PhieuNhap;
use App\DanhMucHH;
use Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();
class HangHoaController extends Controller
{
    //
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if($admin_id){
            return Redirect::to('homead');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function xemhanghoa(){
        $this->AuthLogin();
        $hanghoa = HangHoa::all();
        return view('hanghoa.xemhanghoa',compact('hanghoa'));
    }
    public function luuhh(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['id'] = $request->id;
        $data['MaHH'] = $request->mahh;
        $data['TenHH'] = $request->tenhh;
        $data['MoTa'] = $request->mota;
        $data['id_DMHH'] = $request->iddmhh;
        $data['id_DV'] = $request->iddv;
        $data['TrangThaiHH'] = $request->trangthaihh;
        $data['SlugHH'] = $request->slughh;
        $get_image = $request->file('HinhHH');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['HinhHH'] = $new_image;
            DB::table('HangHoa')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('xemhh');
        }
        $data['HinhHH'] = '';
        DB::table('HangHoa')->insert($data);
    	Session::put('message','***Thêm hàng hóa thành công***');
    	return Redirect::to('xemhh');
    }
    public function themhanghoa(){
        $this->AuthLogin();
        $danhmuc = DanhMucHH::all();
        $nhacungcap = NhaCC::all();
        $donvi = DonViHH::all();
        return view('hanghoa.themhh',compact('danhmuc','nhacungcap','donvi'));
    }
    public function suahanghoa($id){
        $this->AuthLogin();
        $hanghoa = DB::table('HangHoa')->where('id',$id)->get();
        $danhmuc = DanhMucHH::all();
        $donvi = DonViHH::all();
        return view('hanghoa.suahh',compact('danhmuc','hanghoa','donvi'));

    }
    public function capnhathanghoa(Request $request , $id){
        $this->AuthLogin();
        $hanghoa = array();
        $hanghoa['id'] = $request->id;
        $hanghoa['MaHH'] = $request->mahh;
        $hanghoa['TenHH'] = $request->tenhh;
        $hanghoa['MoTa'] = $request->mota;
        $hanghoa['id_DMHH'] = $request->iddmhh;
        $hanghoa['id_DV'] = $request->iddv;
        $hanghoa['TrangThaiHH'] = $request->trangthaihh;
        $hanghoa['SlugHH'] = $request->slughh;
        $get_image = $request->file('HinhHH');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $hanghoa['HinhHH'] = $new_image;
            DB::table('HangHoa')->where('id',$id)->update($hanghoa);
            Session::put('message','***cập nhật hàng hóa thành công***');
            return Redirect::to('xemhh');
        }
        DB::table('HangHoa')->where('id',$id)->update($hanghoa);
    	Session::put('message','***Cập nhật hàng hóa thành công***');
    	return Redirect::to('xemhh');
    }
    public function xoahanghoa($id){
        $this->AuthLogin();
        Session::put('message','***Dữ liệu xóa thành công***');
        DB::table('HangHoa')->where('id',$id)->delete();
        return Redirect::to('xemhh');
    }
    public function khongkichhoathh($id){
        $this->AuthLogin();
       DB::table('HangHoa')->where('id',$id)->update(['TrangThaiHH'=>1]);
       Session::put('message','***Không kích hoạt hàng hóa: thành công***');
       return Redirect::to('xemhh');

   }
   public function kichhoathh($id){
        $this->AuthLogin();
       DB::table('HangHoa')->where('id',$id)->update(['TrangThaiHH'=>0]);
       Session::put('message','***Kích hoạt hàng hóa: thành công***');
       return Redirect::to('xemhh');
   }
   //danh mục hàng hóa
    public function themdmhh(){
        $this->AuthLogin();
    	return view('hanghoa.themdmhh');
    }
    public function luudm(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['id'] = $request->id;
        $data['TenDM'] = $request->tendm;
        $data['MoTa'] = $request->mota; 
        $data['TrangThaiDM'] = $request->trangthaidm; 
        $data['SlugDM'] = $request->slugdm; 
        DB::table('DanhMucHH')->insert($data);
    	Session::put('message','***Thêm danh mục hàng hóa thành công***');
    	return Redirect::to('xemdm');
    }
    public function xemdmhh(){
        $this->AuthLogin();
        $danhmuc = DanhMucHH::all();
        return view('hanghoa.xemdanhmuc',compact('danhmuc'));
    }
    public function suadm($id){
        $this->AuthLogin();
        $danhmuc = DB::table('DanhMucHH')->where('id',$id)->get();
        return view('HangHoa.suadm' , compact('danhmuc'));
    }
    public function capnhatdm(Request $request, $id)
    { 
        $this->AuthLogin();
        $danhmuc = array();
        $danhmuc['id'] = $request->id;
        $danhmuc['TenDM'] = $request->tendm;
        $danhmuc['MoTa'] = $request->mota; 
        $danhmuc['TrangThaiDM'] = $request->trangthaidm; 
        $danhmuc['SlugDM'] = $request->slugdm; 
        DB::table('DanhMucHH')->where('id',$id)->update($danhmuc);
        Session::put('message','***Cập nhật danh mục hàng hóa thành công***');
        return Redirect::to('xemdm');
    }
    public function xoadm($id)
    {
        $this->AuthLogin();
        Session::put('message','***Dữ liệu xóa thành công***');
        DB::table('DanhMucHH')->where('id',$id)->delete();
        return Redirect::to('xemdm');
    }
    public function khongkichhoatdm($id){
        $this->AuthLogin();
        DB::table('DanhMucHH')->where('id',$id)->update(['TrangThaiDM'=>1]);
        Session::put('message','***Không kích hoạt sdanh mục hàng hóa: thành công***');
        return Redirect::to('xemdm');

   }
     public function kichhoatdm($id){
        $this->AuthLogin();
        DB::table('DanhMucHH')->where('id',$id)->update(['TrangThaiDM'=>0]);
        Session::put('message','***Kích hoạt danh mục hàng hóa: thành công***');
        return Redirect::to('xemdm');
   }
   //don vi tinh
    public function themdonvi(){
        return view('backend.sanpham.themdv');
    }
    public function luudonvi(Request $request){
        $data = array();
        $data['id'] = $request->id;
        $data['donvitinh_ten'] = $request->tendv;
        DB::table('donvitinh')->insert($data);
        alert()->success('Thêm đơn vị thành công.','Thông báo');
        return Redirect::to('xemdv');;
    }
    public function xemdonvi(){
        $donvi = DB::table('donvitinh')->get();
        return view('backend.sanpham.xemdonvi',compact('donvi'));
    }
    public function suadonvi($id){
        $donvi = DB::table('donvitinh')->where('id',$id)->get();
        return view('backend.sanpham.suadv' , compact('donvi'));
    }
    public function capnhatdonvi(Request $request, $id)
    { 
        $donvi = array();
        $donvi['id'] = $request->id;
        $donvi['donvitinh_ten'] = $request->tendv;
        DB::table('donvitinh')->where('id',$id)->update($donvi);
        alert()->success('Chỉnh sửa đơn vị thành công.','Thông báo');
        return Redirect::to('xemdv');
    }
    public function xoadonvi($id)
    {
        DB::table('donvitinh')->where('id',$id)->delete();
        alert()->success('Xóa đơn vị thành công.','Thông báo');
        return Redirect::to('xemdv');
    }
   //kết thúc hàm ở trang admin
   //bắt đầu sang hàm ở trang chủ
   public function xem_dm_trang_chu($SlugDM){
        $danhmuc = DB::table('DanhMucHH')->where('TrangThaiDM','0')->orderby('id','desc')->get();
        $danhmuc_id = DB::table('HangHoa')->join('DanhMucHH','HangHoa.id_DMHH','=','DanhMucHH.id')->where('DanhMucHH.SlugDM',$SlugDM)->get();
        $danhmuc_ten = DB::table('DanhMucHH')->where('DanhMucHH.SlugDM',$SlugDM)->limit(1)->get();
        return view('pages.hanghoa.xemdm',compact('danhmuc_id','danhmuc','danhmuc_ten'));
   }
   public function chitietsp($SlugHH){
        $danhmuc = DB::table('DanhMucHH')->where('TrangThaiDM','0')->orderby('id','desc')->get();
        $chitietsp = DB::table('HangHoa')
        ->join('DanhMucHH','DanhMucHH.id','=','HangHoa.id_DMHH')
        ->join('LoHang', 'HangHoa.id', '=', 'Lohang.id_HH')
        ->where('HangHoa.SlugHH',$SlugHH)->get();
        foreach($chitietsp as $key => $value){
            $id_dm = $value->id;
        }
        $splienquan = DB::table('HangHoa')
        ->join('DanhMucHH','DanhMucHH.id','=','HangHoa.id_DMHH')
        ->where('DanhMucHH.id',$id_dm)->whereNotIn('HangHoa.SlugHH',[$SlugHH])->get();
        return view('pages.hanghoa.chitietsp',compact('danhmuc','splienquan','chitietsp','hanghoa'));
   }
}
