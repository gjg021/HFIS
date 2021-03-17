<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Enrollees extends Model
{
    protected $table = 'enrollees';
    public $timestamps = ['created_at'];

    protected $attributes = [

        'student_id' => 0,
        'date_application' => null,
        'grade' => 0,
        'sy' => 0,
        'created_at' => null,
        'user_created' => '',


    ];


    public function student(){
        return $this->belongsTo('App\Models\Admin\Student','student_id','id');
    }

    public function account_payables(){
        return $this->hasMany('App\Models\Admin\EnrolleesAccounts','student_id','student_id');
    }

    public function payments(){
        return $this->hasMany('App\Models\Admin\EnrolleesPayments','enrollee_id','id');
    }
}