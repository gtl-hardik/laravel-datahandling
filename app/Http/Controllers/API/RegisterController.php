<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\AccessToken;
use App\UserRefreshToken;
use DB;
use Carbon\Carbon;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT;
class RegisterController extends BaseController
{
    /**

     * Register api

     *

     * @return \Illuminate\Http\Response

     */

    public function register(Request $register)
    {
        $validator = Validator::make($register->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $register->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $register->request->add([
            'grant_type' => 'password',
            'username'  => $register->get('email'),
            'client_id' => 2,
            'client_secret' => 'VpJYwIirciKs6a0PTxvAsfZxkdhOJijkyZ2Lk1hH',
            'scope' => ''
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function refreshToken(Request $request)
    {
        $request->request->add([
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => 2,
            'client_secret' => 'VpJYwIirciKs6a0PTxvAsfZxkdhOJijkyZ2Lk1hH',
            'scope' => ''
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return \Route::dispatch($proxy);
    }


}
