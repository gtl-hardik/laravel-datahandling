<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use App\User;
use Validator;
use Illuminate\Validation\Rule;
use App\Traits\APITraits;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends BaseController
{

    use APITraits,AuthenticatesUsers;

    /**
     * login api personal token access
     *
     * @return \Illuminate\Http\Response
     */
    public function partnerLogin(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'secretkey' => 'required|string'
        ]);
        $user =  User::orWhere('email', $request->email)->orWhere('secretId', $request->secretkey)->first();

        if($user)  {
            $tokenResult = $user->createToken('Personal Access Token');

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * User Login api with grant access token
     *
     * @return \Illuminate\Http\Response
     */

    public function userLogin(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $content = $this->generateToken($request,'password');
            $result = json_decode($content, 1);
            return $this->sendResponse($result, 'User loggedin successfully.');
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $registerUser = $request->all();
        if(isset($registerUser['isPartner']) && $registerUser['isPartner'] == 1) {
            $registerUser['secretId'] = str_random(8);
        }
        //print_r($registerUser);exit;
        $registerUser['password'] = bcrypt($registerUser['password']);
        User::create($registerUser);

        $content = $this->generateToken($request,'password');
        $result = json_decode($content, 1);
        return $this->sendResponse($result, 'User register successfully.');
    }

    /**
     * Refresh Token api
     *
     * @return \Illuminate\Http\Response
     */

    public function renewToken(Request $request){
        $content = $this->generateToken($request,'refresh_token');
        $result = json_decode($content, 1);
        return $result;
    }

    /**
     * Logged in User details api
     *
     * @return \Illuminate\Http\Response
     */

    public function userDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user]);
    }
}
