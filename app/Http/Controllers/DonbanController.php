<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\GiaohangRequest;
use App\Http\Requests\LohangAddRequest;
use Illuminate\Support\Facades\Redirect;
use App\Donban;
use App\Lohang;
use App\Chitietdonban;
use App\CTbantheolo;
use DB;
use PDF;
use Session;
session_start();

class DonbanController extends Controller
{
		//
		public function __construct() {
      $this->middleware('auth');
    }
    public function getList()
    {
			$data = DB::table('donban')->get();
			// $tinhtrang = DB::table('tinhtranghd')->get();
			// dd($tinhtrang);
    	return view('backend.bannoibo.danhsach',compact('data'));
    }
    public function getEdit($id)
    {
    	$data = DB::table('tinhtranghd')->get();
			foreach ($data as $key => $val) {
			$tinhtrang[] = ['id' => $val->id, 'name'=> $val->tinhtranghd_ten];
		}
    	$donban = DB::table('donban')->where('id',$id)->first();
    	$khachmua = DB::table('khachmua')->where('id',$donban->khachmua_id)->first();
			$chitiet = DB::table('chitietdonban')->where('donban_id',$donban->id)->get();
			if($donban->donban_xu_ly == 1){
			return view('backend.bannoibo.suatinhtrang',compact('donban','tinhtrang','khachmua','chitiet'));
			}
			else{
				alert()->warning('Bạn cần xử lý đơn hàng theo lô trước khi thực hiện thao tác này','Cảnh báo')->autoclose(3500);
				return redirect()->route('admin.donban.list');
			}
    }

