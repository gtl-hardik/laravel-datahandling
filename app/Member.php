<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'mark_name','phone','profession','street_addr','zip','city','tax_id','tax_percent','tax_extra_percent','tax_deduction_card','tax_deduction_card_type'
        ,'tax_deduction_card_valid_till','earnings_limit','foreclosure_percent','fixed_commission','autopay','created','disabled','activated','utmcsr','utmccn','utmcmd','utmctr','user_id'
    ];


    public function meta(){
        return $this->hasMany('App\MembersMetadata');
    }

    public function updateMember($input,$userid){
        return self::where('user_id','=',$userid)
            ->update($input);
    }

}
