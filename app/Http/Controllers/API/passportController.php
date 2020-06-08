<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
Use App\Info;
use Illuminate\Support\Facades\Validator;
use function foo\func;

class PassportController extends Controller
{
    use ApiResponseTrait;

    /**
     * Handles Register Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
       $validator= Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'grade' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'avatar' => 'image'

        ]);
       if($validator->fails())
       {
           return $this->apiResponse('register',null,$validator->errors(),401);
       }
        $avatarName = 'default.png';
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
        }
        $gender = $request->gender;

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->info()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'grade' => $request->grade,
            'avatar' => $avatarName,
            'gender' => $gender
        ]);

        $user->sendApiEmailVerificationNotification();
        $token = $user->createToken('auth')->accessToken;

        return $this->apiResponse('Register',['token' => $token]);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('auth')->accessToken;
            return $this->apiResponse('login',['token' => $token]);
        } else {
            return $this->apiResponse('login',null, "the email or password isn't correct!", 401);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {

        $user = User::with('info')->findOrFail(Auth::id());
        $data = [
            'user' => $user
        ];
        return $this->apiResponse('details',$data);
    }
    public function updateProfile(Request $request)
    {
        $hasImage=$request->hasFile('avatar');
        $id = Auth::id();
        $rules =[
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6',
            'grade' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'avatar' => 'required|string'
        ];
        $imageRules =$rules;
        $imageRules['avatar']='image';
        if ($hasImage) {
            $validator = Validator::make($request->all(), $imageRules);
        }
        else
        {
            $validator= Validator::make($request->all(),$rules );
        }

        if($validator->fails())
        {
            return $this->apiResponse('profile_update',null,$validator->errors(),401);
        }
        if($hasImage)
        {
            $avatarName = time() . '.' . request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
        }
        else {
            $avatarName = Info::where('user_id', $id)->first()->avatar;
            if ($request->avatar !== $avatarName) {
                    $avatarName = 'default.png';
            }
        }
        User::where('id',$id)->update([
           'email'=>$request->email,
            'password'=> bcrypt($request->password)
        ]);
        Info::where('user_id',$id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'grade' => $request->grade,
            'avatar' => $avatarName,
            'gender' =>  $request->gender
        ]);
        return $this->apiResponse('profile_update','update succeed!!');
    }


}

