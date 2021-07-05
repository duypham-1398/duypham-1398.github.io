<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\KhuyenMaiAddRequest;
use App\Http\Requests\KhuyenMaiEditRequest;
use App\Sanpham;
use App\Khuyenmai;
use App\Sanphamkhuyenmai;
use DB;
use File,Input;

class KhuyenMaiController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function xemdanhsachkm()
    {
        $data1 = DB::table('khuyenmai')->orderBy('id','DESC')->get();
        $data2 = DB::table('sanphamkhuyenmai')->join('khuyenmai','khuyenmai.id','=','sanphamkhuyenmai.khuyenmai_id')->join('sanpham','sanpham.id','=','sanphamkhuyenmai.sanpham_id')->select('khuyenmai.created_at','khuyenmai.khuyenmai_thoi_gian','khuyenmai.khuyenmai_tinh_trang','sanphamkhuyenmai.khuyenmai_id','sanphamkhuyenmai.sanpham_id','sanpham.sanpham_khuyenmai')->where('sanpham_khuyenmai',1)->get();
        // dd($data2);
        foreach ($data2 as  $item) {
            $today  = date("Y-m-d"); // Năm/Tháng/Ngày
            $ngaybd =  date("Y-m-d", strtotime("$item->created_at")); // Năm/Tháng/Ngày
            $ngaykt = date("Y-m-d",strtotime($ngaybd . "+ $item->khuyenmai_thoi_gian  day"));
            if ( (strtotime($today) >= strtotime($ngaybd)) && (strtotime($today) <= strtotime($ngaykt)) )
            {      
                DB::table('sanpham')->where('id',$item->sanpham_id)->update(['sanpham_khuyenmai'=>1]);
                DB::table('khuyenmai') ->where('id',$item->khuyenmai_id)->update([ 'khuyenmai_tinh_trang' => 1 ]);
            } else{
                DB::table('sanpham')->where('id',$item->sanpham_id)->update(['sanpham_khuyenmai'=>0]);
                DB::table('khuyenmai') ->where('id',$item->khuyenmai_id)->update([ 'khuyenmai_tinh_trang' => 0]);
            }
        }
        $data = DB::table('khuyenmai')->orderBy('id','DESC')->get();
    	return view('backend.khuyenmai.danhsach',compact('data'));
    }

    public function getAdd()
    {
         $data = DB::table('sanpham')->orderBy('id','DESC')->get();
    	return view('backend.khuyenmai.them',compact('data'));
    }

    public function luukhuyenmai(KhuyenMaiAddRequest $request)
    {
        $request->file('fImage')->getClientOriginalName();
    	$filename=$request->file('fImage')->getClientOriginalName();
        $request->file('fImage')->move(
            base_path() . '/resources/upload/khuyenmai/', $filename
        );
        $khuyenmai = new Khuyenmai;
        $khuyenmai->khuyenmai_tieu_de   = $request->txtKMTittle;
        $khuyenmai->khuyenmai_noi_dung = $request->txtKMContent;
        $khuyenmai->khuyenmai_url   = Replace_TiengViet($request->txtKMTittle);
        $khuyenmai->khuyenmai_phan_tram   = $request->txtKMPer;
        $khuyenmai->khuyenmai_thoi_gian = $request->txtKMTime;
        $khuyenmai->khuyenmai_anh= $filename;
        $khuyenmai->khuyenmai_tinh_trang= 1;
        $khuyenmai->save();

        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            DB::table('sanpham')
                ->where('id',$item)
                ->update([
                        'sanpham_khuyenmai'=> 1,
                    ]);
            //print_r($item);
            $sanphamkhuyenmai = new Sanphamkhuyenmai;
            $sanphamkhuyenmai->sanpham_id = $item;
            $sanphamkhuyenmai->khuyenmai_id = $khuyenmai->id;
            $sanphamkhuyenmai->save();
            
        }
        alert()->success('Thêm khuyến mại thành công.','Thông báo');
        return redirect()->route('admin.khuyenmai.list');
    }

    public function getDelete($id)
    {
        $khuyenmai = DB::table('khuyenmai')->where('id',$id)->first();
        $img = 'resources/upload/khuyenmai/'.$khuyenmai->khuyenmai_anh;
        File::delete($img);
        DB::table('khuyenmai')->where('id',$id)->delete();
        alert()->success('Xóa thành công.','Thông báo');
        return redirect()->route('admin.khuyenmai.list');
    }

    public function getEdit($id)
    {
    	$khuyenmai = DB::table('khuyenmai')->where('id',$id)->first();
        $spkhuyenmai = DB::table('sanphamkhuyenmai')->select('sanpham_id')->where('khuyenmai_id',$id)->get();
        foreach ($spkhuyenmai as $key => $val) {
            $khmai[] = $val->sanpham_id;
        }
        if (!empty($khmai)) {
        
            $sanpham1 = DB::table('sanpham')
                    ->whereIn('id',$khmai)
                    ->get();
        } else {
            $sanpham1 = DB::table('sanpham')
                    ->whereIn('id',['0'])
                    ->get();
        }

        if (empty($khmai)) {
            $sanpham2 = DB::table('sanpham')
                    ->whereNotIn('id',['0'])
                    ->get();
        } else {
            $sanpham2 = DB::table('sanpham')
                    ->whereNotIn('id',$khmai)
                    ->get();
        }
        return view('backend.khuyenmai.sua',compact('khuyenmai','sanpham1','sanpham2'));
    }

    public function postEdit(Request $request,$id)
    {

        $fImage = $request->fImage;
        $img_current = '/resources/upload/khuyenmai/'.$request->fImageCurrent;
        if (!empty($fImage )) {
             $filename=$fImage ->getClientOriginalName();
             DB::table('khuyenmai')->where('id',$id)
                            ->update([
                                'khuyenmai_tieu_de'   => $request->txtKMTittle,
                                'khuyenmai_noi_dung' => $request->txtKMContent,
                                'khuyenmai_url'   => Replace_TiengViet($request->txtKMTittle),
                                'khuyenmai_phan_tram'   => $request->txtKMPer,
                                'khuyenmai_thoi_gian' => $request->txtKMTime,
                                'khuyenmai_anh'=> $filename,
                                'khuyenmai_tinh_trang'=>1
                                ]);
             $fImage ->move(base_path() . '/resources/upload/khuyenmai/', $filename);
             File::delete($img_current);
        } else {
            DB::table('khuyenmai')->where('id',$id)
                            ->update([
                                'khuyenmai_tieu_de'   => $request->txtKMTittle,
                                'khuyenmai_noi_dung' => $request->txtKMContent,
                                'khuyenmai_url'   => Replace_TiengViet($request->txtKMTittle),
                                'khuyenmai_phan_tram'   => $request->txtKMPer,
                                'khuyenmai_thoi_gian' => $request->txtKMTime,
                                'khuyenmai_tinh_trang'=>1
                                ]);
        }
        
        $ids = DB::table('sanphamkhuyenmai')->select('sanpham_id')->where('khuyenmai_id',$id)->get();
        // print_r($ids);
        foreach ($ids as $val) {
            $p = DB::table('sanpham')
                ->where('id',$val->sanpham_id)
                ->update([
                        'sanpham_khuyenmai'=> 0
                    ]);
        }
        DB::table('sanphamkhuyenmai')->where('khuyenmai_id',$id)->delete();
        
        //Them $val moi
        $data = $request->input('products',[]);
        //print_r($data);
        
        foreach ($data as  $item) {
            $u = DB::table('sanpham')
                ->where('id',$item)
                ->update(['sanpham_khuyenmai' => 1]);
            $sanphamkhuyenmai = new Sanphamkhuyenmai;
            $sanphamkhuyenmai->sanpham_id = $item;
            $sanphamkhuyenmai->khuyenmai_id = $id;
            $sanphamkhuyenmai->save(); 
            
        }
        alert()->success('Cập nhật thành công.','Thông báo');
        return redirect()->route('admin.khuyenmai.list');
    }

    public function getAddPromotion()
    {
        $sanpham = DB::table('sanpham')->where('sanpham_da_xoa',1)->orderBy('id','DESC')->get();
        return view('backend.khuyenmai.themsanphamkm',compact('sanpham'));
    }

    public function postAddPromotion(Request $request)
    {
        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            DB::table('sanpham')
                ->where('id',$item)
                ->update([
                        'sanpham_khuyenmai'=> 1,
                    ]);
            //print_r($item);
            $sanphamkhuyenmai = new Sanphamkhuyenmai;
            $sanphamkhuyenmai->sanpham_id = $item;
            $sanphamkhuyenmai->khuyenmai_id = $request->txtID;
            $sanphamkhuyenmai->save();
            
        }
        alert()->success('Thêm thành công.','Thông báo');
        return redirect()->route('admin.khuyenmai.list');
    }

    public function getEditPromotion($id)
    {
        //$tylegia = DB::table('sanphamkhuyenmai')->where('khuyenmai_id',$id)->get();
        $spkhuyenmai = DB::table('sanphamkhuyenmai')->select('sanpham_id')->where('khuyenmai_id',$id)->get();
        foreach ($spkhuyenmai as $key => $val) {
            $khmai[] = $val->sanpham_id;
        }
        if (!empty($khmai)) {
        
            $sanpham1 = DB::table('sanpham')
                    ->whereIn('id',$khmai)
                    ->get();
        } else {
            $sanpham1 = DB::table('sanpham')
                    ->whereIn('id',['0'])
                    ->get();
        }

        if (empty($khmai)) {
            $sanpham2 = DB::table('sanpham')
                    ->whereNotIn('id',['0'])
                    ->get();
        } else {
            $sanpham2 = DB::table('sanpham')
                    ->whereNotIn('id',$khmai)
                    ->get();
        }
        return view('backend.khuyenmai.suasanphamkm',compact('sanpham1','sanpham2'));
    }


public function postEditPromotion(Request $request,$id)
    {
        $ids = DB::table('sanphamkhuyenmai')->select('sanpham_id')->where('khuyenmai_id',$id)->get();
        // print_r($ids);
        foreach ($ids as $val) {
            $p = DB::table('sanpham')
                ->where('id',$val->sanpham_id)
                ->update([
                        'sanpham_khuyenmai'=> 0
                    ]);
        }
        DB::table('sanphamkhuyenmai')->where('khuyenmai_id',$id)->delete();
        
        //Them $val moi
        $data = $request->input('products',[]);
        //print_r($data);
        
        foreach ($data as  $item) {
            $u = DB::table('sanpham')
                ->where('id',$item)
                ->update(['sanpham_khuyenmai' => 1]);
            $sanphamkhuyenmai = new Sanphamkhuyenmai;
            $sanphamkhuyenmai->sanpham_id = $item;
            $sanphamkhuyenmai->khuyenmai_id = $id;
            $sanphamkhuyenmai->save(); 
            
        }
        alert()->success('Sửa thành công','Thông báo');
        return redirect()->route('admin.khuyenmai.list');
    }

}
