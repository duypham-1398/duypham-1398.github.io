<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SliderAddRequest;
use App\Http\Requests\SliderEditRequest;
use App\Slider;
use DB;
use Input,File;

class SliderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function getList()
    {
    	$data = DB::table('slider')->get();
    	return view('backend.slider.danhsach',compact('data'));
    }

    public function getAdd()
    {
    	return view('backend.slider.them');
    }

    public function postAdd(SliderAddRequest $request)
    {
    	$slider = new Slider;
        $imageName = $request->file('fImage')->getClientOriginalName();

        $request->file('fImage')->move(
            base_path() . '/resources/upload/slider/', $imageName
        );
    	$slider->slider_ten   = $request->txtSLName;
        $slider->slider_anh = $imageName;
        $slider->save();
        alert()->success('Thêm thành công.','Thông báo');
    	return redirect()->route('admin.slider.list');
    }

    public function getEdit($id) {
    	$slider = DB::table('slider')->where('id',$id)->first();
    	return view('backend.slider.sua',compact('slider'));
    }

    public function postEdit(SliderEditRequest $request, $id)
    {
        $fImage = $request->fImage;
        $img_current = 'resources/upload/slider/'.$request->fImageCurrent;
        if (!empty($fImage )) {
             $filename=$fImage ->getClientOriginalName();
             DB::table('slider')->where('id',$id)
                            ->update([
                                'slider_ten'   => $request->txtSLName,
                                'slider_anh' => $filename
                                ]);
             $fImage ->move(base_path() . '/resources/upload/slider/', $filename);
             File::delete($img_current);
        } else {
            DB::table('slider')->where('id',$id)
                            ->update([
                                'slider_ten'   => $request->txtSLName
                                ]);
        }
        alert()->success('Sửa thành công.','Thông báo');
    	return redirect()->route('admin.slider.list');
    }

    public function getDelete($id)
	{
        $slider = DB::table('slider')->where('id',$id)->first();
        $img = 'resources/upload/slider/'.$slider->slider_anh;
        File::delete($img);
        DB::table('slider')->where('id',$id)->delete();
        alert()->success('Xóa thành công.','Thông báo');
        return redirect()->route('admin.slider.list');
	}
}
