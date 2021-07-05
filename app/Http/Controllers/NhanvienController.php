<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NhanvienAddRequest;
use App\Http\Requests\NhanvienEditRequest;
use App\Nhanvien;
use App\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Hash;

class NhanvienController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function getList()
    {
        $data = DB::table('nhanvien')->join('users', 'users.id', '=', 'nhanvien.user_id')
        ->select('users.*', 'nhanvien.*')->get();
            // print_r($data);
    	return view('backend.nhanvien.danhsach',compact('data'));
    }

    public function getAdd()
    {
        if(Auth::user()->id == 1){
            $data = DB::table('loainguoidung')->get();
            foreach ($data as $key => $val) {
                $loainguoidung[] = ['id' => $val->id, 'name'=> $val->loainguoidung_ten];
            }
            return view('backend.nhanvien.them',compact('loainguoidung'));
        }else{
            alert()->warning('Bạn không thể thêm nhân viên.','Cảnh báo');
            return redirect::back();
        }
    }

    public function postAdd(NhanvienAddRequest $request)
    {
        $user = new User;
        $user->name = $request->txtUsername;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtPass);
        $user->loainguoidung_id = $request->txtRole;
        $user->remember_token = $request->_token;
        $user->save();

        $id = DB::table('users')->select('id')->where('email',$request->txtEmail)->first();
        $userid = $id->id;

    	$nhanvien = new Nhanvien;
        $nhanvien->nhanvien_ten = $request->txtNVName;
        $nhanvien->nhanvien_cmnd = $request->txtNVID;
        $nhanvien->nhanvien_sdt = $request->txtNVPhone;
        $nhanvien->nhanvien_ngay_vao_lam = $request->txtNVDate;
        $nhanvien->nhanvien_dia_chi = $request->txtNVAddress;
        $nhanvien->user_id = $userid;
        $nhanvien->save();
        alert()->success('Thêm nhân viên thành công.','Thông báo');
        return redirect()->route('admin.nhanvien.list');
    }

    public function getDelete($id)
    {
        if(Auth::user()->id == 1){
            $id_user = DB::table('nhanvien')->select('user_id')->where('id',$id)->first();
            DB::table('nhanvien')->where('id',$id)->delete();
            DB::table('users')->where('id',$id_user->user_id)->delete();
            alert()->success('Xóa nhân viên thành công.','Thông báo');
            return redirect()->route('admin.nhanvien.list');
        }else{
            alert()->warning('Bạn không thể xóa nhân viên.','Cảnh báo');
            return redirect::back();
        }
    }

    public function getEdit($id)
    {
        $nhanvien = DB::table('nhanvien')->where('id',$id)->first();
    	$data = DB::table('loainguoidung')->get();
        foreach ($data as $key => $val) {
            $loainguoidung[] = ['id' => $val->id, 'name'=> $val->loainguoidung_ten];
        }
        return view('backend.nhanvien.sua',compact('loainguoidung','nhanvien'));
    }

    public function postEdit(NhanvienEditRequest $request,$id)
    {
        $nhanvien = DB::table('nhanvien')->where('id',$id)->first();
    	DB::table('nhanvien')->where('id',$id)
                           ->update([
                    'nhanvien_ten' => $request->txtNVName,
                    'nhanvien_dia_chi' => $request->txtNVAddress,
                    'nhanvien_sdt' => $request->txtNVPhone,
                    'nhanvien_cmnd' => $request->txtNVID,
                    'nhanvien_ngay_vao_lam' => $request->txtNVDate               
            ]);
            alert()->success('Sửa nhân viên thành công.','Thông báo');
            return redirect()->route('admin.nhanvien.list');
    }
}
