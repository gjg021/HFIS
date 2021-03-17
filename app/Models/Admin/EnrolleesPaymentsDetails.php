<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class EnrolleesPaymentsDetails extends Model
{
    protected $table = 'enrollees_payments_details';
    public $timestamps = false;
    protected $attributes = [


    ];


    public function paymentDetails(){
        return $this->belongsTo('App\Models\Admin\EnrolleesPayments','id','payment_id');
    }
}