		public function postEdit(Request $request,$id)
		{
				$donban = DB::table('donban')->where('id',$id)->first();
				$status1 = $donban->tinhtranghd_id;
				$status2 = $request->selStatus;
 
				if ($status1 == 1 && $status2 == 3) {
						DB::table('donban')->where('id',$id)
								->update([
												'tinhtranghd_id' => $status2,
												]);
				}elseif ($status1 ==1 && $status2 == 4 ) {
				 DB::table('donban')->where('id',$id)
						 ->update([
										 'tinhtranghd_id' => $status2,
								 ]);
								 $idss =	DB::table('lohang')->join('ctbantheolo','lohang.id','=','ctbantheolo.lohang_id')->where('ctbantheolo.ctbantheolo_ma',$id)->get();
								 foreach ($idss as $key => $value) {
						 DB::table('lohang')
								 ->where('id',$value->lohang_id)
								 ->update([
										 'lohang_so_luong_da_ban' => $value->lohang_so_luong_da_ban + $value->ctbantheolo_so_luong,
										 'lohang_so_luong_hien_tai' => $value->lohang_so_luong_hien_tai - $value->ctbantheolo_so_luong,
										 ]);
								 }
				}
				elseif ($status1 ==1 && $status2 == 2 ) {
				DB::table('donban')->where('id',$id)
						->update([
										'tinhtranghd_id' => $status2,
								]);
								$idss =	DB::table('lohang')->join('ctbantheolo','lohang.id','=','ctbantheolo.lohang_id')->where('ctbantheolo.ctbantheolo_ma',$id)->get();
								foreach ($idss as $key => $value) {
						DB::table('lohang')
								->where('id',$value->lohang_id)
								->update([
										'lohang_so_luong_da_ban' => $value->lohang_so_luong_da_ban + $value->ctbantheolo_so_luong,
										'lohang_so_luong_hien_tai' => $value->lohang_so_luong_hien_tai - $value->ctbantheolo_so_luong,
										]);
								}
				 }elseif ($status1 ==2 && $status2 == 3) {
						DB::table('donban')->where('id',$id)
								->update([
												'tinhtranghd_id' => $status2,
										]);
										$idss =	DB::table('lohang')->join('ctbantheolo','lohang.id','=','ctbantheolo.lohang_id')->where('ctbantheolo.ctbantheolo_ma',$id)->get();
										foreach ($idss as $key => $value) {
								DB::table('lohang')
										->where('id',$value->lohang_id)
										->update([
												// 'lohang_so_luong_doi_tra' => $value->lohang_so_luong_doi_tra + $value->ctbantheolo_so_luong,
												'lohang_so_luong_hien_tai' => $value->lohang_so_luong_hien_tai + $value->ctbantheolo_so_luong,
												'lohang_so_luong_da_ban' => $value->lohang_so_luong_da_ban - $value->ctbantheolo_so_luong,
												]);
						}
				}elseif ($status1 == 2 && $status2 == 1) {
						DB::table('donban')->where('id',$id)
								->update([
												'tinhtranghd_id' => $status1,
										]);
						}
				 elseif ($status1 == 2 && $status2 == 4) {
				 DB::table('donban')->where('id',$id)
						 ->update([
										 'tinhtranghd_id' => $status2,
								 ]);
				 }
				 elseif ($status1 == 4 && $status2 !=4) {
						 DB::table('donban')->where('id',$id)
								 ->update([
												 'tinhtranghd_id' => $status1,
										 ]);
										 
						 }
				 elseif ($status1 == 3 && $status2 !=3) {
						 DB::table('donban')->where('id',$id)
								 ->update([
												 'tinhtranghd_id' => $status1,
										 ]);
						 }
						 else {
							DB::table('donban')->where('id',$id)
								->update([
										'tinhtranghd_id' => $status2,
									]);
						}

						alert()->success('Chỉnh sửa thành công.','Thông báo');
				return redirect()->route('admin.donban.list');
				
		}
    public function getEdit1($id)
    {
    	$data = DB::table('tinhtranghd')->get();
		foreach ($data as $key => $val) {
			$tinhtrang[] = ['id' => $val->id, 'name'=> $val->tinhtranghd_ten];
		}
    	$donban = DB::table('donban')->where('id',$id)->first();
    	$khachmua = DB::table('khachmua')->where('id',$donban->khachmua_id)->first();
    	$chitiet = DB::table('chitietdonban')->where('donban_id',$donban->id)->get();
    	return view('backend.bannoibo.suagiaohang',compact('donban','tinhtrang','khachmua','chitiet'));
    }
    public function postEdit1(GiaohangRequest $request,$id)
    {
    	DB::table('donban')->where('id',$id)
    		->update([
    			'donban_nguoi_nhan'=> $request->txtName,
    			'donban_nguoi_nhan_sdt'=> $request->txtPhone,
    			'donban_nguoi_nhan_email'=> $request->txtEmail,
    			'donban_nguoi_nhan_dia_chi'=> $request->txtAddress,
    			'donban_ghi_chu'=> $request->txtNote,
				]);
				alert()->success('Chỉnh sửa thành công.','Thông báo');
    	return redirect()->route('admin.donban.list');
    }
    
    public function getEdit2($id)
    {
    	$data = DB::table('tinhtranghd')->get();
		foreach ($data as $key => $val) {
			$tinhtrang[] = ['id' => $val->id, 'name'=> $val->tinhtranghd_ten];
		}
    	$donban = DB::table('donban')->where('id',$id)->first();
    	$khachmua = DB::table('khachmua')->where('id',$donban->khachmua_id)->first();
			$chitiet = DB::table('chitietdonban')->where('donban_id',$donban->id)->get();
			
			if($donban->donban_xu_ly != 1){
				return view('backend.bannoibo.suathanhtoan',compact('donban','tinhtrang','khachmua','chitiet'));
				}
				else{
					alert()->warning('Bạn không thể thực hiện thao tác này','Cảnh báo')->autoclose(3500);
					return redirect()->route('admin.donban.list');
				}
    }
    public function postEdit2(Request $request,$id)
    {
    	$sp= DB::select('select sanpham_id,chitietdonban_so_luong,chitietdonban_thanh_tien,(chitietdonban_thanh_tien/chitietdonban_so_luong) as gia from chitietdonban where donban_id = ?', [$id]);

    	$data = $request->input('products',[]);
    	for ($i=0; $i < count($sp); $i++) { 
    		$a = $sp[$i]->sanpham_id;
    		DB::table('chitietdonban')->where([['sanpham_id',$a],['donban_id',$id] ])
    			->update([
    				'chitietdonban_so_luong'=>$request->txtQuant[$i],
    				'chitietdonban_thanh_tien'=>($request->txtQuant[$i]*$sp[$i]->gia),
    				]);
    	}

    	//Delete san pham khoi đơn bán hàng
    	foreach ($data as  $val) {
    		DB::table('chitietdonban')->where([['sanpham_id',$val],['donban_id',$id] ])->delete();
    	}

    	$tong = DB::select('select sum(chitietdonban_thanh_tien) as tong from chitietdonban where donban_id = ?', [$id]);
    	$p = DB::table('donban')->where('id',$id)->update(['donban_tong_tien' =>$tong[0]->tong,]);
			alert()->success('Chỉnh sửa thành công.','Thông báo');
    	return redirect()->route('admin.donban.list');
		}
    
