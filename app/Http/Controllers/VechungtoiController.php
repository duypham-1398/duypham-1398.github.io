<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VechungtoiAddRequest;
use App\Http\Requests\VechungtoiEditRequest;
use App\Vechungtoi;
use DB;
use Input,File;

class VechungtoiController extends Controller
{
    public function getList()
    {
    	$data = DB::table('vechungtoi')->get();
    	return view('backend.vechungtoi.danhsach',compact('data'));
    }

    public function getAdd()
    {
    	return view('backend.vechungtoi.them');
    }

    public function postAdd(VechungtoiAddRequest $request)
    {
    	$vechungtoi = new Vechungtoi;
        $imageName = $request->file('fImage')->getClientOriginalName();

        $request->file('fImage')->move(
            base_path() . '/resources/upload/vechungtoi/', $imageName
        );
        $vechungtoi->vechungtoi_noi_dung   = $request->txtVCTND;
        $vechungtoi->vechungtoi_tieu_de   = $request->txtVCTTD;
        $vechungtoi->vechungtoi_url         = Replace_TiengViet($request->txtVCTTD);
        $vechungtoi->vechungtoi_ngay_tao  = date('Y-m-d');
        $vechungtoi->vechungtoi_anh = $imageName;
        $vechungtoi->save();
        alert()->success('Thêm thành công.','Thông báo');
    	return redirect()->route('admin.vechungtoi.list');
    }

    public function getEdit($id) {
    	$vechungtoi = DB::table('vechungtoi')->where('id',$id)->first();
    	return view('backend.vechungtoi.sua',compact('vechungtoi'));
    }

    public function postEdit(VechungtoiEditRequest $request, $id)
    {
        $fImage = $request->fImage;
        $img_current = 'resources/upload/vechungtoi/'.$request->fImageCurrent;
        if (!empty($fImage )) {
             $filename=$fImage ->getClientOriginalName();
             DB::table('vechungtoi')->where('id',$id)
                            ->update([
                                'vechungtoi_noi_dung'   => $request->txtVCTND,
                                'vechungtoi_tieu_de'   => $request->txtVCTTD,
                                'vechungtoi_url'       => Replace_TiengViet($request->txtVCTTD),
                                'vechungtoi_anh' => $filename
                                ]);
             $fImage ->move(base_path() . '/resources/upload/vechungtoi/', $filename);
             File::delete($img_current);
        } else {
            DB::table('vechungtoi')->where('id',$id)
                            ->update([
                                'vechungtoi_tieu_de'   => $request->txtVCTTD,
                                'vechungtoi_url'       => Replace_TiengViet($request->txtVCTTD),
                                'vechungtoi_noi_dung'   => $request->txtVCTND
                                ]);
        }
        alert()->success('Sửa thành công.','Thông báo');
    	return redirect()->route('admin.vechungtoi.list');
    }

    public function getDelete($id)
	{
        $vechungtoi = DB::table('vechungtoi')->where('id',$id)->first();
        $img = 'resources/upload/vechungtoi/'.$vechungtoi->vechungtoi_anh;
        File::delete($img);
        DB::table('vechungtoi')->where('id',$id)->delete();
        alert()->success('Xóa thành công.','Thông báo');
        return redirect()->route('admin.vechungtoi.list');
    }
}
