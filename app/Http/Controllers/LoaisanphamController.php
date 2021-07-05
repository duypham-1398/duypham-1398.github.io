<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;

use App\Http\Requests\LoaisanphamAddRequest;
use App\Http\Requests\LoaisanphamEditRequest;

use App\Loaisanpham;
use DB;

use Input,File;

class LoaisanphamController extends Controller
{

		public function __construct() {
			$this->middleware('auth');
		}
			public function getList()
		{
			$data =  DB::table('loaisanpham')->orderBy('id','DESC')->get();
			return view('backend.loaisanpham.danhsach',compact('data'));
		}

		public function getAdd() {
			$data = DB::table('nhom')->get();
			foreach ($data as $key => $val) {
				$nhom[] = ['id' => $val->id, 'name'=> $val->nhom_ten];
			}
			return view('backend.loaisanpham.them',compact('nhom'));
		}

		public function postAdd(LoaisanphamAddRequest $request) {
			$loaisanpham = new Loaisanpham;
			$imageName = $request->file('fImage')->getClientOriginalName();

					$request->file('fImage')->move(
							base_path() . '/resources/upload/loaisanpham/', $imageName
					);
			$loaisanpham->loaisanpham_ten	= $request->txtLSPName;
			$loaisanpham->nhom_id			= $request->txtLSPParent;
			$loaisanpham->loaisanpham_mo_ta	= $request->txtLSPIntro;
			$loaisanpham->loaisanpham_anh	= $imageName;
			$loaisanpham->loaisanpham_url	= Replace_TiengViet($request->txtLSPName);
			
			$loaisanpham->save();
			alert()->success('Thêm loại sản phẩm thành công.','Thông báo');
			return redirect()->route('admin.loaisanpham.list');
		}

		public function getDelete($id)
		{
			$loaisanpham = DB::table('loaisanpham')->where('id',$id)->first();
					$img = 'resources/upload/loaisanpham/'.$loaisanpham->loaisanpham_anh;
					File::delete($img);
			DB::table('loaisanpham')->where('id',$id)->delete();
			$sanpham = DB::table('sanpham')->where('loaisanpham_id',$loaisanpham->id)->get();
			foreach($sanpham as $key => $val){
				$img = 'resources/upload/sanpham/'.$val->sanpham_anh;
					File::delete($img);
					DB::table('sanpham')->where('id',$val->id)->delete();
					DB::table('lohang')->where('sanpham_id',$val->id)->delete();
			}

			alert()->success('Xóa loại sản phẩm thành công.','Thông báo');
					return redirect()->route('admin.loaisanpham.list');
		}

		public function getEdit($id)
		{
			$loaisp = DB::table('loaisanpham')->where('id',$id)->first();
			$data = DB::table('nhom')->get();
			foreach ($data as $key => $val) {
				$nhom[] = ['id' => $val->id, 'name'=> $val->nhom_ten];
			}
			return view('backend.loaisanpham.sua',compact('nhom','loaisp','id'));
		}

		public function postEdit(LoaisanphamEditRequest $request,$id)
		{
			$fImage = $request->fImage;
					$img_current = 'resources/upload/loaisanpham/'.$request->fImageCurrent;
					if (!empty($fImage )) {
							$filename=$fImage ->getClientOriginalName();
							DB::table('loaisanpham')->where('id',$id)
															->update([
																	'loaisanpham_ten' => $request->txtLSPName,
																	'loaisanpham_url' => Replace_TiengViet($request->txtLSPName),
																	'nhom_id'=>$request->txtLSPParent,
																	'loaisanpham_mo_ta'=>$request->txtLSPIntro,
																	'loaisanpham_anh' => $filename
																	]);
							$fImage ->move(base_path() . '/resources/upload/loaisanpham/', $filename);
							File::delete($img_current);
					} else {
							DB::table('loaisanpham')->where('id',$id)
															->update([
																	'loaisanpham_ten' => $request->txtLSPName,
																	'loaisanpham_url' => Replace_TiengViet($request->txtLSPName),
																	'nhom_id'=>$request->txtLSPParent,
																	'loaisanpham_mo_ta'=>$request->txtLSPIntro
																	]);
					}
					alert()->success('Sửa loại sản phẩm thành công.','Thông báo');
			return redirect()->route('admin.loaisanpham.list');
		}
}
