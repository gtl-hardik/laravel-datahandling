<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicesMetadata extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key_name', 'key_value', 'invioce_id',
    ];

}
