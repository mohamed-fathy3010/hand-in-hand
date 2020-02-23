<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\User;
use App\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class ResetPasswordController extends Controller
{
    use ApiResponseTrait;
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user)
            return $this->apiResponse('send_reset_password_email',null,
              "We can't find a user with that e-mail address.", 404);
        $token =Str::random(60);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => bcrypt($token)
             ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($token,$user->email)
            );
        return $this->apiResponse('send_reset_password_email',[
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @param [string] $email
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token,$email)
    {
//       if(! $passwordReset = PasswordReset::where('email', $email)
//            ->first())
//           return $this->apiResponse(null,
//               'email not found', 404);
//        if (!Hash::check($token,$passwordReset->token))
//            return $this->apiResponse(null, 'This password reset token is invalid.',
//             404);
//        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
//            $passwordReset->delete();
//            return $this->apiResponse(null,
//                 'This password reset token is expired.'
//            , 404);
//        }
         return view('auth.passwords.reset')->with(
        ['token' => $token, 'email' => $email]
    );
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        if(!$passwordReset = PasswordReset::where('email', $request->email)
            ->first())
            return $this->apiResponse('reset_password',null,
                'email not found'
            ,404);

        if (!Hash::check($request->token,$passwordReset->token))
            return $this->apiResponse('reset_password',null,
                'This password reset token is invalid.'
            , 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return $this->apiResponse('reset_password',null,
                'This password reset token is expired.'
                , 404);
        }
        $user = User::where('email',$passwordReset->getAttributes()['email'] )->first();
        if (!$user)
            return $this->apiResponse('reset_password',null,
                "We can't find a user with that e-mail address."
            , 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        return $this->apiResponse('reset_password',['message'=>'password has been reset!']);

    }
}

