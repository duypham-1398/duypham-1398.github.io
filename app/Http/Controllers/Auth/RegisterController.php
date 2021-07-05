<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Khachhang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Classes\ActivationService;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $activationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest');
        $this->activationService = $activationService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' =>'required|unique:users,name',
            'email' =>'required|unique:users,email|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})^',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' =>'required|same:password',
            'txtname' =>'required|unique:khachhang,khachhang_ten',
            'txtphone' =>'required|numeric:khachhang,khachhang_sdt',
            'txtadr' =>'required'
        ];

        $messages = [
            'required'=> 'Vui lòng không để trống trường này!',
            'name.unique'   =>'Dữ liệu này đã tồn tại!',
            'txtname.unique'   =>'Dữ liệu này đã tồn tại!',
            'email.unique'  =>'Dữ liệu này đã tồn tại!',
            'txtphone.numeric'=>'Số điện thoại không hợp lệ',
            'txtphone.size' => 'Số điện thoại không đúng định dạng',
            'password_confirmation.same' =>'Mật khẩu không trùng khớp!'
        ];

        return Validator::make($data,$rules,$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'loainguoidung_id' => 2,
        ]);
        Khachhang::create([
            'khachhang_ten' => $data['txtname'],
            'khachhang_email' => $data['email'],
            'khachhang_sdt' => $data['txtphone'],
            'khachhang_dia_chi' => $data['txtadr'],
            'khachhang_tonno_dk'=>0,
            'khachhang_tonco_dk'=>0,
            'khachhang_phat_sinh_no'=>0,
            'khachhang_phat_sinh_co'=>0,
            'khachhang_tonno_ck'=>0,
            'khachhang_tonco_ck'=>0,
            'user_id' => $user->id,
            
        ]);
        return $user;
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        //event(new Registered($user = $this->create($request->all())));
        //$this->guard()->login($user);
        //return $this->registered($request, $user)?: redirect($this->redirectPath());

        $user = $this->create($request->all());
        event(new Registered($user));
        //$this->guard()->login($user);

        $this->activationService->sendActivationMail($user);
        alert()->success('Đăng ký thành công. Bạn hãy kiểm tra email và thực hiện xác thực theo hướng dẫn.','Thông báo');
        return redirect('/login');
    }

    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            alert()->success('Xác thực thành công. Bây giờ bạn có thể đăng nhập vào hệ thống.','Thông báo');
            return redirect('/login');
        }
        abort(404);
    }
}
