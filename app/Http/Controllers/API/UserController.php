<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use App\Http\Requests\Address;
use App\Traits\APIResponse;
use Auth;
use App\MembersMetadata;
use App\Http\Requests\UserMetaValidation;
use App\Http\Requests\UserUpdate;
use App\Member;
class UserController extends Controller
{

    use APIResponse;

    public function createAddress(Address $request){
        $input = $request->all();
        return $this->sendResponse($input, 'Address stored successfully.');
    }

    public function loadInvoice(){
        $user = Auth::user();
        $user->load('invoice');
        return $this->sendResponse($user, 'invoice data.');
    }

    public function loadUserDetails(){
        $objUser = new User();
        $list = $objUser->getUserDetails(Auth::user()->id);
        return $this->sendResponse($list, 'invoice data.');
    }

    public function deleteUser($id){
        $objUser = new User();
        $deleted = $objUser->deleteUser($id);
        if($deleted == true){
            return $this->sendResponse('', 'User Deleted Successfully.');
        } else {
            return $this->sendError('Some Error Occurred','Some Error Occurred',202);
        }
    }

    public function deleteUserMeta(UserMetaValidation $request){
        $metakey = $request->get('meta_key');
        $userid  = $request->get('user_id');
        $objUserMeta = new MembersMetadata();
        $isdeleted = $objUserMeta->deleteMeta($metakey,$userid);
        if($isdeleted == true){
            return $this->sendResponse('', 'User Meta Deleted Successfully.');
        } else {
            return $this->sendError('Some Error Occurred','Some Error Occurred',202);
        }
    }

    public function updateUserData(UserUpdate $request){
        $input = $request->all();
        $metaData = array(
            'key_name' => $input['key_name'],
            'key_value' => $input['key_value']
        );
        unset($input['key_name']);
        unset($input['key_value']);
        $userid  = Auth::user()->id;
        $objMember = new Member();
        $updated1 = $objMember->updateMember($input,$userid);
        $objUserMeta = new MembersMetadata();
        $udpated2 = $objUserMeta->updateMemberMeta($metaData,$userid);
        if($updated1 == true  && $udpated2 ==  true){
            return $this->sendResponse('', 'User data updated Successfully.');
        } else {
            return $this->sendError('Some Error Occurred','Some Error Occurred',202);
        }
    }
}
