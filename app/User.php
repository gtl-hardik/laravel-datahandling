<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function member(){
        return $this->hasOne('App\Member');
    }

    public function metadata(){
        return $this->hasMany('App\MembersMetadata');
    }

    public function invoice(){
        return $this->hasMany('App\Invoice','seller')->with('invoice_meta');
    }

    public function getinvoiceList($userid){
       return self::with('invoice')
            ->where('id','=',$userid)->get();
    }
    public function getUserDetails($userid){
        return self::with('member','metadata')
            ->where('id','=',$userid)->get();
    }

    public function deleteUser($id){
        return self::find($id)->delete();
    }

    public function selectUser($id){
        return self::where('id','=',$id)->first();
    }

}
