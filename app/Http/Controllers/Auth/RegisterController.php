<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\info;
use App\Item;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = '/email/verify';

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
        $validator =  Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'grade' => ['required', 'string'],
            'gender' =>['required',Rule::in(['male','female'])],
            'avatar' => ['nullable','mimes:jpg,jpeg,png,bmp,gif,svg,webp']

        ]);

            return $validator;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $avatarName ="{$data['gender']}.png";
        if ( request()->hasFile('avatar')) {
            $avatarName = time() . '.' . request()->avatar->getClientOriginalExtension();
           $data['avatar']->storeAs('avatars', $avatarName);
        }

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
       $user->info()->create([
            'first_name'=> $data['first_name'],
            'last_name'=> $data['last_name'],
            'grade' =>$data['grade'],
            'gender'=> $data['gender'],
           'avatar'=>$avatarName
        ]);
        return $user;
    }

}