		public function pdf($id)
    {
        $donban = DB::table('donban')->where('id',$id)->first();
        $chitietdonban = DB::table('chitietdonban')->where('donban_id',$id)->get();
        $khachmua = DB::table('khachmua')->where('id',$donban->khachmua_id)->first();
        // print_r($khachmua);
        $pdf = PDF::loadView('backend.bannoibo.hoadon',compact('donban','chitietdonban','khachmua'));
        return $pdf->stream();
		}
		public function chitietdonban($id){
				$donban = DB::table('donban')->where('id',$id)->first();
				$chitiet = DB::table('chitietdonban')->where('donban_id',$donban->id)->get();
				foreach ($chitiet as $key => $val) {
					$ids[] = $val->id;
			}
				$ctlb = DB::table('chitietdonban')->select('donban_id')->where('id',$ids)->first();
				if(session('chonlo')){
					foreach(session('chonlo') as $id => $details){
						$spid = $details['sanpham'];
					}
				}
				return view('backend.bannoibo.chitietdonban',compact('donban','chitiet','ctlb','spid'));

		}
		public function chonlo($id){
			$chonlo = Lohang::find($id);
			$sanpham = DB::table('sanpham')->where('id',$chonlo->sanpham_id)->first();
			$chonlo = DB::select('select * from lohang where id = ?',[$id]);
				// print_r($sanpham);
			if ($sanpham->sanpham_khuyenmai == 1) {
						$chonlohang = DB::select('select lh.id,sp.sanpham_ten,sp.sanpham_gia_ban,lh.sanpham_id,lh.lohang_ky_hieu,sp.sanpham_khuyenmai, sp.id, km.khuyenmai_phan_tram, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc, sanphamkhuyenmai as spkm, khuyenmai as km  where km.khuyenmai_tinh_trang = 1 and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and ncc.id = lh.nhacungcap_id and lh.lohang_so_luong_hien_tai > 0 and lh.sanpham_id = sp.id and lh.id = ?', [$id]);
				
						$giakm = $chonlohang[0]->sanpham_gia_ban - $chonlohang[0]->sanpham_gia_ban*$chonlohang[0]
						->khuyenmai_phan_tram*0.01;
						$spid = $chonlohang[0]->sanpham_id;
						// dd($spid);

			if(!$chonlo) {

					abort(404);
			}

			$chonlo = session()->get('chonlo');
			if(!$chonlo) {

					$chonlo = [
									$id => [
											"name" => $chonlohang[0]->lohang_ky_hieu,
											"quantity" => 1,
											"price" => $giakm,
											"sanpham" => $spid
									]
					];
					// dd($giakm);

					session()->put('chonlo', $chonlo);
					alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
					return redirect()->back();
			}
			if(isset($chonlo[$id])) {

					$chonlo[$id]['quantity']++;

					session()->put('chonlo', $chonlo);
					alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
					return redirect()->back();

			}
			// if item not exist in cart then add to cart with quantity = 1
			$chonlo[$id] = [
					"name" => $chonlohang[0]->lohang_ky_hieu,
					"quantity" => 1,
					"price" => $giakm,
					"sanpham" => $spid,
			];

			session()->put('chonlo', $chonlo);
			alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
			return redirect()->back();
		}
		else{
			$chonlohang = DB::select('select lh.id,sp.sanpham_ten,sp.sanpham_gia_ban,lh.sanpham_id,lh.lohang_ky_hieu,sp.sanpham_khuyenmai, sp.id, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc where  ncc.id = lh.nhacungcap_id and lh.lohang_so_luong_hien_tai > 0 and lh.sanpham_id = sp.id and lh.id = ?', [$id]);
				
			$gia = $chonlohang[0]->sanpham_gia_ban;
			$spi = $chonlohang[0]->sanpham_id;

				if(!$chonlo) {

						abort(404);
				}

				$chonlo = session()->get('chonlo');
				if(!$chonlo) {

						$chonlo = [
										$id => [
												"name" => $chonlohang[0]->lohang_ky_hieu,
												"quantity" => 1,
												"price" => $gia,
												"sanpham" => $spi
										]
						];
					

						session()->put('chonlo', $chonlo);
						alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
						return redirect()->back();
				}
				if(isset($chonlo[$id])) {

						$chonlo[$id]['quantity']++;

						session()->put('chonlo', $chonlo);
						alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
						return redirect()->back();

				}
				// if item not exist in cart then add to cart with quantity = 1
				$chonlo[$id] = [
						"name" => $chonlohang[0]->lohang_ky_hieu,
						"quantity" => 1,
						"price" => $gia,
						"sanpham" => $spi,
				];

				session()->put('chonlo', $chonlo);
				alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
				return redirect()->back();

				}

		}

