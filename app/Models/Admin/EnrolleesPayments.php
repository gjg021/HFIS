<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class EnrolleesPayments extends Model
{
    protected $table = 'enrollees_payments';
    public $timestamps = ['created_at','updated_at'];
    protected $attributes = [


    ];

    public function paymentDetails(){
        return $this->hasMany('App\Models\Admin\EnrolleesPaymentsDetails','payment_id','id');
    }
}