<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests;
use Hash;
use DB;
use Mail;
use Auth;
use App\ResetPassword;
use Illuminate\Support\Str;
use App\User;

class UserController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function getList(){
        if(Auth::user()->id == 1){
            $data = DB::table('users')->get();
            return view('backend.user.danhsach',compact('data'));
        }else{
            $data = DB::table('users')->get();
            alert()->warning('Bạn không thể truy cập vào đây.','cảnh báo');
            return redirect::back();
        }
    }
    public function getAdd()
    {
        if(Auth::user()->id == 1){
            $data = DB::table('loainguoidung')->get();
            foreach ($data as $key => $val) {
                $loainguoidung[] = ['id' => $val->id, 'name'=> $val->loainguoidung_ten];
            }
            return view('backend.user.them',compact('loainguoidung'));
        }else{
            $data = DB::table('users')->get();
            alert()->warning('Bạn không thể thêm người dùng.','cảnh báo');
            return redirect()->route('admin.user.list');
        }
    }
    public function postAdd(UserAddRequest $request ){
        $user = new User;
        $user->name = $request->txtUsername;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtPass);
        $user->loainguoidung_id = $request->txtRole;
        $user->remember_token = $request->_token;
        $user->save();
        alert()->success('Thêm người dùng thành công.','Thông báo');
        return redirect()->route('admin.user.list');
    }
    public function getEdit($id)
    {
        if(Auth::user()->id == 1){
            $user = DB::table('users')->where('id',$id)->first();
            return view('backend.user.sua',compact('user'));
        }else{
            $data = DB::table('users')->get();
            alert()->warning('Bạn không thể sửa người dùng.','cảnh báo');
            return redirect()->route('admin.user.list');
        }
    }
    public function getDelete($id){
        if(Auth::user()->id == 1){
            $user = DB::table('users')->where('id',$id)->first();
            if($user->loainguoidung_id == 1){
                DB::table('users')->where('id',$id)->delete();
            }
            elseif($user->loainguoidung_id == 2){
                DB::table('users')->where('id',$user->user_id)->delete();
                DB::table('khachhang')->where('user_id',$id)->delete();
            }
            elseif($user->loainguoidung_id == 3){
                DB::table('users')->where('id',$user->user_id)->delete();
                DB::table('nhanvien')->where('user_id',$id)->delete();
            }
            alert()->success('Xóa người dùng thành công.','Thông báo');
            return redirect()->route('admin.user.list');
        }else{
            $data = DB::table('users')->get();
            alert()->warning('Bạn không thể xóa người dùng.','cảnh báo');
            return redirect()->route('admin.user.list');
        }
        
    }
    ////////không dùng từ đây ( cái này là đổi mật khẩu ở danh sách người dùng)
    public function changePassword(UserEditRequest $request,$id)
    {
    $input = $request->all();
    $user = DB::table('users')->where('id',$id)->first();
    if(!Hash::check($input['txtOldPass'], $user->password)){
        alert()->error('Mật khẩu cũ không trùng khớp.','Lỗi');
        return redirect()->back();
    }else{
            DB::table('users')->where('id',$user->id)->update([
                'password' => Hash::make($request->txtPass),
                'remember_token' => $request->_token          
            ]);
            alert()->success('Đổi mật khẩu thành công.','Thông báo');
            return redirect()->route('admin.user.list');
        }
    }
    /////không dùng đến đây
    //// đổi mật khẩu
    public function changePass(UserEditRequest $request)
    {
    $input = $request->all();
    $u=Auth::user()->id;
    // dd($u);
    $user = DB::table('users')->where('id',$u)->first();
    if(!Hash::check($input['txtOldPass'], $user->password)){
    alert()->error('Mật khẩu cũ không trùng khớp.','Lỗi')->autoclose(3500);;
        return redirect()->back();
    }else{
            DB::table('users')->where('id',$user->id)->update([
                'password' => Hash::make($request->txtPass),
                'remember_token' => $request->_token          
            ]);
            alert()->success('Đổi mật khẩu thành công.','Thông báo');
            return redirect()->back();
        }
    }
}
