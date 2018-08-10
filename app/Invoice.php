<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seller',
        'info',
        'date',
        'due_date',
        'created',
        'sent',
        'client_type',
        'ref_number',
        'company_id',
        'finvoice_address',
        'finvoice_operator',
        'company_name',
        'contact_person',
        'email',
        'post_number',
        'post_place',
        'address1',
        'address2',
        'country',
        'payment_method',
        'ref_own',
        'ref_client',
        'desc',
        'barcode',
        'filename',
        'total',
        'industry',
        'delivery_method',
        'draft',
        'discarded',
        'status',
        'received',
        'invoice_number',
    ];

    public function invoice_meta(){
        return $this->hasMany('App\InvoicesMetadata');
    }
}
