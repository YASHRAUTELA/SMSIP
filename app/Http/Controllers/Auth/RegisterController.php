<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use App\Mail\WelcomeMail;
use App\VerifyUser;
use Illuminate\Support\Facades\Mail;

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
    protected function registered(Request $request, $user){
        $this->guard()->logout();
        return redirect('/login')->with('active_status','We have sent your activation code to administrator.Once your account is verfied a welcome mail is sent to your mail.');
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'integer',
            'dob'=>'required|date',
            'image'=>'max:100|mimes:jpeg,png,jpg'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $fileName = time().'.'.$data['image']->getClientOriginalExtension();
        $data['image']->move(public_path('images'), $fileName);

        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'image_title'=>$fileName,
            'dob'=>$data['dob'],
            'password' => bcrypt($data['password']),
            'role_id'=>$data['role']
        ]);

        $verifyUser=VerifyUser::create([
            'user_id'=>$user->id,
            'token'=>str_random(40)
            ]);

        // Mail::to($data['email'])->send(new VerifyMail($user));
        Mail::to('yashrautela1@gmail.com')->send(new VerifyMail($user));

        return $user;
    }

    public function verifyUser($token){
        $verifyUser=VerifyUser::where('token',$token)->first();
        if(isset($verifyUser)){
            $user=$verifyUser->user;
            /*print_r($user->status);
            exit;*/
            if(!$user->verfied){
                $verifyUser->user->verified=1;
                $verifyUser->user->save();
                Mail::to($user->email)->send(new WelcomeMail($user));

                $active_status="user email is verfied, And welcome email is sent to his/her email id.";
                 return redirect('/login')->with('active_status',$active_status);

            }else{
                $active_status="user email is already verified. No need to verify again";
                return redirect('/login')->with('active_status',$active_status);
            }
        }else{
            return redirect('/login')->with('warning','Sorry user email cannot be identified.');
        }
        return redirect('/login')->with('active_status',$active_status);
    }
}
