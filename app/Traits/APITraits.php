<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait APITraits {

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function generateToken($request , $grantType)
    {
        if(isset($request->email) && isset($request->password)) {
            $request->request->add(['username' => $request->email,'password' => $request->password]);
        }

        if(isset($request->refresh_token)) {
            $request->request->add(['refresh_token' => $request->refresh_token]);
        }

        $request->request->add([
            'grant_type' => $grantType,
            'client_id' => config('app.client_id'),
            'client_secret' => config('app.client_secret')
        ]);

        $accessDetails = Request::create('oauth/token','POST');
        return \Route::dispatch($accessDetails)->getContent();
    }


}
