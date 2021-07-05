<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\GiaohangRequest;
use Illuminate\Support\Facades\Redirect;
use App\Donhang;
use App\Lohang;
use App\CTtheolo;
use DB;
use PDF;
use Session;
session_start();

class DonhangController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}
    public function getList()
    {
			$data = DB::table('donhang')->get();
    	return view('backend.donhang.danhsach',compact('data'));
    }

    public function getEdit($id)
    {
		$data = DB::table('tinhtranghd')->get();
		foreach ($data as $key => $val) {
			$tinhtrang[] = ['id' => $val->id, 'name'=> $val->tinhtranghd_ten];
		}
    	$donhang = DB::table('donhang')->where('id',$id)->first();
    	$khachhang = DB::table('khachhang')->where('id',$donhang->khachhang_id)->first();
			$chitiet = DB::table('chitietdonhang')->where('donhang_id',$donhang->id)->get();
			if($donhang->donhang_xu_ly == 1){
			return view('backend.donhang.sua',compact('donhang','tinhtrang','khachhang','chitiet'));
			}
			else{
				alert()->warning('Bạn cần xử lý đơn hàng theo lô trước khi thực hiện thao tác này','Cảnh báo')->autoclose(3500);
				return redirect()->route('admin.donhang.list');
			}
    }

    public function postEdit(Request $request,$id)
    {
			$donhang = DB::table('donhang')->where('id',$id)->first();
			$kh = DB::table('khachhang')->where('id',$donhang->khachhang_id)->first();
    	$status1 = $donhang->tinhtranghd_id;
    	$status2 = $request->selStatus;

				if ($status1 == 1 && $status2 == 3) {
					DB::table('donhang')->where('id',$id)
						->update([
						'tinhtranghd_id' => $status2,
						]);

				}elseif ($status1 ==1 && $status2 == 4 ) {
						DB::table('donhang')->where('id',$id)
						->update([
							'tinhtranghd_id' => $status1,
						]);
				}elseif ($status1 ==1 && $status2 == 2 ) {
					DB::table('donhang')->where('id',$id)
							->update([
									'tinhtranghd_id' => $status2,
							]);
					$idss =	DB::table('lohang')->join('cttheolo','lohang.id','=','cttheolo.lohang_id')->where('cttheolo.cttheolo_ma',$id)->get();
					foreach ($idss as $key => $value) {
								DB::table('lohang')
								->where('id',$value->lohang_id)
								->update([
									'lohang_so_luong_da_ban' => $value->lohang_so_luong_da_ban + $value->cttheolo_so_luong,
									'lohang_so_luong_hien_tai' => $value->lohang_so_luong_hien_tai - $value->cttheolo_so_luong,
									]);
								}
						$a = ($kh->khachhang_tonno_dk + $kh->khachhang_phat_sinh_no + $donhang->donhang_tong_tien) - ($kh->khachhang_tonco_dk + $kh->khachhang_phat_sinh_co);
						if($a > 0){
								DB::table('khachhang')->where('id',$kh->id)->update([
										'khachhang_phat_sinh_no' => $donhang->donhang_tong_tien + $kh->khachhang_phat_sinh_no,
										'khachhang_tonno_ck'=> $a,
										'khachhang_tonco_ck'=> 0,
								]);
						}
						else{
								DB::table('khachmua')->where('id',$kh->id)->update([
										'khachhang_phat_sinh_no' => $donhang->donhang_tong_tien + $kh->khachhang_phat_sinh_no,
										'khachhang_tonno_ck'=> 0,
										'khachhang_tonco_ck'=> - $a,
								]);
						}
				}elseif ($status1 ==2 && $status2 == 3) {
					DB::table('donhang')->where('id',$id)
					->update([
					'tinhtranghd_id' => $status2,
					]);
						$idss =	DB::table('lohang')->join('cttheolo','lohang.id','=','cttheolo.lohang_id')->where('cttheolo.cttheolo_ma',$id)->get();
						foreach ($idss as $key => $value) {
									DB::table('lohang')
									->where('id',$value->lohang_id)
									->update([
													// 'lohang_so_luong_doi_tra' => $value->lohang_so_luong_doi_tra + $value->cttheolo_so_luong,
													'lohang_so_luong_hien_tai' => $value->lohang_so_luong_hien_tai + $value->cttheolo_so_luong,
													'lohang_so_luong_da_ban' => $value->lohang_so_luong_da_ban - $value->cttheolo_so_luong,
													]);
						
						}
				}elseif ($status1 == 2 && $status2 == 1) {
					DB::table('donhang')->where('id',$id)
									->update([
									'tinhtranghd_id' => $status1,
									]);
				}elseif ($status1 == 2 && $status2 == 4) {
					DB::table('donhang')->where('id',$id)
							->update([
							'tinhtranghd_id' => $status2,
							]);
			}elseif ($status1 == 4 && $status2 !=4) {
							DB::table('donhang')->where('id',$id)
								->update([
								'tinhtranghd_id' => $status1,
								]);	
															
			}elseif ($status1 == 3 && $status2 !=3) {
							DB::table('donhang')->where('id',$id)
							->update([
							'tinhtranghd_id' => $status1,
							]);
			}else {
							DB::table('donhang')->where('id',$id)
							->update([
											'tinhtranghd_id' => $status2,
									]);
			}
			if($status1 ==1 && $status2 == 4 ){
				alert()->warning('Bạn cần xác nhận đơn hàng trước khi giao','Cảnh báo');
			}
			else{
			alert()->success('Chỉnh sửa thành công.','Thông báo');
			}
    	return redirect()->route('admin.donhang.list');
    	
    }
    public function getEdit1($id)
    {
    	$data = DB::table('tinhtranghd')->get();
		foreach ($data as $key => $val) {
			$tinhtrang[] = ['id' => $val->id, 'name'=> $val->tinhtranghd_ten];
		}
    	$donhang = DB::table('donhang')->where('id',$id)->first();
    	$khachhang = DB::table('khachhang')->where('id',$donhang->khachhang_id)->first();
    	$chitiet = DB::table('chitietdonhang')->where('donhang_id',$donhang->id)->get();
    	return view('backend.donhang.suagiaohang',compact('donhang','tinhtrang','khachhang','chitiet'));
    }

    public function postEdit1(GiaohangRequest $request,$id)
    {
    	DB::table('donhang')
    		->where('id',$id)
    		->update([
    			'donhang_nguoi_nhan'=> $request->txtName,
    			'donhang_nguoi_nhan_sdt'=> $request->txtPhone,
    			'donhang_nguoi_nhan_email'=> $request->txtEmail,
    			'donhang_nguoi_nhan_dia_chi'=> $request->txtAddress,
    			'donhang_ghi_chu'=> $request->txtNote,
				]);
				alert()->success('Chỉnh sửa thành công.','Thông báo');
    	return redirect()->route('admin.donhang.list');
    }

    public function getEdit2($id)
    {
    	$data = DB::table('tinhtranghd')->get();
		foreach ($data as $key => $val) {
			$tinhtrang[] = ['id' => $val->id, 'name'=> $val->tinhtranghd_ten];
		}
    	$donhang = DB::table('donhang')->where('id',$id)->first();
    	$khachhang = DB::table('khachhang')->where('id',$donhang->khachhang_id)->first();
    	$chitiet = DB::table('chitietdonhang')->where('donhang_id',$donhang->id)->get();
    	return view('backend.donhang.suathanhtoan',compact('donhang','tinhtrang','khachhang','chitiet'));
    }
    public function postEdit2(Request $request,$id)
    {
    	// $idSP = DB::table('chitietdonhang')->select('sanpham_id')->where('donhang_id',$id)->get();
    	$sp= DB::select('select sanpham_id,chitietdonhang_so_luong,chitietdonhang_thanh_tien,(chitietdonhang_thanh_tien/chitietdonhang_so_luong) as gia from chitietdonhang where donhang_id = ?', [$id]);
    	// print_r(count($idSP));
    	$data = $request->input('products',[]);
    	// print_r($data);
    	for ($i=0; $i < count($sp); $i++) { 
    		$a = $sp[$i]->sanpham_id;
    		DB::table('chitietdonhang')
    			->where([['sanpham_id',$a],['donhang_id',$id] ])
    			->update([
    				'chitietdonhang_so_luong'=>$request->txtQuant[$i],
    				'chitietdonhang_thanh_tien'=>($request->txtQuant[$i]*$sp[$i]->gia),
    				]);
    	}
    	//Delete san pham khoi gio hang
    	foreach ($data as  $val) {
    		DB::table('chitietdonhang')->where([['sanpham_id',$val],['donhang_id',$id] ])	->delete();
    	}
    	//Tinh lai tong gia tri don hang
    	$tong = DB::select('select sum(chitietdonhang_thanh_tien) as tong from chitietdonhang where donhang_id = ?', [$id]);
    	// print_r($tong[0]->tong);
    	$p = DB::table('donhang')->where('id',$id)->update(['donhang_tong_tien' =>$tong[0]->tong,	]);
			alert()->success('Chỉnh sửa thành công.','Thông báo');
    	return redirect()->route('admin.donhang.list');
		}

    public function pdf($id)
    {
        $donhang = DB::table('donhang')->where('id',$id)->first();
        $chitietdonhang = DB::table('chitietdonhang')->where('donhang_id',$id)->get();
        $khachhang = DB::table('khachhang')->where('id',$donhang->khachhang_id)->first();
        // print_r($khachhang);
        $pdf = PDF::loadView('backend.donhang.hoadon',compact('donhang','chitietdonhang','khachhang'));
        return $pdf->stream();
		}
		public function chitietdonhang($id){
			$donhang = DB::table('donhang')->where('id',$id)->first();
			$chitiet = DB::table('chitietdonhang')->where('donhang_id',$donhang->id)->get();
			// dd($chitietlo);
			foreach ($chitiet as $key => $val) {
				$ids[] = $val->id;
			}
			$ctlb = DB::table('chitietdonhang')->where('id',$ids)->first();
			if(session('chon')){
			foreach(session('chon') as $id => $details){
				$spid = $details['sanpham'];
			}
		}
			return view('backend.donhang.chitietdonhang',compact('donhang','chitiet','ctlb','ct','spid'));
	}
	public function chonlo($id){
		$chon = Lohang::find($id);
		$sanpham = DB::table('sanpham')->where('id',$chon->sanpham_id)->first();
		$chon = DB::select('select * from lohang where id = ?',[$id]);
			// print_r($sanpham);
		if ($sanpham->sanpham_khuyenmai == 1) {
					$chonlohang = DB::select('select lh.id,sp.sanpham_ten,sp.sanpham_gia_ban,lh.sanpham_id,lh.lohang_ky_hieu,sp.sanpham_khuyenmai, sp.id, km.khuyenmai_phan_tram, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc, sanphamkhuyenmai as spkm, khuyenmai as km  where km.khuyenmai_tinh_trang = 1 and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and ncc.id = lh.nhacungcap_id and lh.lohang_so_luong_hien_tai > 0 and lh.sanpham_id = sp.id and lh.id = ?', [$id]);
			
					$giakm = $chonlohang[0]->sanpham_gia_ban - $chonlohang[0]->sanpham_gia_ban*$chonlohang[0]
					->khuyenmai_phan_tram*0.01;
					// $spid = $chonlohang[0]->sanpham_id;
					// dd($spid);

		if(!$chon) {

				abort(404);
		}

		$chon = session()->get('chon');
		if(!$chon) {

				$chon = [
								$id => [
										"name" => $chonlohang[0]->lohang_ky_hieu,
										"quantity" => 1,
										"price" => $giakm,
										"sanpham" => $chonlohang[0]->sanpham_id
								]
				];
				// dd($giakm);

				session()->put('chon', $chon);
				alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
				return redirect()->back();
		}
		if(isset($chon[$id])) {

				$chon[$id]['quantity']++;

				session()->put('chon', $chon);
				alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
				return redirect()->back();

		}
		// if item not exist in cart then add to cart with quantity = 1
		$chon[$id] = [
				"name" => $chonlohang[0]->lohang_ky_hieu,
				"quantity" => 1,
				"price" => $giakm,
				"sanpham" => $chonlohang[0]->sanpham_id
		];

		session()->put('chon', $chon);
		alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
		return redirect()->back();
	}
	else{
		$chonlohang = DB::select('select lh.id,sp.sanpham_ten,sp.sanpham_gia_ban,lh.sanpham_id,lh.lohang_ky_hieu,sp.sanpham_khuyenmai, sp.id, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc  where ncc.id = lh.nhacungcap_id and lh.lohang_so_luong_hien_tai > 0 and lh.sanpham_id = sp.id and lh.id = ?', [$id]);
			
		$gia = $chonlohang[0]->sanpham_gia_ban;

			if(!$chon) {

					abort(404);
			}

			$chon = session()->get('chon');
			if(!$chon) {

					$chon = [
									$id => [
											"name" => $chonlohang[0]->lohang_ky_hieu,
											"quantity" => 1,
											"price" => $gia,
											"sanpham" => $chonlohang[0]->sanpham_id
									]
					];
				

					session()->put('chon', $chon);
					alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
					return redirect()->back();
			}
			if(isset($chon[$id])) {

					$chon[$id]['quantity']++;

					session()->put('chon', $chon);
					alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
					return redirect()->back();

			}
			// if item not exist in cart then add to cart with quantity = 1
			$chon[$id] = [
					"name" => $chonlohang[0]->lohang_ky_hieu,
					"quantity" => 1,
					"price" => $gia,
					"sanpham" => $chonlohang[0]->sanpham_id,
			];

			session()->put('chon', $chon);
			alert()->success('Sản phẩm chọn theo lô đã được thêm.','Thông báo');
			return redirect()->back();

					}

	}
	public function postlolo(Request $request)
	{
		$chon = session()->get('chon');
		foreach(session('chon') as $id => $details)
			foreach ($chon as $key =>$value) {
				$detail = new CTtheolo;
				$detail->lohang_id = $key;
				$detail->cttheolo_ma = $request->cttma;
				$detail->ctdonhang_id = $request->ctdonid;
				$detail->cttheolo_so_luong = $value['quantity'];
				$detail->cttheolo_thanh_tien = $value['price']*$value['quantity'];
				$detail->save();
				$donhang = Donhang::find($detail->cttheolo_ma);
				$donhang->update(['donhang_xu_ly'=>1]);
				
		}
	
		Session::forget('chon');
		alert()->success('Chi tiết đơn hàng theo lô đã được thêm.','Thông báo');
					return redirect::back();
	}
	public function capnhatdonlo(Request $request)
	{
			if($request->id)
			{
						 
					$chon = session()->get('chon');

					$chon[$request->id]["quantity"] = $request->quantity;
					session()->put('chon', $chon);

					alert()->success('Cập nhật thành công.','Thông báo');
			}
	}
	public function removedonlo(Request $request)
	{
			if($request->id) {

					$chon = session()->get('chon');

					if(isset($chon[$request->id])) {

							unset($chon[$request->id]);

							session()->put('chon', $chon);
					}
					alert()->success('Xóa thành công.','Thông báo');
			}
	}
	public function xemchitietdonhanglo($id){
		$donhang = DB::table('donhang')->where('id',$id)->first();
		$chitietlo = DB::table('cttheolo')->where('cttheolo_ma',$donhang->id)->get();
		$chitietdonhang = DB::table('chitietdonhang')->where('donhang_id',$donhang->id)->get();
		return view('backend.donhang.cttheolo',compact('chitietlo','donhang','chitietdonhang'));
	}

}