		public function postlo(Request $request)
    {

						$ctlo = new CTbantheolo;
						$ctlo->id = $request->id;
						$ctlo->lohang_id = $request->idlh;
            $ctlo->ctbantheolo_so_luong = $request->lbsl;
            $ctlo->ctbantheolo_thanh_tien = $request->lbtt;
						$ctlo->save();
						alert()->success('Chi tiết bán theo lô đã được thêm.','Thông báo');
						return redirect::back();
		}
		public function postlolo(Request $request)
    {
			$chonlo = session()->get('chonlo');
			foreach(session('chonlo') as $id => $details)
				foreach ($chonlo as $key =>$value) {
					$detail = new CTbantheolo;
					$detail->lohang_id = $key;
					$detail->ctbantheolo_ma = $request->chitietma;
					$detail->ctdonban_id = $request->ctbanid;
					$detail->ctbantheolo_so_luong = $value['quantity'];
					$detail->ctbantheolo_thanh_tien = $value['price']*$value['quantity'];
					$detail->save();
					$donban = DB::table('donban')->where('id',$detail->ctbantheolo_ma)->update(['donban_xu_ly'=>1]);
					
			}
		
			Session::forget('chonlo');
			alert()->success('Chi tiết bán theo lô đã được thêm.','Thông báo');
			return redirect::back();
		}
		public function capnhatdonlo(Request $request)
    {
        if($request->id)
        {
               
            $chonlo = session()->get('chonlo');
 
            $chonlo[$request->id]["quantity"] = $request->quantity;
            session()->put('chonlo', $chonlo);
 
						alert()->success('Cận phật thành công.','Thông báo');
        }
    }
    public function removedonlo(Request $request)
    {
        if($request->id) {
 
            $chonlo = session()->get('chonlo');
 
            if(isset($chonlo[$request->id])) {
 
                unset($chonlo[$request->id]);
 
                session()->put('chonlo', $chonlo);
            }
						alert()->success('Xóa thành công.','Thông báo');
        }
		}
		public function xemchitietdonlo($id){
			$donban = DB::table('donban')->where('id',$id)->first();
			$chitietlo = DB::table('ctbantheolo')->where('ctbantheolo_ma',$donban->id)->get();
			$chitietdonban = DB::table('chitietdonban')->where('donban_id',$donban->id)->get();
			return view('backend.bannoibo.ctbantheolo',compact('chitietlo','donban','chitietdonban'));
		}
}
