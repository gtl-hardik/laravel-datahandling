<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembersMetadata extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key_name', 'key_value', 'user_id',
    ];

    public function deleteMeta($key,$userid){
        return self::where('user_id','=',$userid)->where('key_name','=',$key)->delete();
    }

    public function updateMemberMeta($meta,$userid){
        return self::where('user_id','=',$userid)
            ->where('key_name','=',$meta['key_name'])
            ->update([
                'key_value' => $meta['key_value']
            ]);
    }
}
