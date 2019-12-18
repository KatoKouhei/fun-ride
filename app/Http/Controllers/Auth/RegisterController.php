<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Member;
use App\Entry;

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
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'prefecture' => ['required', 'min:0'],
            'ride_type' => ['required'],
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
        $ride_type = $data['ride_type'];
        $ride_type = implode(",", $ride_type);
        $mail_preference = $data['mail_preference'];
        $mail_preference = implode(",", $mail_preference);
        $image_path = null;
        if(isset($data['image_path'])){
            $image_path = $data['image_path'];
            $path = Storage::disk('s3')->putFile('fanride', $image_path, 'public');
            $image_path = Storage::disk('s3')->url($path);
        }
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password' => Hash::make($data['password']),
            'prefecture'=>$data['prefecture'],
            'ride_type'=>$ride_type,
            'profile'=>$data['profile'],
            'image_path'=>$image_path,
            'mail_preference'=>$mail_preference
        ]);
    }
}
