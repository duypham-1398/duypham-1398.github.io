<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests;
use Hash;
use DB;
use Auth;
use Mail;
use App\ResetPassword;
use Illuminate\Support\Str;
use App\User;

class ResetPassController extends Controller
{
    //Quên mật khẩu
    public function postForgotPassword(Request $request)
    {
        //Tạo token và gửi đường link reset vào email nếu email tồn tại
    	$result = User::where('email', $request->email)->first();
    	if($result){
    		$resetPassword = ResetPassword::firstOrCreate(['email'=>$request->email, 'token'=>Str::random(60)]);

            $token = ResetPassword::where('email', $request->email)->first();
            // $link = url('resetPassword')."/".$token->token; //send it to email
            
            Mail::send('admin.linkreset', ['token' => $token], function ($message) use ($token) {
                $message->subject(' Password Reset Link');
                $message->to($token->email);
            });
            alert()->success('Vui lòng kiểm tra email để lấy lại mật khẩu.','Thành công');
            return redirect()->back();
    	} else {
            alert()->error('Email không có trong hệ thống, vui lòng kiểm tra lại.','Lỗi');
            return redirect()->back();
    	}
    }
    public function resetPassword(Request $request,$token)
    {
        // Check token valid or not
        $result = ResetPassword::where('token', $token)->first();
        if(!is_null($result)){
            $data['info'] = $result->token;
            if($result){
                return view('forgotPass.newPass', $data);
            } else {
                echo 'Liên kết này đã hết hạn';
            }
        }
        else{
            echo 'Liên kết này đã hết hạn';
        }
    }
    public function newPass(Request $request)
    {
    	// Check password confirm
    	if($request->password == $request->confirm){
    		// Check email with token
    		$result = ResetPassword::where('token', $request->token)->first();

    		// Update new password 
    		 User::where('email', $result->email)->update(['password'=>bcrypt($request->password)]);
            //  $u =  User::where('email', $result->email)->first();
    		// Delete token
    		ResetPassword::where('token', $request->token)->delete();
            alert()->success('Mật khẩu đã được đặt lại.','Thành công');
            return redirect('/login');
    	} else {
    		alert()->warning('Mật khẩu không khớp.','Lỗi');
            return redirect()->back();
    	}
    }
    /////////////////////////////////////////
    //đổi mật khẩu
    public function changePass(UserEditRequest $request)
    {
    $input = $request->all();
    $u=Auth::user()->id;
    $user = DB::table('users')->where('id',$u)->first();
    if(!Hash::check($input['txtOldPass'], $user->password)){
        alert()->error('Mật khẩu cũ không trùng khớp.','Lỗi');
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
